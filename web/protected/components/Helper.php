<?php
class Helper{
	
	public static function ajaxJsonMsg($message){
		echo json_encode($message);
		exit;
	}

	public static function interrupt(&$action,$message,$state,$redirect='',$interval=10,$clue="",$extMessage=""){
		if($state == 1){
			$tpl = "/site/info";
		}else{
			$tpl = "/site/info";
		}

		if(empty($clue))$clue = "点击跳转";
		$action->body = "single";
		$action->layout='//layouts/main_nonav';
		$data["message"] = $message;
		$data["redirect"] = $redirect;
		$data["interval"] = $interval;
		$data["clue"] = $clue;
		$data["extMessage"] = $extMessage;

		$action->render($tpl,$data);
		exit;
	}

	public static function getHash($length){
		
		$hash = "";
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		mt_srand((double)microtime() * 1000000);
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		return $hash;
		//$content = uniqid().$random; // 类似 5443e09c27bf4aB4uT
		//return sha1($content);
	}

	public static function getHashLower($length){
		
		$hash = "";
		$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$max = strlen($chars) - 1;
		mt_srand((double)microtime() * 1000000);
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		return $hash;
		//$content = uniqid().$random; // 类似 5443e09c27bf4aB4uT
		//return sha1($content);
	}
}