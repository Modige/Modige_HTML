<?php

/////////// Add your own email below //////////////// 

	define("WEBMASTER_EMAIL", 'staff@modige.com');
	
	error_reporting (E_ALL ^ E_NOTICE);

//////////////////////////////////////////////////////

	function ValidateEmail($email)
	{
		$regex = '/([a-z0-9_.-]+)'. # name
		'@'. # at
		'([a-z0-9.-]+){2,255}'. # domain & possibly subdomains
		'.'. # period
		'([a-z]+){2,10}/i'; # domain extension 
		
		if($email == '') 
			return false;
		else
			$eregi = preg_replace($regex, '', $email);
		return empty($eregi) ? true : false;
	}

//////////////////////////////////////////////////////

	$post = (!empty($_POST)) ? true : false;
	
	if($post)
	{
		$name 	 = stripslashes($_POST['name']);
		$email 	 = trim($_POST['email']);
		$subject = trim($_POST['subject']);
		$message = stripslashes($_POST['message']);
	
		$error = '';
	
		// Check name
		if(!$name)
			$error .= 'Sorry, we did not get your name. Can you please go back and try again?';
	
		// Check email
		if(!$email)
			$error .= 'We cannot help you without your email address. Please go back and re-enter it.';
	
		if($email && !ValidateEmail($email))
			$error .= 'E-mail address is not valid. Could you please Go back and re-enter it? ';
	
		// Check message
		if(!$message)
			$error .= "Sorry, we did not get that. Please enter your message. ";
	
		if(!$error)
		{
			$mail = @mail(WEBMASTER_EMAIL, $subject, $message,
				 "From: ".$name." <".$email.">\r\n"
				."Reply-To: ".$email."\r\n"
				."Return-Path: " .$email. "\r\n"
				."MIME-Version: 1.0\r\n"	
				."Content-type: text/html; charset=UTF-8\r\n");
			
			if($mail){
				  print "<meta http-equiv=\"refresh\" content=\"0;URL=contactthanks.html\">";
			}else{
				  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
			}
		}
		else
			print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
	}
	

?>