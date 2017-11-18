<?php
Class SystemAction extends Action{
	Public function _initialize(){
		$this-> web = F('system','',CONF_PATH);
		$this-> nav = M('cate')->where(array('pid'=>0))->order('sort')->select();
	}
}