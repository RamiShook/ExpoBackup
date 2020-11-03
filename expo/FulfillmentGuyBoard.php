<?php include('info.php'); include('config.php'); if(isset($_GET['logout'])){ header("Refresh: 3; url= ./ajx.html"); session_destroy();
  Echo "Logged Out , Please Login Again To Get All The Site Feature's.";
  

}

if(isset($_SESSION['type']) && $_SESSION['type'] =="Fulfillment"){
    header("Refresh: 3; url= ./Fulfillment/Fulfillment.php");

}
?>
<html>
    <head>
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
  echo 'Count Checked Orders After 27/10 FOR <B><U>TAMER</U></B>';
  
  $QueryGetTamerText = "select count(DISTINCT(multiple_reserve_id)) from multiple_reserved_product where multiple_reserved_product.multiple_reserve_id in(select multiple_reserved.multiple_reserve_id from multiple_reserved where multiple_reserved.multiple_reserve_worker_id in(1,7)) AND multiple_reserved_product.Check_Date >= '2020-10-27'";
      $result=mysqli_query($connection,$QueryGetTamerText)or die(mysqli_error($connection));
      $rt =  mysqli_fetch_assoc($result);
      
        echo '<br> <br>
                    <B> '.$rt["count(DISTINCT(multiple_reserve_id))"].'    </B>
  ';
?>


<?php
 $QueryGetAhmadText = "select count(DISTINCT(multiple_reserve_id)) from multiple_reserved_product where multiple_reserved_product.multiple_reserve_id in(select multiple_reserved.multiple_reserve_id from multiple_reserved where multiple_reserved.multiple_reserve_worker_id not in(1,7)) AND multiple_reserved_product.Check_Date >= '2020-10-27'";
 
  $result1=mysqli_query($connection,$QueryGetAhmadText)or die(mysqli_error($connection));
      $rt1 =  mysqli_fetch_assoc($result1);
      
        echo '<br><br><br> <hr> Count Checked Orders After 27/10 FOR <B><U>AHMAD</U></B> <br> <br>
                     <B> '.$rt1["count(DISTINCT(multiple_reserve_id))"].'  <B>  
  ';

?>
	<bR><BR><BR>	<div align="center">
      Codded By Rami Shook<br>
      FOR More Details : 79103686<br>
      ‫admin@cedarslandshoes.com‬


   
	  
		
		
</div>

      </main>
    </div>
  
       
    </body>
 
	
</html>
