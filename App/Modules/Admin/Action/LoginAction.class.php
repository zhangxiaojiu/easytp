<?php
Class LoginAction extends Action{

	Public function index(){
		$this->display();
	}

	Public function login(){
		//dump($_POST);
		if(!IS_POST) halt('页面不存在！');

		//if( session('verify') != md5(I('code'))) $this->error('验证码错误！');

		$db = M('user');
		$user = $db->where(array('username' => I('username'))) ->find();

		if(!$user || $user['password'] !== I('password','' ,'md5')){

			$this->error('账号或密码错误！');			
		}

		$data = array(
			'id' => $user['id'],
			'logintime' => time(),
			'loginip' => get_client_ip()
			);
		$db->save($data);

		session('uid',$user['id']);
		session('username',$user['username']);
		session('logintime',date('Y-m-d H:i:s',$user['logintime']));
		session('loginip',$user['loginip']);
		redirect(__GROUP__);
	}
	Public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
}