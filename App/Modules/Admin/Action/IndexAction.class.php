<?php
Class IndexAction extends CommonAction{

	Public function Index(){
		$this->display();
	}
	Public function LoginOut(){
		session_unset();
		session_destroy();
        redirect(GROUP_NAME . '/Login/index');
	}
}
?>
