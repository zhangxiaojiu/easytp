<?php
Class MessageAction extends CommonAction{
	Public function Index(){
	 	$this-> data = F('message','',CONF_PATH);
	 	$this->display();
	}

	//保存设置
	Public function RunSet(){
	 	$date = $_POST;
	 	if (!$date['mess']) {
	 		$date['mess'] = 0;
	 	}
	 	if (!$date['email']) {
	 		$date['email'] = 0;
	 	}
	 	if (!$date['smtpkey']) {
	 		$date['smtpkey'] = 25;
	 	}
	 	if (F('message',$date,CONF_PATH)) {
	 		$this->success('修改成功！');
	 	}else{
	 		$this->error('修改失败！');
	 	}
	}

	Public function ToEmail(){
		$mes = F('message','',CONF_PATH);
		$to = $mes['TO_EMAIL'];
		$name = '测试信息';
		$subject = '这是测试信息';
		$body = '这是一条测试信息！恭喜你的邮箱设置成功！';
		if ($mes['email']) {
			$msg = think_send_mail($to,$name,$subject,$body);
			if ($msg) {
				$this->success('发送成功！');
			}else{
				$this->error('msg');
			}
		}else{
			$this->error('E-mail通知方式没有打开！');
		}
	}

	Public function MessList(){
		$Mess = M('messlist')->order('addtime DESC')->select();
		foreach ($Mess as $k => $v) {
			$Mess[$k]['mess'] = $v['mess'] ? '是' : '否';
			$Mess[$k]['email'] = $v['email'] ? '是' : '否';
		}
		$this-> mess = $Mess;
		$this->display();
	}

}