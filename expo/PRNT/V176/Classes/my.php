<?php
include("../../../config.php");
    $wkid=$_SESSION['uid'];
    $odidz = $_GET['oid'];
    $PriceCalc="0";
    $worker_ph = "";
    $clntadd="";
    
     $q = mysqli_query($connection, "select multiple_reserved_product.multiple_reserve_id,
     multiple_reserved_product.multiple_reserve_product_id,
     multiple_reserved.shipment_number,
     multiple_reserved_product.quantity ,
     multiple_reserved_product.price ,
     multiple_reserved.reserve_date ,
     multiple_reserved.reserve_full_price ,
     multiple_reserve_client_id ,
     multiple_reserve_note,
multiple_reserved_product.Check_Status,
     clients.client_FullName ,
     clients.client_Address,
     clients.client_Phone ,
     products.Product_Name ,
     products.product_Code
     from multiple_reserved_product INNER JOIN multiple_reserved ON multiple_reserved.multiple_reserve_id = multiple_reserved_product.multiple_reserve_id
     INNER JOIN clients ON clients.client_id=multiple_reserved.multiple_reserve_client_id
     INNER JOIN products ON products.product_id = multiple_reserve_product_id
     WHERE  
     multiple_reserved.multiple_reserve_id= '$odidz' ORDER BY multiple_reserved.reserve_date DESC ")or die("error".mysqli_error($connection));
     $t = mysqli_num_rows($q);
     # $start = $_GET['LIMITSTART']; LIMIT $start,50 

     $record_count = mysqli_num_rows($q);
     
     
     while($row = mysqli_fetch_assoc($q)){
    $thervid = $row['multiple_reserve_id'];
       $PriceCalc = $PriceCalc+ $row['price'] ;
       $clntnm = $row['client_FullName'];
$clntadd = $row['client_Address'];
$clntph = $row['client_Phone'];
echo "Client Phone :".$clntph;
echo "<br> client address:".$clntadd;

      //
      $queryz = "SELECT count(*) as counts from multiple_reserved_product WHERE multiple_reserved_product.multiple_reserve_id= $thervid";
    $countquery=mysqli_query($connection, $queryz);
    $data=mysqli_fetch_assoc($countquery);



// query to sum the order products 
$SumQueryText = "SELECT SUM(quantity) AS SMPD FROM multiple_reserved_product WHERE multiple_reserved_product.multiple_reserve_id= $thervid";
   $SumQuery=mysqli_query($connection, $SumQueryText);
    $Pnb=mysqli_fetch_assoc($SumQuery);


// To Get The Worker WWho Make The Reservation
    //get the worker id
$queryText = "SELECT multiple_reserve_worker_id FROM multiple_reserved WHERE multiple_reserve_id = '$thervid'";
$WorkerIdquery=mysqli_query($connection, $queryText);
    $WorkerIdx=mysqli_fetch_assoc($WorkerIdquery);
    $worker_id =  $WorkerIdx['multiple_reserve_worker_id'];
//Getting The Worker Info
$queryWorkerInfoText = "SELECT worker_Full_Name,worker_phone FROM workers WHERE worker_id = '$worker_id'";
$workerInfoQueryManupilate = mysqli_query($connection,$queryWorkerInfoText);
$worker_Full_Namex = mysqli_fetch_assoc($workerInfoQueryManupilate);
$worker_Full_Name = $worker_Full_Namex['worker_Full_Name'];
$worker_ph = $worker_Full_Namex['worker_phone'];


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
$PriceCalc = $PriceCalc +4000;
echo "product  nb: ".$Pnb['SMPD'];
$excel2 = PHPExcel_IOFactory::createReader('Excel2007');

$excel2 = $excel2->load('TOPSPEED.xlsx'); // Empty Sheet

/*$excel2->setActiveSheetIndex(0);
$excel2->getActiveSheet()->setCellValue('C6', '4')
    ->setCellValue('C7', '5')
    ->setCellValue('C8', '6')       
    ->setCellValue('B10', $worker_ph);
*/
$MyDt = $date.$month.$year;
$excel2->setActiveSheetIndex(0);
$excel2->getActiveSheet()->setCellValue('I1',$PriceCalc)->setCellValue('B9', $worker_ph)->setCellValue('B14', $Pnb['SMPD'])->setCellValue('B8', $worker_Full_Name)->setCellValue('I3', $clntnm)->setCellValue('D14', $odidz)->setCellValue('H4',$clntadd)->setCellValue('H9', $clntph)->setCellValue('H11', $MyDt);
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
$objWriter->save($_GET["oid"].'.xlsx');
$filnm = $_GET["oid"].'.xlsx';
/*
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="'.$filnm.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
*/
//$urli = "cedarslandshoes.com/expo/PRNT/V176/Classes/".$_GET['oid'];
$urli = $_GET['oid'].".xlsx";
echo " 
<script>
        var timer = setTimeout(function() {
            window.location= '".$urli."'
        }, 3000);
    </script>
";
?>