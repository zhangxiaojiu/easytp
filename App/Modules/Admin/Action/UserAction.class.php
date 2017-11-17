<?php
Class UserAction extends CommonAction{
	Public function index(){
		$this->user = M('user')->select();
		$this->display();
	}

	Public function AddUser(){
		$this->display();
	}

	Public function RunAddUser(){
		if (!I('username')) {
			$this->error('用户名不能为空！');
		}
		if (!I('password') || !I('twopassword')) {
			$this->error('密码不能为空！');
		}
		if (I('password')!== I('twopassword')) {
			$this->error('两次输入的密码不一致！');
		}
		if (M('user')->Where(array('username'=>I('username')))->find()) {
			$this->error('用户名已存在！');
		}
		$data = array(
			'username' => I('username'),
			'password' => I('password','','md5'),
			'logintime' => time(),
			'loginip' => ""
			);
		if (M('user')->add($data)) {
			$this->success('添加成功',U(GROUP_NAME . '/User/index'));
		}else{
			$this->error('添加失败');
		}
	}

	Public function DelUser(){
		if (M('user')->delete(I('id'))) {
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}

	}

	Public function editUser(){
		if (!I('id')) {
			$this->error('参数丢失！');
		}
		$this->user = M('user')->find(I('id'));
		$this->display();
	}
	Public function RunEditUser(){
		if (!I('password')||!I('twopassword')) {
			$this->error('密码不能为空！');
		}
		if (I('password')!==I('twopassword')) {
			$this->error('两次输入的密码不一致！');
		}
		$date = array(
			'id' => I('id'),
			'password' => md5(I('password'))
			);
		if (M('user')->save($date)) {
			$this->success('修改成功',U(GROUP_NAME .'/User/index'));
		}else{
			$this->error('修改失败');
		}
	}
}