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
	
	/*
	 * type is :adv/user
	 */
	public static function uploadPic($type,$file){
        
		if(empty($type))$type = "default";
		
		$image = CUploadedFile::getInstanceByName($file);
		$time = date("Ymd");
		$root = Yii::getPathOfAlias('webroot');
		$baseUrl = '/static/'.$type.'/';
		$path = $root.$baseUrl;
		
		$dir = $path.$time.'/';//上传目录
        
		if (!is_dir($path)) {
            mkdir($path); //目录不存在则创建
        }
		
		if (!is_dir($dir)) {
            mkdir($dir); //目录不存在则创建
        }
		
        $name = $type."_".uniqid().Helper::getHashLower(8).".".$image->getExtensionName(); //文件名绝对路径
        $status = $image->saveAs($dir.$name,true); //保存文件
		if($status == true){
			return $baseUrl.$time."/".$name;
		}else{
			return $status;
		}
	}
}