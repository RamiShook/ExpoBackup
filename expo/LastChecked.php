<?php
include('config.php');
/*
$qrytxt = "SELECT multiple_reserve_id from multiple_reserve_product where Check_Status = 1 ORDER BY Check_Date LIMIT 1";
    $result = mysqli_query($connection,$qrytxt);  
  echo $result;
   // $LastCheckId = $idz['multiple_reserve_id'];

//echo $LastCheckId;
*/
if(isset($_GET['Check'])){
$q1= "SELECT multiple_reserve_id from multiple_reserved_product where Check_Status = 1 ORDER BY Check_Date DESC LIMIT 1";
$result= mysqli_query($connection,$q1)or die(mysqli_error($connection));
    
$data1 = mysqli_fetch_assoc($result);
echo $data1['multiple_reserve_id'];
    
}

if(isset($_GET['ordr'])){
$q1= "SELECT multiple_reserve_id from multiple_reserved  ORDER BY reserve_date DESC LIMIT 1";
$result= mysqli_query($connection,$q1)or die(mysqli_error($connection));
    
$data1 = mysqli_fetch_assoc($result);
echo $data1['multiple_reserve_id'];
}

?>