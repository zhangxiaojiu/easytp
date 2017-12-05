<?php

Class IndexAction extends SystemAction{

	Public function index(){
		$this-> lists = M('news')->where(array('cid'=>1))->order('uptime desc')->select();
		$this->display();
	}
	Public function about(){
		$this-> about = M('news')->where(array('cid'=>2))->find();
		
		$this->display();
	}
	Public function jiaru(){
		$this-> about = M('news')->where(array('cid'=>4))->find();
		
		$this->display('about');
	}
	Public function lianxi(){
		
		$this-> about = M('news')->where(array('cid'=>3))->find();
		$this->display('about');
	}
	Public function boot(){
		
		$this-> slider = M('adv')->where(array('del'=>0))->select();
		$this->display('boot');
	}
	//投诉
	Public function complaint(){
		$this->display();
	}
	Public function doComplaint(){
		$ip = get_client_ip();
		$date = date('Ymd');
		$data = [
			'name' => isset($_POST['name'])?$_POST['name']:null,
			'brand' => isset($_POST['brand'])?$_POST['brand']:null,
			'manager' => isset($_POST['manager'])?$_POST['manager']:null,
			'detail' => isset($_POST['detail'])?$_POST['detail']:null,
			'ip' => $ip,
			'date' => $date
		];
		if ($data['name']=='') {
			$this->error('代理商姓名不能为空！');
		}
		if ($data['brand']=='') {
			$this->error('品牌不能为空！');
		}
		if ($data['detail']=='') {
			$this->error('投诉详情不能为空！');
		}
		if(M('complaint')->where(array('ip'=>$ip,'date'=>$date))->find()){
			$this->error('每人每天只可以投诉一次');
		}
		if ($_FILES['img']['size'] !== 0 && $_FILES) {
			$info = $this->UpImg();
			$data['images']= '/Public/images/complaint/thumb_'.$info[0]['savename'];
		}
		if (M('complaint')->add($data)) {
			$this->success('提交成功');
		}else{
			$this->error('提交失败！');
		}
	}
	//上传缩略图
	Public function UpImg(){
		import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 50000000;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/images/complaint/';// 设置附件上传目录
			$upload->thumb = true;
			$upload->thumbMaxWidth = 500;
			$upload->thumbMaxHeight = 500;
			$upload->thumbRemoveOrigin = true;
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
	 		}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				return $info;
	 		}
	}
}


?>