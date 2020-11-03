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
          <?php $strt= $_GET['strt']; $to=$_GET['to']; ?>
          <span class="mdl-layout-title">Your Sales Between <?php echo ".$strt. AND .$to. not included" ?></span>
         
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
  <br>Start Date:<input type="text" placeholder="2020-09-01" id ="begin_date"> </input> &nbsp; &nbsp; &nbsp; End Date<input type="text" placeholder="2020-10-01" id ="end_date"> </input>  
<input type="button" value="filter"onclick="FilterDt()"></button><br> YEAR-MONTH-DAY   
     <div class="preload">
         <?PHP
include("./config.php");
$strt = $_GET['strt'];
$to = $_GET['to'];
global $strt,$to;
$workerid=$_SESSION["uid"];
    echo '<hr> Filtered Sales Board:';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE (reserve_date BETWEEN '$strt' AND '$to') AND (multiple_reserve_status = 'Fulfillment' OR multiple_reserve_status = 'Sent') AND multiple_reserve_worker_id='$workerid'  ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '
     <BR><BR><BR> <u> <b>ORDERS WITH FULFILLMENT + SENT</u></b> BETWEEN <u><b>'.$strt.'</u></b> AND <u><b>'.$to.'</u></b> <BR><br>';
 while($row = mysqli_fetch_assoc($result)){
   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment,Sent <strong>";
$point=$row['SUM(reserve_full_price)']/5000;
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In Time BETWEEN '$strt' AND '$to' . With Total <strong>".$point." POINT</strong> <hr>";
 }
?>
<style>
.vl {
  border-bottom: 6px solid BLACK;
  height: 10px;
}
</style>

<div class="vl"></div>




 <?PHP
include("./config.php");
$strt = $_GET['strt'];
$to = $_GET['to'];
global $strt,$to;
$workerid=$_SESSION["uid"];
    echo '<hr> Filtered Sales Board:';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE (reserve_date BETWEEN '$strt' AND '$to') AND (multiple_reserve_status = 'Sent') AND multiple_reserve_worker_id='$workerid'  ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '
     <br><br> <u> <b>SENT ORDER\'S</u></b>  BETWEEN <u><b>'.$strt.'</u></b> AND <u><b> '.$to.'</u></b><BR><br>';
 while($row = mysqli_fetch_assoc($result)){
   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment,Sent <strong>";
$point=$row['SUM(reserve_full_price)']/5000;
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In Time BETWEEN '$strt' AND '$to' . With Total <strong>".$point." POINT</strong> <hr>";
 }
?>
<style>
.vl {
  border-bottom: 6px solid BLACK;
  height: 10px;
}
</style>

<div class="vl"></div>
 <?PHP
include("./config.php");
$strt = $_GET['strt'];
$to = $_GET['to'];
global $strt,$to;
$workerid=$_SESSION["uid"];
    echo '<hr> Filtered Sales Board:';
    $WeeklyDataQueryText = "SELECT COUNT(reserve_full_price),SUM(reserve_full_price),multiple_reserve_worker_id FROM `multiple_reserved` WHERE (reserve_date BETWEEN '$strt' AND '$to') AND (multiple_reserve_status = 'Fulfillment') AND multiple_reserve_worker_id='$workerid'  ORDER BY SUM(reserve_full_price) DESC";
    $result=mysqli_query($connection,$WeeklyDataQueryText)or die(mysqli_error($connection));

  echo '
     <br><br> <u> <b>Orders With Fufillment\'S</u></b>  BETWEEN <u><b>'.$strt.'</u></b> AND <u><b> '.$to.'</u></b><BR><br>';
 while($row = mysqli_fetch_assoc($result)){
   $wkrid = $row['multiple_reserve_worker_id'];
     $QueryGetWorkerName = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$wkrid'";
     $WorkerName=mysqli_query($connection,$QueryGetWorkerName)or die(mysqli_error($connection));
     $wkrnm = mysqli_fetch_assoc($WorkerName);
echo "The Employee : <u>".$wkrnm['worker_Full_Name']."</u> Has Approved to Fulfillment <strong>";
$point=$row['SUM(reserve_full_price)']/5000;
    echo $row["COUNT(reserve_full_price)"]." Orders</strong> In Time BETWEEN '$strt' AND '$to' . With Total <strong>".$point." POINT</strong> <hr>";
 }
?>
<style>
.vl {
  border-bottom: 6px solid BLACK;
  height: 10px;
}
</style>

<div class="vl"></div>

	<bR><BR><BR>	<div align="center">
	  Let's raise the numbers!<br>
      Codded By Rami Shook<br>
      FOR More Details : 79103686<br>
      admin@cedarslandshoes.com

   
	  
		
		
</div>
		
		
      </main>
    </div>
  
       
    </body>
     <script language="javascript">
    function FilterDt(){
    var strt_date = document.getElementById("begin_date").value;
    var end_date = document.getElementById("end_date").value;
    console.log(strt_date)
    console.log(end_date)
    window.location.replace('https://cedarslandshoes.com/expo/SingleSalesBoard.php?strt='+strt_date+'&to='+end_date)

}
</script>
	
</html>
