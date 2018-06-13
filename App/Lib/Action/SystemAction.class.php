<?php
Class SystemAction extends Action{
	Public function _initialize(){
		$this-> web = F('system','',CONF_PATH);
	}
}