<?php
Class SetAction extends CommonAction{
	Public function index(){
		$this->set = F('system','',CONF_PATH);
		$this->display();
	}
	Public function Addset(){
		if (!I('webname')) {
			$this->error('网站名称不能为空！');
		}
		if (!I('weburl')) {
			$this->error('网站域名不能为空！');
		}

		$data = array(
			'webname' => $_POST['webname'], 
			'weburl' => $_POST['weburl'], 
			'keyword' => $_POST['keyword'],
			'description' => $_POST['description'], 
			'qqtalk' => $_POST['qqtalk'],
			'qqqun' => $_POST['qqqun'],
			);
		if ($_FILES['logo']['size'] !== 0 && $_FILES) {
			$info = $this->UpImg();
			$data['logo']= '/Public/images/logo/'.$info[0]['savename'];
		}else{
			$data['logo']= $_POST['blogo'];
		}
		F('system',$data,CONF_PATH);
        $this->success('修改成功！');

	}
	//上传LOGO
	Public function UpImg(){
		import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 2000000;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/images/logo/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
	 		}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				return $info;
	 		}
	}
	public function cache() { 
		header("Content-type: text/html; charset=utf-8");
		//清文件缓存
		$dirs = array('./Runtime/');
		@mkdir('Runtime',0777,true);
		//清理缓存
		foreach($dirs as $value) {
			$this->rmdirr($value);
		}
		$this->success('系统缓存清除成功！');
	} 
 
    
	public function rmdirr($dirname) {
		if (!file_exists($dirname)) {
			return false;
		}
		if (is_file($dirname) || is_link($dirname)) {
			return unlink($dirname);
		}
		$dir = dir($dirname);
		if($dir){
			while (false !== $entry = $dir->read()) {
				if ($entry == '.' || $entry == '..') {
					continue;
				}
				$this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
			}
		}
		$dir->close();
		return rmdir($dirname);
	}

	Public function lead(){
		$this->display();
	}
}