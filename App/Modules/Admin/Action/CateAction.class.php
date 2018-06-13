<?php
Class CateAction extends CommonAction{
	Public function index(){
		import('Class.Catelevel',APP_PATH);
		$cate = M('cate')->order('sort ASC')->select();
		$this-> cate = Catelevel::unlimitedForLevel($cate);
		$this->display();
	}

	Public function addCate(){
		$this -> pid = I('pid',0,'intval');
		$this->display();
	}

	Public function editCate(){
		$editcate =M('cate')->find(I('id'));
		$pcate = M('cate')->field('catename')->find($editcate['pid']);
		$editcate['pcate'] = $pcate['catename'];
		$this-> editcate=$editcate;
		$this->display();
	}

	Public function RuneditCate(){
		if (!I('catename')) {
			$this->error('栏目名称不能为空！');
		}
		if (M('cate')->save($_POST)) {
			$this->success('修改成功！',U(GROUP_NAME . '/Cate/index'));
		}else{
			$this->error('修改失败！');
		}
	}

	Public function RunAddCate(){
		if (!I('catename')) {
			$this->error('栏目名称不能为空！');
		}
		if (M('cate')->add($_POST)) {
			$this->success('添加成功！',U(GROUP_NAME . '/Cate/index'));
		}else{
			$this->error('添加失败！');
		}
	}

	Public function delCate(){
		if (M('cate')->delete(I('id'))) {
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
}