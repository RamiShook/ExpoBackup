<?php include('./info.php');
include('../config.php');
if (isset($_GET['logout'])){
  session_destroy();
  Echo "Logged Out , Please Login Again To Get All The Site Feature's.";
  header("Refresh: 3; url= ../ajx.html");

}

if(isset($_SESSION['type']) && $_SESSION['type'] !="Fulfillment"){

  header("Refresh: 3; url= ../index.php");

}
?>
<html>
    <head>        <link rel="icon" href="https://cedarslandshoes.com/expo/photo/ExpoLogo.jpg">

        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
        <link rel="stylesheet" type="text/css" href="../css/index.css">
		<link rel="stylesheet" href="../css/material.min.css">
				<link rel="stylesheet" href="../css/mysheet.css">

<script src="../js/material.min.js"></script>
<script src="../js/myscripts.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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
      <span class="mdl-layout-title"><div id="meee"> <a href='./index.php'> EXPO</a></div></span>
        <nav class="mdl-navigation">
        <?php if(isset($_SESSION['type']) && ($_SESSION['type']=="worker")){
          include ('../DefUserOptions.php');
        }        
           else if(isset($_SESSION['type']) && ($_SESSION['type']=="admin")){
            include('../AdminOptions.php');
          }else if(isset($_SESSION['type'])&& ($_SESSION['type']=="Fulfillment") ){
            include('FulfOptions.php');
        
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
<div id="mydiv" align="center"><img src="../assets/construct.gif" class="ajax-loader"></div>   </div>  </div>
	
		<div align="center">
      Codded By Rami Shook & Mahmoud Baddour. <br>
      FOR More Details : 79103686 , 76405054

   
	  
		
		
</div>
		
		
      </main>
    </div>
  
       
    </body>
	
</html>
