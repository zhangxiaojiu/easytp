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

        $ret = self::getData($id);
        if($ret['code'] == 102){
            $this->error('访问过于频繁,等待3秒后点击确定自动刷新','/');
        }

        $where = [
            'opentime' => array('like',date('Y-m-d').'%'),
            'sign' => $info['sign'],
            'status' => 1,
        ];
        $list = M('lotteryPlan')->where($where)->order('expect DESC')->select();
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
        $ret = http_curl($url);
        $res = json_decode($ret,true);
        $data = $res['data'];
        if(empty($data)){
            return ['code'=>102,'msg'=>'刷新频率太快'];
        }

        $where = [
            'opentime' => array('like',date('Y-m-d').'%'),
            'sign' => $sign,
        ];
        $beforeLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit(1)->find();
        $expect = $beforeLog['expect'];
        foreach ($data as $k=>$v){
            if($v['expect'] <= $expect && !empty($expect)){
                break;
            }
            if($info['nums'] == ''){
                self::updatePlan($sign);
            }
            $info = self::getInfo($id);
            $con = [
                'sign' => $sign,
                'expect' => $v['expect'],
                'code' => $info['nums'],
                'opencode' => $v['opencode'],
                'opentime' => $v['opentime'],
                'createtime' => date('Y-m-d H:i:s'),
                'status' => 1,
            ];
            $isCode = self::isCode($sign,$info['nums'],$v['opencode']);
            if($isCode['code'] == 102){
                $con['state'] = 0;
                $con['status'] = 0;
            }else{
                if($isCode['code'] == 100){
                    $con['state'] = 1;
                }
                if($isCode['code'] == 101){
                    $con['state'] = 0;
                }
            }
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
            if(in_array($i,$a)){
                self::updatePlan($sign);
                return ['code'=>100,'msg'=>'right'];
            }else{
                $where = [
                    'opentime' => array('like',date('Y-m-d').'%'),
                    'sign' => $sign,
                ];
                $beforeLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit(2)->select();
                if($beforeLog[0]['state'] == 0 && $beforeLog[1]['state'] == 0 && !empty($beforeLog[0]) && !empty($beforeLog[1])){
                    self::updatePlan($sign);
                    return ['code'=>101,'msg'=>'wrong three times'];
                }
                return ['code'=>102,'msg'=>'wrong'];
            }
        }
        //北京赛车PK10
        if($sign =='bjpk10'){
            $i = explode(',',$opencode)[9];
            $a = explode(',',$code);
            if(in_array($i,$a)){
                self::updatePlan($sign);
                return ['code'=>100,'msg'=>'right'];
            }else{
                $where = [
                    'opentime' => array('like',date('Y-m-d').'%'),
                    'sign' => $sign,
                ];
                $beforeLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit(2)->select();
                if($beforeLog[0]['state'] == 0 && $beforeLog[1]['state'] == 0 && !empty($beforeLog[0]) && !empty($beforeLog[1])){
                    self::updatePlan($sign);
                    return ['code'=>101,'msg'=>'wrong three times'];
                }
                return ['code'=>102,'msg'=>'wrong'];
            }
        }
    }

    //更新计划
    public static function updatePlan($sign){
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

        if($info['is_auto'] == 0){
            $data['nums'] = '';
        }
        return M('lottery')->where(['sign'=>$sign])->save($data);
    }

}