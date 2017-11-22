<?php
Class NavAction extends CommonAction{
    //列表页
	Public function index(){
	    $uid = session('uid');
	    $where = [
	        'uid' => $uid,
        ];
		$list = M('nav')->where($where)->select();
		foreach ($list as $k => &$v){
            $v['nav_list'] = M('navList')->where(['nid'=>$v['id']])->order('sort')->select();
        }
		$this->assign('list',$list);
		$this->display();
	}
    //导航详情页
    Public function navInfo(){
        $id = I('request.id','');
        if(!empty($id)){
            $info = M('nav')->where(['id'=>$id])->find();
            $this->assign('info',$info);
        }
        $this->display();
    }
	//添加修改添加导航
    Public function runNavInfo(){
        $id = I('request.id','');
        $uid = session('uid');
        $name = I('request.name','');
        if(empty($name)){
            $this->error('请完善信息');
        }else{
            $data = [
                'uid' => $uid,
                'name' => $name,
                'state' => 0,
                'create_time' => date('Y-m-d H:i:s'),
            ];
        }
        if(empty($id)){
            //添加
            if(M('nav')->add($data)){
                $this->success('添加成功','Index');
            }else{
                $this->error('添加失败');
            }
        }else{
            //更新
            $data['id'] = $id;
            if(M('nav')->save($data)){
                $this->success('保存成功','Index');
            }else{
                $this->error('保存失败');
            }
        }
    }
    //删除导航
    Public function delNavList()
    {
        $id = I('request.id','');
        if(empty($id)){
            $this->error('参数错误');
        }
        M('navList')->delete($id);
        $this->redirect('Index');
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
        $this->redirect('Index');
    }

    //导航列表详情页
    Public function navListInfo(){
        $id = I('request.id','');
        $uid = session('uid');
        if(!empty($id)){
            $info = M('navList')->where(['id'=>$id])->find();
            $this->assign('info',$info);
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