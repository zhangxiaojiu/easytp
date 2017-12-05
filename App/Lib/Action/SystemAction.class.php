<?php
Class SystemAction extends Action{
	Public function _initialize(){
		$this-> web = F('system','',CONF_PATH);
        $nid = M('nav')->where(['uid'=>1,'state'=>1])->find();
        $nav = M('navList')->where(['nid'=>$nid['id']])->order('sort')->select();
        $this->assign('nav',$nav);
	}
}