<?php
error_reporting('E_ERROR');
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/class.phpmailer.php';
ini_set('display_errors', '0');		
	function logToFile($filename, $msg)
	{
		$fd = fopen($filename, "a");
		$str = "[" . date("Y/m/d h:i:s", time()) . "] " . $msg;
		fwrite($fd, $str . "\n");
		fclose($fd);
	}
	function randomNumber($length) {
		$result = '';
	
		for($i = 0; $i < $length; $i++) {
			$result .= mt_rand(0, 9);
		}
	
		return $result;
	}
	function MS_deleteCookie( $name ){
		setcookie($name, "", time() - 3600);
	}
	function MS_setCookie( $name, $value){
		setcookie($name, $value."", time() + ( 2 * 7 * 24 * 60 * 60));
	}
	function MS_generateRandom( $len ){
		$strpattern = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
		$result = "";
		for( $i = 0 ; $i < $len; $i ++ ){
			$rand = rand( 0, strlen($strpattern) - 1 );
			$result = $result.$strpattern[$rand];
		}
		return $result;
	}
	function MS_isLogin(){
		if( MS_isStay() ){
			$userId = MS_getCookie("MS_TOKEN");
			$userType = MS_getCookie("MS_TYPE");
			if( $userId != "" ){
				$_SESSION['PA_RESIDENT'] = $userId;
				$_SESSION['PA_TYPE'] = $userType;
				return true;
			}else{
				return false;
			}
		}else{
			if(isset($_SESSION['PA_RESIDENT'])){
				return true;
			}else{
				return false;
			}
		}
	}
	function Program_isLogin(){
		if( MS_isStay() ){
			$userId = MS_getCookie("MS_TOKEN");
			$userType = MS_getCookie("MS_TYPE");
			if( $userId != "" ){
				$_SESSION['PA_PROGRAM'] = $userId;
				$_SESSION['PA_TYPE'] = $userType;
				return true;
			}else{
				return false;
			}
		}else{
			if(isset($_SESSION['PA_PROGRAM'])){
				return true;
			}else{
				return false;
			}
		}
	}
	function MS_sendEmail( $email, $subject, $message ){
		$mail = new PHPMailer();
		$mail->IsSMTP();     // telling the class to use SMTP
		$mail->SMTPDebug = 1;           // enables SMTP debug information (for testing)
		
		$mail->SMTPAuth   = true;                    // enable SMTP authentication
		$mail->SMTPSecure = "tls";                   // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";        // sets GMAIL as the SMTP server
		$mail->Port       = 587;                     // set the SMTP port for the GMAIL server
		$mail->Username   = "mickyjack123@gmail.com";  // GMAIL username
		$mail->Password   = "minister1992";            // GMAIL password
		
		$mail->SetFrom("noreply@patientlogs.com", "");
		$mail->Subject    = $subject;
		$mail->AltBody    = "";     // optional, comment out and test
		$mail->MsgHTML($message);
		
		$mail->AddAddress($email);
		if(!$mail->Send()) {
				return;
			} else {
		}	
	}
	function MS_isStay(){
		if( isset($_COOKIE['MS_TOKEN']) && $_COOKIE['MS_TOKEN']!= ""){
			return true;
		}else{
			return false;
		}
	}

	function MS_getCookie( $name ){
		return $_COOKIE[$name];
	}

	function PA_MkDir($path, $mode = 0777) {
		$dirs = explode(DIRECTORY_SEPARATOR , $path);
		$count = count($dirs);
		$path = '.';
		for ($i = 0; $i < $count; ++$i) {
			$path .= DIRECTORY_SEPARATOR . $dirs[$i];
			if (!is_dir($path) && !mkdir($path, $mode)) {
				return false;
			}
		}
		return true;
	}

	function PA_generateRandom( $len ){
		$strpattern = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
		$result = "";
		for( $i = 0 ; $i < $len; $i ++ ){
			$rand = rand( 0, strlen($strpattern) - 1 );
			$result = $result.$strpattern[$rand];
		}
		return $result;
	}

	function PA_isLogin(){
		if( MS_isStay() ){
			$userId = MS_getUserIdFromToken();
			if( $userId != "" ){
				$_SESSION['MS_USER'] = $userId;
				return true;
			}else{
				return false;
			}
		}else{
			if( isset($_SESSION['MS_USER']) && $_SESSION['MS_USER'] != "" ){
				return true;
			}else{
				return false;
			}
		}
	}

	function PA_isStay(){
		if( isset($_COOKIE['MS_TOKEN'])){
			return true;
		}else{
			return false;
		}
	}

	function PA_setCookie( $name, $value){
		setcookie($name, $value."", time() + ( 2 * 7 * 24 * 60 * 60));
	}

	function PA_getCookie( $name ){
		return $_COOKIE[$name];
	}

	function PA_deleteCookie( $name ){
		setcookie($name, "", time() - 3600);
	}
	
	function PA_getUserIdFromToken( ){
		$userToken = MS_getCookie("MS_TOKEN");
		global $db;
		if( MS_isStay() ){
			$sql = "select ms_user from ms_user where ms_token = '$userToken'";
			$result = $db->queryArray( $sql );
			if( $result == null )
				return "";
			else
				return $result[0]['ms_user'];
		}else
			return "";
	}

	function PA_getSetting( $id ){
		global $db;
		$sql = "select * from ms_setting where ms_setting = $id";
		$dataResult = $db->queryArray( $sql );
		return $dataResult[0]['ms_content'];
	}

	function PA_getUserInfo( $id ){
		global $db;
		$sql = "select * from ms_user where ms_user = $id";
		$dataUser = $db->queryArray( $sql );
		return $dataUser[0];
	}

	function PA_sendEmail( $email, $subject, $message ){
		$mailer = new PHPMailer();
		$mailer->CharSet = 'utf-8';
		$mailer->IsMail();
		$mailer->Sender = MS_NOREPLY_EMAIL;
		$mailer->From = MS_NOREPLY_EMAIL;
		$mailer->FromName = $subject;
		$mailer->AddAddress($email, SITE_NAME);
		$mailer->WordWrap = 70;
		$mailer->IsHTML(FALSE);
		$mailer->Subject = $subject;
		$mailer->Body = $message;
		return $mailer->Send();		
	}
	
	function PA_sendEmailFromTo( $to, $subject, $message ){
		$mailer = new PHPMailer();
		$mailer->CharSet = 'utf-8';
		$mailer->IsMail();
		$mailer->FromName = $subject;
		$mailer->AddAddress($to, SITE_NAME);
		$mailer->WordWrap = 70;
		$mailer->IsHTML(FALSE);
		$mailer->Subject = $subject;
		$mailer->Body = $message;
		return $mailer->Send();
	}
	
	function PA_isNotification( $userId ){
		$dataUser = MS_getUserInfo( $userId );
		if( $dataUser['ms_notification_yn'] == "Y" )
			return true;
		else
			return false;
	}

	function PA_generateSlug($s){
		$s = strtolower($s);
		$s = str_replace('@', ' at ', $s);
		$s = str_replace('%', ' percent ', $s);
		$s = str_replace('&', ' and ', $s);
		$s = str_replace('+', ' plus ', $s);
		$s = str_replace('=', ' equals ', $s);
		$s = str_replace('\'', '', $s);
		$s = str_replace('.', '', $s);
		$s = preg_replace('/[^A-Za-z0-9-]/', '-', $s);
		$s = preg_replace('/-+/', '-', $s);
		$s = trim($s, '-');
		return $s;
	}

	function PA_createSlugUrl( $type, $title ){
		$url = MS_generateSlug( $title );
		global $db;
		if( $type == "U" ){
			$sql = "select * from ms_user where and ms_seo_url = '$url'";
			$dataResult = $db->queryArray( $sql );
			if( $dataResult != null ){
				$url = $url."-".count($dataResult);
			}
		}else if( $type == "M" ){
			$sql = "select * from ms_music where and ms_seo_url = '$url'";
			$dataResult = $db->queryArray( $sql );
			if( $dataResult != null ){
				$url = $url."-".count($dataResult);
			}
		}else if( $type == "N" ){
			$sql = "select * from ms_notepad where and ms_seo_url = '$url'";
			$dataResult = $db->queryArray( $sql );
			if( $dataResult != null ){
				$url = $url."-".count($dataResult);
			}			
		}
		return $url;
	}
    
?>