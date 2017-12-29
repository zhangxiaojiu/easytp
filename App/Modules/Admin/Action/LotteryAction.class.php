<?php
Class LotteryAction extends CommonAction{
    //列表页
	Public function index(){
	    $uid = session('uid');
	    $where = [
	        'uid' => $uid,
        ];
		$list = M('lottery')->where($where)->select();
		$this->assign('list',$list);
		$this->display();
	}
    //彩票详情页
    Public function lotteryInfo(){
        $id = I('request.id','');
        if(!empty($id)){
            $info = M('lottery')->where(['id'=>$id])->find();
            $this->assign('info',$info);
        }
        $this->display();
    }
	//添加修改彩票
    Public function runLotteryInfo(){
        $id = I('request.id','');
        $uid = session('uid');
        $plan = I('request.plan','');
        $term = I('request.term','');
        $logo = I('request.logo','');
        $termNum = I('request.term_num','');
        $name = I('request.name','');
        $sign = I('request.sign','');
        $api = I('request.api','');
        $nums = I('request.nums','');
        $is_auto = I('request.is_auto')?1:0;
        if(empty($name)){
            $this->error('请完善信息');
        }else{
            $data = [
                'uid' => $uid,
                'name' => $name,
                'plan' => $plan,
                'term' => $term,
                'logo' => $logo,
                'term_num' => $termNum,
                'sign' => $sign,
                'api' => $api,
                'nums' => $nums,
                'is_auto' => $is_auto,
                'state' => 1,
            ];
        }
        if(empty($id)){
            //添加
            if(M('lottery')->add($data)){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败');
            }
        }else{
            //更新
            $data['id'] = $id;
            if(M('lottery')->save($data)){
                $this->success('保存成功','index');
            }else{
                $this->error('保存失败');
            }
        }
    }
    /*
     * 禁用、启用彩票
     */
    public function runState(){
        $id = I('request.id','');
        if(empty($id)){
            $this->error('参数错误');
        }
        $info = M('lottery')->where(['id'=>$id])->find();
        $data['id'] = $info['id'];
        if($info['state'] == 0){
            $data['state'] = 1;
        }else{
            $data['state'] = 0;
        }
        M('lottery')->save($data);
        $this->redirect('index');
    }

    /*
     * 计划数据
     */
    public function lotteryPlan(){
        $id = I('request.id','');
        if(empty($id)){
            $this->error('参数错误');
        }
        $info = M('lottery')->where(['id'=>$id,'state'=>1])->find();
        if(!$info){
            $this->error('当前计划不可用');
        }
        $url = $info['api'];
        $ret = http($url);
        $arr = json_decode($ret);
        p($arr);
        $this->display();
    }

    /*
     * 历史统计
     */
    public function history(){
        $list = [
            0 => [
                'sign' => 'cqssc',
                'name' => '重庆时时彩',
            ],
            1 => [
                'sign' => 'bjpk10',
                'name' => '北京赛车PK10',
            ],
            2 => [
                'sign' => 'ffcqq',
                'name' => '腾讯分分彩',
            ],
        ];

        foreach($list as $v){
            $temp = [];
            $data = [];
            $data['plan'] = $v['name'];
            $sign = $v['sign'];
            $con = [
                'opentime' => array('like',date('Y-m-d').'%'),
                'sign' => $sign,
            ];
            $res = M('lotteryPlan')->where($con)->select();
            foreach($res as $val){
                $code = explode(',',$val['opencode']);
                foreach($code as $k => $vo){
                    if($k > 4){
                        break;
                    }
                    $temp[$k][$vo]++;
                }
                $data['record'] = $temp;
            }
            $ret[] = $data;
        }
        $this->assign('ret',$ret);
        $this->display();
    }
}