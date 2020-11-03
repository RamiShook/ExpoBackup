<?php
include("../../../config.php");
    $wkid=$_SESSION['uid'];
    $odidz = $_GET['oid'];
    $PriceCalc="0";
    $worker_ph = "";
    $clntadd="";
    $oldPriceCalc="0";
        
    /* Preparing info client and worker */
    $clientqtxt =mysqli_query($connection,"SELECT * FROM multiple_reserved where multiple_reserve_id= '$odidz'")or die("error".mysqli_error($connection));
            while($rowx = mysqli_fetch_assoc($clientqtxt)){

          $client_id =$rowx['multiple_reserve_client_id'] ;
          $worker_id=$rowx['multiple_reserve_worker_id'];
          if($rowx['delivery_charge'] == 1){
$PriceCalc = $PriceCalc +5000;
}else{
    $PriceCalc = 0;
}
            }

      $q = mysqli_query($connection, "SELECT * FROM (Relacement_details,Replacement)
INNER JOIN products ON (products.product_id = Relacement_details.new_pid)
WHERE Replacement.mres_id=Relacement_details.mres_id and Replacement.mres_id='$odidz'
      ")or die("error".mysqli_error($connection));
      
    
     $t = mysqli_num_rows($q);
     # $start = $_GET['LIMITSTART']; LIMIT $start,50 

     $record_count = mysqli_num_rows($q);
     
     
     while($row = mysqli_fetch_assoc($q)){
           $PriceCalc = $PriceCalc+ $row['new_pprice'] ;
    $thervid = $row['mres_id'];
   

      //
      $queryz = "SELECT count(*) as counts from multiple_reserved_product WHERE multiple_reserved_product.multiple_reserve_id= $thervid";
    $countquery=mysqli_query($connection, $queryz);
    $data=mysqli_fetch_assoc($countquery);



// query to sum the order products 
$SumQueryText = "SELECT SUM(new_p_qty) AS SMPD FROM Relacement_details WHERE Relacement_details.mres_id= $thervid";
   $SumQuery=mysqli_query($connection, $SumQueryText);
    $Pnb=mysqli_fetch_assoc($SumQuery);


//Getting The Worker Info
$queryWorkerInfoText = "SELECT worker_Full_Name,worker_phone FROM workers WHERE worker_id = '$worker_id'";
$workerInfoQueryManupilate = mysqli_query($connection,$queryWorkerInfoText)or die("error".mysqli_error($connection));;
$worker_Full_Namex = mysqli_fetch_assoc($workerInfoQueryManupilate);
$worker_Full_Name = $worker_Full_Namex['worker_Full_Name'];
$worker_ph = $worker_Full_Namex['worker_phone'];
echo"AFTER QUERY WORKER PHONE = ".$worker_ph;


//getting the client info 

$queryClientInfoText = "SELECT client_FullName,client_Address,client_Phone FROM clients where client_id = '$client_id'";
$clientInfoQueryManipulate = mysqli_query($connection,$queryClientInfoText )or die("error".mysqli_error($connection));;
$client_Full_Namex = mysqli_fetch_assoc($clientInfoQueryManipulate);
$client_FullName = $client_Full_Namex['client_FullName'];
$client_Address = $client_Full_Namex['client_Address'];
$client_Phone = $client_Full_Namex['client_Phone'];

$datetime = date_create($row['reserve_date']);

$day = date_format( $datetime, 'l'); // Thursday
$date = date_format( $datetime, 'd'); // 30
$month = date_format( $datetime, 'F'); // July
$year = date_format( $datetime, 'Y'); // 2015

}




error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
require_once './PHPExcel/IOFactory.php';
require_once './PHPExcel.php';

echo "product  nb: ".$Pnb['SMPD'];
$excel2 = PHPExcel_IOFactory::createReader('Excel2007');

$excel2 = $excel2->load('TOPSPEED.xlsx'); // Empty Sheet

/*$excel2->setActiveSheetIndex(0);
$excel2->getActiveSheet()->setCellValue('C6', '4')
    ->setCellValue('C7', '5')
    ->setCellValue('C8', '6')       
    ->setCellValue('B10', $worker_ph);
*/



// set the right price  new- old
//calculate the old price
$qx = mysqli_query($connection, "select * from Replacement where mres_id = '$odidz'")or die("error".mysqli_error($connection));;
   while($rowza = mysqli_fetch_assoc($qx)){
       $oldPriceCalc = $oldPriceCalc + $rowza ['old_pprice'] ;
       
   }

$deliveryCharge = 0;
$qx = mysqli_query($connection, "select delivery_charge from Replacement where mres_id = '$odidz'")or die("error".mysqli_error($connection));;
   while($row = mysqli_fetch_assoc($qx)){
       if($row['delivery_charge']==1){
           $deliveryCharge=5000;
       } 
       
   }


$Final_price = $PriceCalc - $oldPriceCalc;
$Final_price= $Final_price + $deliveryCharge;
echo "old price:".$oldPriceCalc;
echo "newprice ".$PriceCalc;
echo "<BR>FINAL PRICE = ".$Final_price;
echo "<BR>worker_ph = ".$worker_ph;


$MyDt = $date.$month.$year;
$excel2->setActiveSheetIndex(0);
$excel2->getActiveSheet()->setCellValue('I1',$Final_price)->setCellValue('B9', "$worker_ph")->setCellValue('h1', "بدل")->setCellValue('B14', $Pnb['SMPD'])->setCellValue('B8', $worker_Full_Name)->setCellValue('I3', $client_FullName)->setCellValue('D14', $odidz)->setCellValue('H4',$client_Address)->setCellValue('H9', $client_Phone)->setCellValue('H11', $MyDt);
$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
/*
if ($worker_id == 6){ // laatifa ETERNO
    $excel2->getActiveSheet()->setCellValue('B5',"Eterno");
}else if ($worker_id ==7 || $worker_id ==10){ // reem & farah Joy Kids
    $excel2->getActiveSheet()->setCellValue('B5',"Joy Kids");
}else{ // every one else
        $excel2->getActiveSheet()->setCellValue('B5',"The Sale");

}
*/
$objWriter->save($_GET["oid"].'REP.xlsx');
$filnm = $_GET["oid"].'REPreturn.xlsx';
/*
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="'.$filnm.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
*/
//$urli = "cedarslandshoes.com/expo/PRNT/V176/Classes/".$_GET['oid'];
$urli = $_GET['oid']."REP.xlsx";
echo " 
<script>
        var timer = setTimeout(function() {
            window.location= '".$urli."'
        }, 3000);
    </script>
";
?>