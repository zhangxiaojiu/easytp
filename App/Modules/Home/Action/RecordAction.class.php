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
            $this->error('参数错误');
        }

        $con = [
            'opentime' => array('like',date('Y-m-d').'%'),
            'sign' => $sign,
        ];
        $res = M('lotteryPlan')->where($con)->order('id desc')->select();
        $ret = self::getLast($res);
        $this->assign('sign',$sign);
        $this->assign('list',$ret);
        $this->display();
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