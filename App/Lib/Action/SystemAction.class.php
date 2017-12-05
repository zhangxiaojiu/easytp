<?php
Class SystemAction extends Action{
	Public function _initialize(){
		$this-> web = F('system','',CONF_PATH);
        $nid = M('nav')->where(['uid'=>1,'state'=>1])->find();
        $nav = M('navList')->where(['nid'=>$nid['id']])->order('sort')->select();
        $footContent = M('news')->where(['lid'=>1,'title'=>'底部说明'])->find()['content'];
        $notice = M('news')->where(['lid'=>1,'title'=>'网站公告'])->find()['content'];
        $this->assign('nav',$nav);
        $this->assign('footContent', $footContent);
        $this->assign('notice', $notice);
	}
}