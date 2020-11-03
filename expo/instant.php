<?
include('info.php');
?><html>
    <head>
        <link rel="icon" href="https://cedarslandshoes.com/expo/photo/ExpoLogo.jpg">

        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
        <link rel="stylesheet" type="text/css" href=".css/index.css">
		<link rel="stylesheet" href="./css/material.min.css">
				<link rel="stylesheet" href="./css/mysheet.css">

<script src="./js/material.min.js"></script>
<script src="./js/myscripts.js"></script>

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
         <?php
include("config.php");

$qt = "SELECT * FROM products WHERE product_Quantity <0 order by product_Quantity ";
    $result=mysqli_query($connection,$qt)or die(mysqli_error($connection));
 echo '<BR><BR>Products : 
     <hr> <BR><BR><BR>';
 while($row = mysqli_fetch_assoc($result)){
     echo $row['product_Code'];
     echo "&nbsp;&nbsp;".$row['product_Quantity'];
          echo"<br><BR>";

     /*
     $pid = $row['product_id'];
     $qtx= "SELECT COUNT(*) FROM multiple_reserved_product WHERE multiple_reserved_product.multiple_reserve_product_id= '$pid' AND multiple_reserve_id IN(SELECT multiple_reserve_id FROM multiple_reserved WHERE multiple_reserved.multiple_reserve_status = 'Fulfillment' OR multiple_reserved.multiple_reserve_status ='Pending')";
        $resultx=mysqli_query($connection,$qtx)or die(mysqli_error($connection));

     echo "Ordered in :".$resultx['COUNT(*)']." Orders";
     echo"<br><BR>";
     */
 }


?>
         
         
            </main>
    </div>
  
       
    </body>
