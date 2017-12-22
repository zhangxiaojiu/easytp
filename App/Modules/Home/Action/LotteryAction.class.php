<?php
/**
 * Created by PhpStorm.
 * User: jiu
 * Date: 2017/12/5
 * Time: 15:51
 */

class LotteryAction extends SystemAction
{
    public function index(){
        $id = I('request.id',1);
        $info = self::getInfo($id);
        if($info['state'] == 0){
            $this->error('当前计划已被禁用','http://www.csc5188.com');
        }
        
        $where = [
            'opentime' => array('like',date('Y-m-d').'%'),
            'sign' => $info['sign'],
            'status' => 1,
        ];
        $list = M('lotteryPlan')->where($where)->order('expect DESC')->select();
        $where = [
            'sign' => $info['sign']
        ];
        $newLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit(1)->find();
        $newinfo = self::getInfo($id);
        $this->assign('info',$newinfo);
        $this->assign('new',$newLog);
        $this->assign('list',$list);
        $this->display();
    }

    /*
     * 获取最新数据
     */
    public static function getData($cid=0){
        $id = $cid != 0?$cid:I('request.id',1);
        $info = self::getInfo($id);
        if($info['is_auto'] == 0 && $info['nums'] == ''){
            return ['code'=>101,'msg'=>'不自动生成，没有预测'];
        }
        $sign = $info['sign'];
        $url = $info['api'];
        //腾讯分分彩
        if($sign == 'ffcqq'){
            $ret = http_curl($url);
            $res = json_decode($ret,true);
            $data[0] = $res[0];
        }else{
            $ret = http_curl($url);
            $res = json_decode($ret,true);
            $data = $res['data'];
        }
        if(empty($data)){
            return ['code'=>102,'msg'=>'刷新频率太快'];
        }

        $where = [
            'sign' => $sign,
        ];
        $beforeLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit(1)->find();
        $expect = $beforeLog['expect'];
        foreach($data as $k=>$v) {
            if($sign == 'ffcqq'){
                $newExpect = str_replace('-','',$v['issue']);
                $openCode = $v['code'];
                $openTime = date('Y-m-d H:i:s', substr($v['time'],0,-3));
            }else {
                $newExpect = $v['expect'];
                $openCode = $v['opencode'];
                $openTime = $v['opentime'];
            }
            if ($newExpect <= $expect && !empty($expect)) {
                return ['code' => 103, 'msg' => '没有最新一期'];
            }
            if ($info['nums'] == '') {
                self::updatePlan($sign);
                $info = self::getInfo($id);
            }
            $con = [
                'sign' => $sign,
                'expect' => $newExpect,
                'code' => $info['nums'],
                'opencode' => $openCode,
                'opentime' => $openTime,
                'createtime' => date('Y-m-d H:i:s'),
                'status' => 1,
            ];

            $isCode = self::isCode($sign, $info['nums'], $openCode);
            if ($isCode['code'] == 102) {
                $con['state'] = 0;
                $con['status'] = 0;
            } else {
                if ($isCode['code'] == 100) {
                    $con['state'] = 1;
                }
                if ($isCode['code'] == 101) {
                    $con['state'] = 0;
                }
            }
            $con['state_time'] = $isCode['times'];
            M('lotteryPlan')->add($con);
        }
        return ['code'=>100,'msg'=>'获取成功'];
    }

    /*
     * 自动刷新数据
     */
    public function autoRefreshData(){
        $where = [
            'uid' => 1,
        ];
        $list = M('lottery')->where($where)->select();
        foreach($list as $v){
            self::getData($v['id']);
        }
    }
    /*
     * 删除无用数据
     */
    public function delUnuseData(){
        $where = [
            'opentime' => array('lt',date('Y-m-d',time()-2*24*60*60).'%'),
        ];
        M('lotteryPlan')->where($where)->delete();
    }

    //获取当前彩票信息
    public static function getInfo($id){
       return M('lottery')->where(['id'=>$id])->find();
    }

    //判断是否预测中
    public static function isCode($sign,$code,$opencode){
        //重庆时时彩
        if($sign == 'cqssc'){
            $i = explode(',',$opencode)[4];
            $a = explode(',',$code);
            $term = 3;
            return self::getCodeRet($sign,$i,$a,$term);
        }
        //北京赛车PK10
        if($sign == 'bjpk10'){
            $i = explode(',',$opencode)[0];
            $a = explode(',',$code);
            $term = 3;
            return self::getCodeRet($sign,$i,$a,$term);
        }
        //腾讯分分彩
        if($sign == 'ffcqq'){
            $i = explode(',',$opencode)[4];
            $a = explode(',',$code);
            $term = 5;
            return self::getCodeRet($sign,$i,$a,$term);
        }
    }

    //获取返回状态和次数
    public static function getCodeRet($sign,$i,$a,$term){
        if(in_array($i,$a)){
            self::updatePlan($sign,$i);
            $ret = ['code'=>100,'msg'=>'right'];
        }else{
            if(self::getContinuityTerm($sign,$term) == $term){
                self::updatePlan($sign,$i);
                $ret = ['code'=>101,'msg'=>'wrong enough times'];
            }else {
                $ret = ['code' => 102, 'msg' => 'wrong'];
            }
        }
        $ret['times'] = self::getContinuityTerm($sign,$term);
        return $ret;
    }

    //
    private static function getContinuityTerm($sign,$term){
        //查询前几期记录做判断
        $where = [
            'opentime' => array('like',date('Y-m-d').'%'),
            'sign' => $sign,
        ];
        $beforeLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit($term-1)->select();

        $term = 1;
        foreach ($beforeLog as $k=>$v){
            if($v['state'] == 0 && $v['status'] == 0 && !empty($v)){
                $term = $k + 2;
            }else{
                break;
            }
        }
        return $term;
    }

    //更新计划
    public static function updatePlan($sign,$e=0){
        //重庆时时彩
        $info = M('lottery')->where(['sign'=>$sign])->find();
        if($sign == 'cqssc'){
            $num = NoRand(0,9,5);
            asort($num);
            $code = implode(',',$num);
            $data = [
                'nums'=>$code
            ];
        }
        //北京赛车PK10
        if($sign == 'bjpk10'){
            $num = NoRand(1,10,5);
            asort($num);
            foreach ($num as &$v){
                if(strlen($v) == 1){
                    $v = '0'.$v;
                }
            }
            $code = implode(',',$num);
            $data = [
                'nums'=>$code
            ];
        }
        //腾讯分分彩
        if($sign == 'ffcqq'){
            //$num = NoRand(0,9,3);
            $b = rand(0,1);
            switch($e){
                case 0:
                    $num = '3,6,9';
                    break;
                case 1:
                    $num = '4,6,7';
                    break;
                case 2:
                    $num = '3,5,8';
                    break;
                case 3:
                    if($b == 1){
                        $num = '2,5,8';
                    }else {
                        $num = '0,6,9';
                    }
                    break;
                case 4:
                    $num = '1,6,7';
                    break;
                case 5:
                    $num = '2,3,8';
                    break;
                case 6:
                    if($b == 1){
                        $num = '1,4,7';
                    }else {
                        $num = '0,3,9';
                    }
                    break;
                case 7:
                    $num = '1,4,6';
                    break;
                case 8:
                    $num = '2,3,5';
                    break;
                case 9:
                    $num = '0,3,6';
                    break;
                default:
                    $num = '3,6,9';
            }
            $data =[
                'nums'=>$num
            ];
        }

        if($info['is_auto'] == 0){
            $data['nums'] = '';
        }
        return M('lottery')->where(['sign'=>$sign])->save($data);
    }

}