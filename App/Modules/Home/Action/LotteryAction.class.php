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
        $allList = M('lotteryPlan')->where($where)->order('expect DESC')->select();
        $list = array_slice($allList,0,200);
        $where = [
            'sign' => $info['sign']
        ];
        $newLog = M('lotteryPlan')->where($where)->order('opentime DESC')->limit(1)->find();
        $newinfo = self::getInfo($id);

        //统计次数
        $right = 0;
        $wrong = 0;
        $continuityRight = 0;
        $continuityWrong = 0;
        $cRight = true;
        $cWrong = true;
        foreach ($allList as $v){
            if($v['state'] = 1){
                $right++;
                if($cRight) {
                    $continuityRight++;
                }
                $cWrong = false;
            }else{
                $wrong++;
                if($cWrong) {
                    $continuityWrong++;
                }
                $cRight = false;
            }
        }
        $total['right'] = $right;
        $total['wrong'] = $wrong;
        $total['continuityRight'] = $continuityRight;
        $total['continuityWrong'] = $continuityWrong;

        $this->assign('total',$total);
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
        //获取数据
        if(strpos($sign,'ffcqq') !== false){
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
            if(strpos($sign,'ffcqq') !== false){
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

            $isCode = self::isCode($sign, $info['nums'], $openCode,$info['term']);
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
            'state' => 1,
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
    public static function isCode($sign,$code,$opencode,$term){
        //重庆时时彩
        if($sign == 'cqssc'){
            $data = [];
            $i = explode(',',$opencode)[4];
            $a = explode(',',$code);
            $data[$i] = $a;
            return self::getCodeRet($sign,$data,$term);
        }
        //北京赛车PK10
        if($sign == 'bjpk10'){
            $data =[];
            $i = explode(',',$opencode)[0];
            $a = explode(',',$code);
            $data[$i] = $a;
            return self::getCodeRet($sign,$data,$term);
        }
        //北京赛车PK10 前五定位胆
        if($sign == 'bjpk10_qwdwd'){
            $data =[];
            $i = explode(',',$code)[0];
            $j = explode(',',$code)[1];
            $a = array_slice(explode(',',$opencode),0,5);
            $data[$i] = $a;
            $data[$j] = $a;
            return self::getCodeRet($sign,$data,$term,true);
        }
        //腾讯分分彩
        if($sign == 'ffcqq'){
            $data = [];
            $i = explode(',',$opencode)[4];
            $a = explode(',',$code);
            $data[$i] = $a;
            return self::getCodeRet($sign,$data,$term);
        }
        //腾讯分分彩-五星定位胆
        if($sign == 'ffcqq_wxdwd'){
            $data = [];
            $i = $code;
            $a = explode(',',$opencode);
            $data[$i] = $a;
            return self::getCodeRet($sign,$data,$term);
        }
        //腾讯分分彩-五星定位胆-五期
        if($sign == 'ffcqq_wxdwd_5'){
            $data = [];
            $i = $code;
            $a = explode(',',$opencode);
            $data[$i] = $a;
            return self::getCodeRet($sign,$data,$term);
        }
        //重庆时时彩、腾讯分分彩 - 后二复式
        if(strpos($sign,'last_two') !== false){
            $data = [];
            $a = explode(',',explode('|',$code)[0]);
            $b = explode(',',explode('|',$code)[1]);
            $i = explode(',',$opencode)[3];
            $j = explode(',',$opencode)[4];
            $data[$i] = $a;
            $data[$j] = $b;
            return self::getCodeRet($sign,$data,$term);
        }
    }

    //获取返回状态和次数
    public static function getCodeRet($sign,$data,$term,$or = false){
        if(self::isCodeRight($data,$or)){
            self::updatePlan($sign,$data);
            $ret = ['code'=>100,'msg'=>'right'];
        }else{
            if(self::getContinuityTerm($sign,$term) == $term){
                self::updatePlan($sign,$data);
                $ret = ['code'=>101,'msg'=>'wrong enough times'];
            }else {
                $ret = ['code' => 102, 'msg' => 'wrong'];
            }
        }
        $ret['times'] = self::getContinuityTerm($sign,$term);
        return $ret;
    }
    //判断预测码是否正确
    private static function isCodeRight($data,$or=false){
        $ret = true;
        foreach($data as $k=>$v){
            if(!in_array($k,$v)) {
                $ret = false;
            }elseif($or){
                $ret = true;
                break;
            }
        }
        return $ret;
    }
    //查询连续期数
    private static function getContinuityTerm($sign,$term){
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
    public static function updatePlan($sign,$input=[]){
        //获取统计数据
        $signRecord = substr($sign,0,strcspn($sign,'_'));
        $recInfo = M('lotteryRecord')->where(['sign'=>$signRecord])->find();
        $rec = json_decode($recInfo['record'],true);
        //重庆时时彩
        if($sign == 'cqssc'){
            $num = NoRand(0,9,5);
            asort($num);
            $selArr = $rec[4];
            $max = array_search(max($selArr),$selArr);
            unset($selArr[$max]);
            $secMax = array_search(max($selArr),$selArr);
            if($max == 10){
                $max = 0;
            }
            if($secMax == 10){
                $secMax = 0;
            }
            if(in_array($max,$num) || in_array($secMax,$num)){
                $num = NoRand(0,9,5);
            }
            $code = implode(',',$num);
            $data = [
                'nums'=>$code
            ];
        }
        //北京赛车PK10
        if($sign == 'bjpk10'){
            $num = NoRand(1,10,5);
            asort($num);
            $selArr = $rec[0];
            $max = array_search(max($selArr),$selArr);
            unset($selArr[$max]);
            $secMax = array_search(max($selArr),$selArr);
            if(in_array($max,$num) || in_array($secMax,$num)){
                $num = NoRand(1,10,5);
            }
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
        //北京赛车PK10 前五定位
        if($sign == 'bjpk10_qwdwd'){
            $num = NoRand(1,10,2);
            asort($num);
            if(!empty($input)){
                foreach ($input as $v){
                    $p = $v[0]+$v[4];
                    break;
                }
                switch ($p){
                    case 3:
                        $num[0] = 4;
                        $num[1] = 8;
                        break;
                    case 4:
                        $num[0] = 6;
                        $num[1] = 4;
                        break;
                    case 5:
                        $num[0] = 8;
                        $num[1] = 10;
                        break;
                    case 6:
                        $num[0] = 9;
                        $num[1] = 7;
                        break;
                    case 7:
                        $num[0] = 1;
                        $num[1] = 3;
                        break;
                    case 8:
                        $num[0] = 1;
                        $num[1] = 2;
                        break;
                    case 9:
                        $num[0] = 1;
                        $num[1] = 4;
                        break;
                    case 10:
                        $num[0] = 1;
                        $num[1] = 6;
                        break;
                    case 11:
                        $num[0] = 1;
                        $num[1] = 7;
                        break;
                    case 12:
                        $num[0] = 1;
                        $num[1] = 9;
                        break;
                    case 13:
                        $num[0] = 2;
                        $num[1] = 1;
                        break;
                    case 14:
                        $num[0] = 2;
                        $num[1] = 6;
                        break;
                    case 15:
                        $num[0] = 2;
                        $num[1] = 4;
                        break;
                    case 16:
                        $num[0] = 2;
                        $num[1] = 5;
                        break;
                    case 17:
                        $num[0] = 2;
                        $num[1] = 7;
                        break;
                    case 18:
                        $num[0] = 2;
                        $num[1] = 9;
                        break;
                    case 19:
                        $num[0] = 3;
                        $num[1] = 10;
                        break;
                }
            }
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
            $num = NoRand(0,9,5);
            asort($num);
            $selArr = $rec[4];
            $max = array_search(max($selArr),$selArr);
            unset($selArr[$max]);
            $secMax = array_search(max($selArr),$selArr);
            if($max == 10){
                $max = 0;
            }
            if($secMax == 10){
                $secMax = 0;
            }
            if(in_array($max,$num) || in_array($secMax,$num)){
                $num = NoRand(0,9,5);
            }
            $code = implode(',',$num);
            $data =[
                'nums'=>$code
            ];
        }
        //腾讯分分彩-五星定位胆-5期
        if($sign == 'ffcqq_wxdwd_5'){
            $code = rand(0,9);
            $data =[
                'nums'=>$code
            ];
        }
        //重庆时时彩/腾讯分分彩-后二复试
        if(strpos($sign,'last_two') !== false){
            $num1 = NoRand(0,9,7);
            $num2 = NoRand(0,9,7);
            asort($num1);
            asort($num2);
            $selArr1 = $rec[3];
            $selArr2 = $rec[4];
            $max1 = array_search(max($selArr1),$selArr1);
            $max2 = array_search(max($selArr2),$selArr2);
            if($max1 == 10){
                $max1 = 0;
            }
            if($max2 == 10){
                $max2 = 0;
            }
            if(in_array($max1,$num1)){
                $num1= NoRand(0,9,7);
            }
            if(in_array($max2,$num2)){
                $num2= NoRand(0,9,7);
            }
            $code = implode(',',$num1).'|'.implode(',',$num2);
            $data = [
                'nums'=>$code
            ];
        }

        $info = M('lottery')->where(['sign'=>$sign])->find();
        if($info['is_auto'] == 0){
            $data['nums'] = '';
        }
        return M('lottery')->where(['sign'=>$sign])->save($data);
    }

}