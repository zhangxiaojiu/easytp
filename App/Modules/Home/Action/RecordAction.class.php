<?php
/**
 * Created by PhpStorm.
 * User: jiu
 * Date: 2017/12/29
 * Time: 17:00
 */

class RecordAction extends SystemAction
{
    public function index(){
        $sign = I('get.sign','');
        if(empty($sign)){
            $sign = 'cqssc';
        }

        $con = [
            'sign' => $sign,
        ];
        $res = M('lotteryRecord')->where($con)->find();
        $ret = json_decode($res['record'],true);
        foreach ($ret as $k => $v){
            $maxs[$k] = array_search(max($v),$v);
        }
        $this->assign('maxs',$maxs);
        $this->assign('sign',$sign);
        $this->assign('list',$ret);
        $this->display();
    }
    /*
     * 自动记录数据
     */
    public function autoRecordData(){
        $list = [
            ['sign' => 'cqssc'],
            ['sign' => 'bjpk10'],
            ['sign' => 'ffcqq'],
        ];
        foreach($list as $v){
            $con = [
                'opentime' => array('like',date('Y-m-d').'%'),
                'sign' => $v['sign'],
            ];
            $res = M('lotteryPlan')->where($con)->order('id desc')->select();
            $ret = self::getLast($res);

            $data = [
                'sign' => $v['sign'],
                'record' => json_encode($ret),
                'update_time' => date('Y-m-d H:i:s'),
                'state' => 1
            ];
            if(M('lotteryRecord')->where(['sign'=>$v['sign']])->find()){
                M('lotteryRecord')->where(['sign'=>$v['sign']])->save($data);
            }else{
                M('lotteryRecord')->where(['sign'=>$v['sign']])->add($data);
            }
        }
    }
    //返回遗漏
    private static function getLast($res){
        for ($i=1; $i <= 10; $i++){
            for($j=0; $j<5; $j++){
                $ret[$j][$i]['num'] = 0;
                $ret[$j][$i]['ready'] = 0;
            }
        }
        foreach($res as $val){
            $code = explode(',',$val['opencode']);
            foreach ($code as $k=>$v){
                if($k > 4){
                    break;
                }
                for ($i=1; $i <= 10; $i++){
                    if($v == 0){
                        $v = 10;
                    }
                    if($v != $i){
                        if($ret[$k][$i]['ready'] == 0) {
                            $ret[$k][$i]['num']++;
                        }
                    }else{
                        $ret[$k][$i]['ready'] = 1;
                    }
                }
            }
        }
        return $ret;
    }
}