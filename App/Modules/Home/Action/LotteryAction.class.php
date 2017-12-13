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
            $this->error('当前计划已被禁用','http://www.ssc188888888.com');
        }

        if(!self::getData($id)){
            $this->error('访问过于频繁,等待3秒后点击确定自动刷新','/');
        }

        $where = [
            'opentime' => array('like',date('Y-m-d').'%'),
            'sign' => $info['sign'],
        ];
        $list = M('lotteryPlan')->where($where)->order('expect DESC')->select();
        $newLog = M('lotteryPlan')->order('opentime DESC')->limit(1)->find();
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
        $sign = $info['sign'];
        $url = $info['api'];
        $ret = http($url);
        $res = json_decode($ret,true);
        $data = $res['data'];
        if(empty($data)){
            return false;
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
            $info = self::getInfo($id);
            $con = [
                'sign' => $sign,
                'expect' => $v['expect'],
                'code' => $info['nums'],
                'opencode' => $v['opencode'],
                'opentime' => $v['opentime'],
                'createtime' => date('Y-m-d H:i:s'),
                'state' => self::isCode($sign,$info['nums'],$v['opencode'])
            ];
            M('lotteryPlan')->add($con);
        }
        return true;
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
                return 1;
            }else{
                $where = [
                    'opentime' => array('like',date('Y-m-d').'%'),
                    'sign' => $sign,
                ];
                $beforeLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit(2)->select();
                if($beforeLog[0]['state'] == 0 && $beforeLog[1]['state'] == 0 && !empty($beforeLog[0]) && !empty($beforeLog[1])){
                    self::updatePlan($sign);
                }
                return 0;
            }
        }
        //北京赛车PK10
        if($sign =='bjpk10'){
            $i = explode(',',$opencode)[9];
            $a = explode(',',$code);
            if(in_array($i,$a)){
                self::updatePlan($sign);
                return 1;
            }else{
                $where = [
                    'opentime' => array('like',date('Y-m-d').'%'),
                    'sign' => $sign,
                ];
                $beforeLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit(2)->select();
                if($beforeLog[0]['state'] == 0 && $beforeLog[1]['state'] == 0 && !empty($beforeLog[0]) && !empty($beforeLog[1])){
                    self::updatePlan($sign);
                }
                return 0;
            }
        }
    }

    //更新计划
    public static function updatePlan($sign){
        //重庆时时彩
        if($sign == 'cqssc'){
            $num = NoRand(0,9,5);
            asort($num);
            $code = implode(',',$num);
            $data = [
                'nums'=>$code
            ];
            return M('lottery')->where(['sign'=>$sign])->save($data);
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
            return M('lottery')->where(['sign'=>$sign])->save($data);
        }
    }

}