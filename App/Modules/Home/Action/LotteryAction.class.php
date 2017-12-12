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
        $url = $info['api'];
        $ret = http($url);
        $res = json_decode($ret,true);
        $sign = $res['code'];
        $data = $res['data'];
        if(empty($data)){
            $this->error('访问过于频繁,稍后再试','/');
        }
        $beforeLog = M('lotteryPlan')->order('opentime DESC')->limit(1)->find();
        $expect = $beforeLog['expect'];
        foreach ($data as $k=>$v){
            if($v['expect'] == $expect){
                break;
            }
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
        $where = [
            'opentime' => array('like',date('Y-m-d').'%'),
            'sign' => $sign,
        ];
        $list = M('lotteryPlan')->where($where)->order('expect DESC')->select();
        $newLog = M('lotteryPlan')->order('opentime DESC')->limit(1)->find();
        $newinfo = self::getInfo($id);
        $this->assign('info',$newinfo);
        $this->assign('new',$newLog);
        $this->assign('list',$list);
        $this->display();
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
                if($beforeLog[0]['state'] == 0 && $beforeLog[1]['state'] == 0){
                    self::updatePlan($sign);
                }
                return 0;
            }
        }
    }

    //更新计划
    public static function updatePlan($sign){
        $num = NoRand(0,9,5);
        $code = implode(',',$num);
        $data = [
            'nums'=>$code
        ];
        return M('lottery')->where(['sign'=>$sign])->save($data);
    }

}