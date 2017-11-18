<?php

	/**
		 * 系统邮件发送函数
		 * @param string $to    接收邮件者邮箱
		 * @param string $name  接收邮件者名称
		 * @param string $subject 邮件主题 
		 * @param string $body    邮件内容
		 * @param string $attachment 附件列表
		 * @return boolean 
		 */
		function think_send_mail($to,$name, $subject = '', $body = '', $attachment = null){
		    $config = F('message','', CONF_PATH);
		    vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件
		    $mail             = new PHPMailer(); //PHPMailer对象
		    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
		    $mail->IsSMTP();  // 设定使用SMTP服务
		    $mail->SMTPDebug  = 1;                     // 关闭SMTP调试功能
		                                               // 1 = errors and messages
		                                               // 2 = messages only
		    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
		    $mail->SMTPSecure = 'ssl';                 // 使用安全协议
		    $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
		    $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
		    $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
		    $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
		    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
		    $replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
		    $replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
		    $mail->AddReplyTo($replyEmail, $replyName);
		    $mail->Subject    = $subject;
		    $mail->MsgHTML($body);
		    $mail->AddAddress($to, $name);
		    if(is_array($attachment)){ // 添加附件
		        foreach ($attachment as $file){
		            is_file($file) && $mail->AddAttachment($file);
		        }
		    }
		    return $mail->Send() ? true : $mail->ErrorInfo;
		}

		//字符串截取
		function only_text($data,$start=0,$end,$str='...'){
			$data = strip_tags($data);
			$data = mb_substr($data,$start,$end);
			$data .=$str;
			return $data;
		}

		//获取分类标题
		function get_catename($id){
			$catename = M('cate')->find($id);
			return $catename['catename'];
		}
		//获取广告
		function get_ads($id){
			$ad = M('adv')->where(array('del'=>0))->find($id);
			return $ad;
		}

	/**
		 * 发送HTTP请求方法
		 * @param  string $url    请求URL
		 * @param  array  $params 请求参数
		 * @param  string $method 请求方法GET/POST
		 * @return array  $data   响应数据
		 */
		function http($url, $params, $method = 'GET', $header = array(), $multi = false){
		    $opts = array(
		            CURLOPT_TIMEOUT        => 30,
		            CURLOPT_RETURNTRANSFER => 1,
		            CURLOPT_SSL_VERIFYPEER => false,
		            CURLOPT_SSL_VERIFYHOST => false,
		            CURLOPT_HTTPHEADER     => $header
		    );
		    /* 根据请求类型设置特定参数 */
		    switch(strtoupper($method)){
		        case 'GET':
		            $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
		            break;
		        case 'POST':
		            //判断是否传输文件
		            $params = $multi ? $params : http_build_query($params);
		            $opts[CURLOPT_URL] = $url;
		            $opts[CURLOPT_POST] = 1;
		            $opts[CURLOPT_POSTFIELDS] = $params;
		            break;
		        default:
		            throw new Exception('不支持的请求方式！');
		    }
		    /* 初始化并执行curl请求 */
		    $ch = curl_init();
		    curl_setopt_array($ch, $opts);
		    $data  = curl_exec($ch);
		    $error = curl_error($ch);
		    curl_close($ch);
		    if($error) throw new Exception('请求发生错误：' . $error);
		    return  $data;
		}

?>