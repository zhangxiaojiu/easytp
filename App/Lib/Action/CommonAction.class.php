<?php
Class CommonAction extends Action{
	Public function _initialize(){
		if (!isset($_SESSION['uid'])) {
            redirect(GROUP_NAME . '/Login/index');
		}
	}
}