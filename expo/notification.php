<?php include('info.php'); include('config.php'); if(isset($_GET['logout'])){ header("Refresh: 3; url= ./ajx.html"); session_destroy();
  Echo "Logged Out , Please Login Again To Get All The Site Feature's.";
  

}

if(isset($_SESSION['type']) && $_SESSION['type'] =="Fulfillment"){
    header("Refresh: 3; url= ./Fulfillment/Fulfillment.php");

}
?>
<html>
    <head>
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "fcf8ec4c-468e-4fcf-9c03-526f2f59f33a",
    });
  });
</script>
        <link rel="icon" href="https://cedarslandshoes.com/expo/photo/ExpoLogo.jpg">

        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
        <link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" href="css/material.min.css">
				<link rel="stylesheet" href="css/mysheet.css">

<script src="js/material.min.js"></script>
<script src="js/myscripts.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <script>window['LSID'] = 0; </script>
  </script>
    </head>
    
  <body id="body">
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">Index.</span>
         
      </header>
      <div class="mdl-layout__drawer">
      <span class="mdl-layout-title"><div id="meee"> <a href='index.php'> EXPO</a></div></span>
        <nav class="mdl-navigation">
        <?php if(isset($_SESSION['type']) && ($_SESSION['type']=="worker")){
          include ('DefUserOptions.php');
        }        
           else if(isset($_SESSION['type']) && ($_SESSION['type']=="admin")){
            include('AdminOptions.php');
          }else{
echo"You Need To Login First!";
         }
          ?>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="page-content"><!-- Your content goes here -->
        <div class="preload" align="center">
  
     <div class="preload">
        
<?PHP
include("./config.php");
    echo 'The Weekly Board :';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE reserve_date >= NOW() - INTERVAL 7 DAY AND (multiple_reserve_status = 'Fulfillment' OR multiple_reserve_status = 'Sended')  GROUP BY multiple_reserve_worker_id ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '<BR><BR>The Weekly Job Done By Workers
     <hr> <BR><BR><BR>';
 while($row = mysqli_fetch_assoc($result)){
   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment <strong>";
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In The Last 7 Days. With Total Price: <strong>".$row['SUM(reserve_full_price)']." LBP</strong> <hr>";
 }
 echo"<BR><BR>Clients Need To Be Served ! ,Go Ahead, Make a Hit..";
?>
	<bR><BR><BR>	<div align="center">
      Codded By Rami Shook<br>
      FOR More Details : 79103686

   
	  
		
		
</div>
		 <div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>
<audio src="./assets/ios_notification.mp3" id="AD" hidden = true> </audio>
		
      </main>
    </div>
  
       
    </body>
    
    <script>
    /*
    function chkx(){
 
    let d = new Date();
let timestamp = d.getTime();
              var xmlhttp;
if(window.XMLHttpRequest)
xmlhttp = new XMLHttpRequest(); 


xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
if (LSID != xmlhttp.responseText){ /// iff theres new id in the php file
    
    
    LSID = xmlhttp.responseText;
    
    
    
      (function(){
    'use strict';
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var data = {message: 'New Order ! '+LSID,
                      timeout: 6000
    };
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
  }());
document.getElementById('AD').play();
    
}
}

xmlhttp.open("GET","./LastChecked.php?ord&timestamp="+timestamp,false);
xmlhttp.send();   
}


window.setInterval(function(){
chkx()}, 2000);
*/
    </script>
	
</html>
