<?php
Class NewsAction extends CommonAction{

	Public function index(){
		import('Class.Catelevel',APP_PATH);
		$cate = M('cate')->where(array('lid'=>0))->select();
		$this-> cate = Catelevel::unlimitedForLevel($cate);

		if (!$_POST['sea_cid'] || $_POST['sea_cid'] == 0) {
			$news = M('news')->where(array('del'=>0,'lid'=>0))->order('uptime DESC')->select();
		}else{
			$news = M('news')->Where(array('del'=>0,'lid'=>0,'cid' => $_POST['sea_cid']))->order('uptime DESC')->select();
		}
		foreach($news as $k => $v){
			$cate = M('cate')->field('catename')->find($v['cid']);
			$news[$k]['catename']= $cate['catename'];
		}
		$this->news = $news;
		$this->display();
	}

	Public function AddNews(){
		import('Class.Catelevel',APP_PATH);
		$cate =M('cate')->Where('lid != 1')->select();
		$this-> cate =Catelevel::unlimitedForLevel($cate);
		$this->display();
	}

	Public function RunAddNews(){
		if (!$_POST['title']) {
			$this->error('标题不能为空！');
		}
		if ($_POST['cid']==0) {
			$this->error('请选择文章所属分类！');
		}
		$data=array(
 			'title' => $_POST['title'],
 			'cid' => $_POST['cid'],
 			'lid' => $_POST['lid'],
 			'content' => $_POST['content'],
 			'del' => 0,
 			'addtime' => time(),
 			'uptime' => time()
 			);
		if ($_FILES['simage']['size'] !== 0 && $_FILES) {
			$info = $this->UpImg();
			$data['simage']= '/Upload/images/'.date('Ym', time()).'/thumb_'.$info[0]['savename'];
		}
 		if (M('news')->add($data)) {
 			$this->success('添加成功!',U(GROUP_NAME.'/News/index'));
 		}else{
 			$this->error('添加失败！');
 		}
	}
	Public function operNew(){
		if (I('op') == 'refresh') {
			$data = array(
				'id' => (int) $_GET['id'],
				'uptime' => time()
				);
			if (M('news')->save($data)) {
				$this->success('刷新成功！');
			}else{
				$this->error('刷新失败！');
			}
		}elseif (I('op') == 'del') {
			$data = array(
				'id' => (int) $_GET['id'],
				'del' => 1,
				'uptime' => time()
				);
			if (M('news')->save($data)) {
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！');
			}
		}elseif (I('op') == 'edit') {
			import('Class.Catelevel',APP_PATH);
			$cate =M('cate')->Where('lid != 1')->select();
			$this-> cate =Catelevel::unlimitedForLevel($cate);
			$id = (int)$_GET['id'];
			$this-> news = M('news')->find($id);
			$this->display('EditNews');
		}elseif(I('op') == 'reduction'){
			$data = array(
				'id' => (int) $_GET['id'],
				'del' => 0
				);
			if (M('news')->save($data)) {
				$this->success('还原成功！');
			}else{
				$this->error('还原失败！');
			}
		}elseif (I('op') == 'delete'){
			if(M('news')->delete(I('id'))){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！');
			}
		}else{
			$this->error('非法操作！');
		}
	}

	Public function RunEditNews(){
		if (!$_POST['title']) {
			$this->error('标题不能为空！');
		}
		$data=array(
 			'id' => $_POST['id'],
 			'title' => $_POST['title'],
 			'cid' => $_POST['cid'],
 			'content' => $_POST['content'],
 			'del' => 0,
 			'uptime' => time()
 			);
		if ($_FILES['simage']['size'] !== 0 && $_FILES ) {
			$info = $this->UpImg();
			$data['simage']='/Upload/images/'.date('Ym', time()).'/thumb_'.$info[0]['savename'];
		}
 		if (M('news')->save($data)) {
 			$this->success('修改成功!',U(GROUP_NAME.'/News/index'));
 		}else{
 			$this->error('修改失败！');
 		}
	}

	//回收站
	Public function BackNews(){
		import('Class.Catelevel',APP_PATH);
		$cate = M('cate')->where(array('lid'=>0))->select();
		$this-> cate = Catelevel::unlimitedForLevel($cate);

		if (!$_POST['sea_cid'] || $_POST['sea_cid'] == 0) {
			$news = M('news')->where(array('del'=>1))->order('uptime DESC')->select();
		}else{
			$news = M('news')->Where(array('del'=>1,'cid' => $_POST['sea_cid']))->order('uptime DESC')->select();
		}
		foreach($news as $k => $v){
			$cate = M('cate')->field('catename')->find($v['cid']);
			$news[$k] += $cate;
		}
		$this->news = $news;
		$this->display('index');
	}

	//单网页
	Public function Webhtml(){
		$id = (int)$_GET['id'];
		$news = array();
		$new = M('news')->where(array('cid'=>$id))->find();
		$cate = M('cate')->field('catename,lid')->find($id);
		$news['title']= $cate['catename'];
		$news['lid'] = $cate['lid'];
		$news['cid'] = $id;
		if (!$new) {
			$this-> news = $news;
			$this->display('AddNews');
		}else{
			$news += $new;
			$this-> news = $news;
			$this->display('EditNews');
		}
	}

	Public function Html(){
		import('Class.Catelevel',APP_PATH);
		$cate = M('cate')->where(array('lid'=>1))->select();
		$this-> cate = Catelevel::unlimitedForLevel($cate);

		if (!$_POST['sea_cid'] || $_POST['sea_cid'] == 0) {
			$news = M('news')->where(array('del'=>0,'lid'=>1))->order('uptime DESC')->select();
		}else{
			$news = M('news')->Where(array('del'=>0,'lid'=>1,'cid' => $_POST['sea_cid']))->order('uptime DESC')->select();
		}
		foreach($news as $k => $v){
			$cate = M('cate')->field('catename')->find($v['cid']);
			$news[$k]['catename']= $cate['catename'];
		}
		$this->news = $news;
		$this->display('index');
	}

	//上传缩略图
	Public function UpImg(){
		import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 2000000;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Upload/images/'.date('Ym', time()).'/';// 设置附件上传目录
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