<?php
Class AdvAction extends CommonAction{
	Public function index(){
		$this-> ad =M('adv')->where(array('del'=>0))->select();
		$this->display();
	}

	Public function AddAd(){
		$this->display();
	}

	Public function EditAd(){
		$this-> ad = M('adv')->find($_REQUEST['id']);
		$this->display();
	}

	Public function RunAddAd(){
		if (!I('title')) {
			$this->error('描述不能为空！');
		}
		$data = array(
			'title' => $_POST['title'],
			'addtime' => time(),
			'link' => $_POST['link']
			);
		if ($_FILES['img']['size'] !== 0 && $_FILES) {
			$info = $this->UpImg();
			$data['img']= '/Public/images/Ad/'.$info[0]['savename'];
		}
		if(M('adv')->add($data)){
			$this->success('添加成功！');
		}else{
			$this->error('添加失败！');
		}

	}

	Public function RunEditAd(){
		if (!I('title')) {
			$this->error('描述不能为空！');
		}
		$data = array(
			'id' => $_POST['id'],
			'title' => $_POST['title'],
			'addtime' => time(),
			'link' => $_POST['link']
			);
		if ($_FILES['img']['size'] !== 0 && $_FILES) {
			$info = $this->UpImg();
			$data['img']= '/Public/images/Ad/'.$info[0]['savename'];
		}else{}
		if(M('adv')->save($data)){
			$this->success('修改成功！');
		}else{
			$this->error('修改失败！');
		}

	}

	Public function DelAd(){
		$data=array(
			'id'=>$_REQUEST['id'],
			'del'=>1
			);
		if (M('adv')->save($data)) {
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}

	}


	//上传IMg
	Public function UpImg(){
		import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 2000000;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/images/Ad/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
	 		}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				return $info;
	 		}
	}
}