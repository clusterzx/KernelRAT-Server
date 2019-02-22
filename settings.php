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
  	 if(isset($_POST['change'])) {
  	  if($_POST['clog'] != null)  { $login = $_POST['clog'];          $mysqli->query("UPDATE administrators SET login='$login' WHERE id=1"); }
  	  if($_POST['cpass'] != null) { $password = md5($_POST['cpass']);  $mysqli->query("UPDATE administrators SET pass='$password' WHERE id=1"); }
  	  if($_POST['apass'] != null) { $key = md5($_POST['apass']);      $mysqli->query("UPDATE administrators SET apass='$key' WHERE id=1"); }
  	  header("Location: index.php?i=cauth");
  	 }
  	} elseif( ($result['login'] == "") and ($result['pass'] == "") ) {
	 if(isset($_POST['change'])) {
  	  if($_POST['clog'] != null)  { $login = $_POST['clog'];          $mysqli->query("UPDATE administrators SET login='$login' WHERE id=1"); }
  	  if($_POST['cpass'] != null) { $password = md5($_POST['cpass']);  $mysqli->query("UPDATE administrators SET pass='$password' WHERE id=1"); }
  	  if($_POST['apass'] != null) { $key = md5($_POST['apass']);      $mysqli->query("UPDATE administrators SET apass='$key' WHERE id=1"); }
  	  header("Location: index.php?i=cauth");
  	 }
  	} else { header("Location: index.php?i=eauth"); exit; }

?>
<html>
 <head>
  <title>- Settings -</title>
  <link rel="stylesheet" href="assets/css/style.css" media="screen" type="text/css" />
 </head>
 <body>
  <nav class="header">
   <?php if( ($result['login'] != "") and ($result['pass'] != "") ) { 
   	echo "<p class=\"text-tag\">"; echo $result['login']; 
    echo " <input class=\"header-button\" style=\"margin-left: 15px;\" type=\"button\" value=\"Users\" onClick='location.href=\"admin.php\"'>";
    echo " <input class=\"header-button\" type=\"button\" value=\"Settings\" onClick='location.href=\"settings.php\"'>";
    echo "<input class=\"header-logout\" type=\"button\" value=\"Logout\" onClick='location.href=\"logout.php\"'>";
    echo "</p>";
   } else { echo "<p class=\"text-tag\">Panel configuration</p>";  } ?>
  </nav>

  <form action="settings.php" method="post">
   <div class="settings-box">
   	<input class="settings-input-field" type="text" name="clog" placeholder="Login" autocomplete="off" <?php if( ($result['login'] == "") and ($result['pass'] == "") ) { echo "required"; }?> >

   	<input class="settings-input-field" type="password" name="cpass" placeholder="Password" autocomplete="off" <?php if( ($result['login'] == "") and ($result['pass'] == "") ) { echo "required"; }?> >

   	<input class="settings-input-field" type="password" name="apass" placeholder="Access key" autocomplete="off" <?php if( ($result['login'] == "") and ($result['pass'] == "") ) { echo "required"; }?> >

   	<input class="settings-button" type="submit" name="change" <?php if( ($result['login'] == "") and ($result['pass'] == "") ) { echo "value=\"Set\""; } else { echo "value=\"Change\""; } ?>>  
   </div>
  </form>
 </body>
</html>