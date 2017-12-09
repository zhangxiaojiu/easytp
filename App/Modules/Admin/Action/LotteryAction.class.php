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
        $name = I('request.name','');
        $api = I('request.api','');
        $nums = I('request.nums','');
        $is_auto = I('request.is_auto')?1:0;
        if(empty($name)){
            $this->error('请完善信息');
        }else{
            $data = [
                'uid' => $uid,
                'name' => $name,
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
    //删除导航
    Public function delNav()
    {
        $id = I('request.id','');
        if(empty($id)){
            $this->error('参数错误');
        }
        M('nav')->delete($id);
        $this->redirect('index');
    }
    //删除导航列表
    Public function delNavList()
    {
        $id = I('request.id','');
        if(empty($id)){
            $this->error('参数错误');
        }
        M('navList')->delete($id);
        $this->redirect('index');
    }
    //设为首页导航
    Public function indexNav()
    {
        $id = I('request.id','');
        $uid = session('uid');
        if(empty($id)){
            $this->error('参数错误');
        }
        $data['state'] = 0;
        M('nav')->where(['uid'=>$uid])->save($data);
        $data['state'] = 1;
        M('nav')->where(['id'=>$id])->save($data);
        $this->redirect('index');
    }

    //导航列表详情页
    Public function navListInfo(){
        $id = I('request.id','');
        $uid = session('uid');
        if(!empty($id)){
            $info = M('navList')->where(['id'=>$id])->find();
            $this->assign('info',$info);
        }else{
            $this->assign('nid',I('request.nid',0));
        }
        $navList = M('nav')->where(['uid'=>$uid])->select();
        $this->assign("navList",$navList);
        $this->display();
    }
    //运行添加导航列表详情
	Public function runNavListInfo(){
        $id = I('request.id','');
        $nid = I('request.nid','');
        $name = I('request.name','');
        $type = I('request.type','');
        $value = I('request.value','');
        $sort = I('request.sort','');
        if($nid == 0){
            $this->error('请选择导航列表');
        }
        if(empty($name) || empty($type) || empty($value)){
            $this->error('请完善信息');
        }else{
            $data = [
                'nid' => $nid,
                'name' => $name,
                'type' => $type,
                'value' => $value,
                'sort' => $sort,
                'create_time' => date('Y-m-d H:i:s'),
            ];
        }
        if(empty($id)){
            //添加
            if(M('navList')->add($data)){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败');
            }
        }else{
            //更新
            $data['id'] = $id;
            if(M('navList')->save($data)){
                $this->success('保存成功','index');
            }else{
                $this->error('保存失败');
            }
        }
	}
}