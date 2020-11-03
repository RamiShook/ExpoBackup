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
    echo '<hr>The Daily Board :';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE reserve_date >= NOW() - INTERVAL 1 DAY AND (multiple_reserve_status = 'Fulfillment' OR multiple_reserve_status = 'Sent')  GROUP BY multiple_reserve_worker_id ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '<BR><BR>The Daily Job Done By Workers
     <hr> <BR><BR><BR>';
 while($row = mysqli_fetch_assoc($result)){
   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment <strong>";
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In The Last 1 Days. With Total Price: <strong>".$row['SUM(reserve_full_price)']." LBP</strong> ";


 echo '<BR>';
echo "TOTAL PRODUCTS Sent in this duration:" ;
$WeeklyProductText = "SELECT COUNT(multiple_reserve_id) FROM `multiple_reserved_product` where multiple_reserve_id IN (SELECT multiple_reserve_id from multiple_reserved 
                        where (multiple_reserved.multiple_reserve_worker_id = '$wkrid' AND reserve_date >= NOW() - INTERVAL 1 DAY ))";
    $result1=mysqli_query($connection,$WeeklyProductText)or die(mysqli_error($connection));
 while($row1 = mysqli_fetch_assoc($result1)){
     
     echo $row1['COUNT(multiple_reserve_id)'];
     echo "<br><hr>";
}

 }



?>
<style>
.vl {
  border-bottom: 6px solid green;
  height: 500px;
}
</style>

<div class="vl"></div>

<?PHP
include("./config.php");
    echo 'The Weekly Board :';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE reserve_date >= NOW() - INTERVAL 7 DAY AND (multiple_reserve_status = 'Fulfillment' OR multiple_reserve_status = 'Sent')  GROUP BY multiple_reserve_worker_id ORDER BY SUM(reserve_full_price) DESC";
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
?>
<style>
.vl {
  border-bottom: 6px solid green;
  height: 500px;
}
</style>

<div class="vl"></div>


<?PHP
include("./config.php");
    echo '<hr>The Monthly Board :';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE reserve_date >= NOW() - INTERVAL 30 DAY AND (multiple_reserve_status = 'Fulfillment' OR multiple_reserve_status = 'Sent')  GROUP BY multiple_reserve_worker_id ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '<BR><BR>The Monthly Job Done By Workers
     <hr> <BR><BR><BR>';
 while($row = mysqli_fetch_assoc($result)){
   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment <strong>";
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In The Last 30 Days. With Total Price: <strong>".$row['SUM(reserve_full_price)']." LBP</strong> <hr>";
 }
 echo"<BR><BR>";
?>


<style>
.v2{
  border-bottom: 6px solid red;
  height: 20px;
}
</style>

<div class="v2"></div>
<div class="v2"></div>
<div class="v2"></div>


<?PHP ///Sent Orders Board Monthly
include("./config.php");
     $PriceCounter = 0;

    echo '<hr>The Monthly Sent Orders Board :';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE reserve_date >= NOW() - INTERVAL 30 DAY AND  (multiple_reserve_status = 'Sent')  GROUP BY multiple_reserve_worker_id ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '<BR><BR>The Monthly Sent Orders (Last 30 days)
     <hr> <BR><BR><BR>';
 while($row = mysqli_fetch_assoc($result)){
          $PriceCounter =$PriceCounter+ $row['SUM(reserve_full_price)'];

   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment & Send <strong>";
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In The Last 30 Days. With Total Price: <strong>".$row['SUM(reserve_full_price)']." LBP</strong> <hr>";
 }
   echo "<br> The Sum Of All Sent Orders In The Last 7days ".$PriceCounter;

 echo"<BR><BR>";
?>

<style>
.vl {
  border-bottom: 6px solid green;
  height: 500px;
}
</style>

<div class="vl"></div>


     <?PHP
     $PriceCounter = 0;
include("./config.php");
    echo '<hr>The Daily Sent Orders :';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE reserve_date >= NOW() - INTERVAL 1 DAY AND multiple_reserve_status = 'Sent'  GROUP BY multiple_reserve_worker_id ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '<BR><BR>The Last 24 Hours Orders
     <hr> <BR><BR><BR>';
 while($row = mysqli_fetch_assoc($result)){
     $PriceCounter =$PriceCounter+ $row['SUM(reserve_full_price)'];
   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment & Send <strong>";
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In The Last 1 Days. With Total Price: <strong>".$row['SUM(reserve_full_price)']." LBP</strong> <hr>";
 }
 echo "<br> The Sum Of All Sent Orders In The Last 24 Hours ".$PriceCounter;
?>



<style>
.vl {
  border-bottom: 6px solid green;
  height: 500px;
}
</style>

<div class="vl"></div>


<?PHP
include("./config.php");
$PriceCounter=0;
    echo 'The Weekly Sent Orders :';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE reserve_date >= NOW() - INTERVAL 7 DAY AND  multiple_reserve_status = 'Sent'  GROUP BY multiple_reserve_worker_id ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '<BR><BR>The Weekly Sent Orders (Last 7 Dyas)
     <hr> <BR><BR><BR>';
 while($row = mysqli_fetch_assoc($result)){
          $PriceCounter =$PriceCounter+ $row['SUM(reserve_full_price)'];

   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment <strong>";
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In The Last 7 Days. With Total Price: <strong>".$row['SUM(reserve_full_price)']." LBP</strong> <hr>";
 }
  echo "<br> The Sum Of All Sent Orders In The Last 7days ".$PriceCounter;

?>


	<bR><BR><BR>	<div align="center">
      Codded By Rami Shook<br>
      FOR More Details : 79103686

   
	  
		
		
</div>
		
		
      </main>
    </div>
  
       
    </body>
	
</html>
