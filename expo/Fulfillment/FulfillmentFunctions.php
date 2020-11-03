<?php
include('../config.php');
// to set checked replacement details order

if(isset($_GET['RDSetChecked']) && isset($_GET['prodid'])){

$now = date("h:i:sa");
$stts = $_GET['RDSetChecked'];
    $pid = $_GET['prodid'];
    $Mid = $_GET['Ordrid'];
    
    $QuerySetCheckStatus = "UPDATE Relacement_details SET RD_Check_Status = '$stts' ,Check_Date=now() WHERE mres_id = '$Mid' AND new_pid = '$pid' ";
           mysqli_query($connection,$QuerySetCheckStatus)or die(mysqli_error($connection));

}


if(isset($_GET['Send'])){
    $orderid= $_GET['Send'];


    $query="UPDATE multiple_reserved SET multiple_reserve_status = 'Sent' WHERE multiple_reserve_id='$orderid'";
if(mysqli_query($connection,$query)){
echo"Sended";
}else{
die("Error Inserting Data". mysqli_error($connection)."<BR>");
}
//

}


if(isset($_GET['ReplacementDone'])){

    $orderid = $_GET['id'];
//Restore The Old Product And Quantity To The Database ,Product Table 
$IdAndQty="SELECT SUM(old_product_id_qty),old_product_id FROM change_order WHERE order_id='$orderid' GROUP BY old_product_id";
$rslt = mysqli_query($connection, $IdAndQty)or die(mysqli_error($connection));
while($row = mysqli_fetch_assoc($rslt)){
//Restore The Qty
$oldProductQty = $row['SUM(old_product_id_qty)'] ;
$oldProductId = $row['old_product_id'] ;
$qRestore = "UPDATE products SET product_Quantity = product_Quantity+'$oldProductQty'  WHERE 
                                 product_id = '$oldProductId'";

mysqli_query($connection, $qRestore)or die(mysqli_error($connection));

}



                 

/*


$queryDecrease = "UPDATE products,change_details SET products.product_Quantity = product_Quantity - 
(SELECT new_order_details_product_id_qty FROM change_details,products WHERE new_order_details_product_id = products.product_id AND change_details.order_id = '$orderid')
WHERE change_details.new_order_details_product_id = products.product_id";
                 mysqli_query($connection, $queryDecrease)or die(mysqli_error($connection));

*/
    $queryDelete = "DELETE FROM change_details WHERE order_id = '$orderid'";
    mysqli_query($connection, $queryDelete)or die(mysqli_error($connection));

    $queryDelete1 = "DELETE FROM change_order WHERE order_id = '$orderid'";
    mysqli_query($connection, $queryDelete1)or die(mysqli_error($connection));

    $queryChangeOrderStatus="UPDATE multiple_reserved SET multiple_reserve_status = 'Replaced,Sent' WHERE multiple_reserve_id='$orderid'";

    mysqli_query($connection, $queryChangeOrderStatus)or die(mysqli_error($connection));


}
if(isset($_GET['OrderIdShip'])){
    ECHO"ADDING THE SHIPEMENT NUMNER <BR>";
    $shipNB = $_GET['AddShipment'];
    $OID = $_GET['OrderIdShip'];
    $queryAddShipment ="UPDATE multiple_reserved SET shipment_number = '$shipNB' WHERE multiple_reserve_id = '$OID'";
    mysqli_query($connection, $queryAddShipment)or die(mysqli_error($connection));


}


if(isset($_GET['ProductPic'])){
$code = $_GET['ProductPic'];
$qproductpath = "SELECT product_photo_path FROM products WHERE product_code='$code' ";
$queryresult= mysqli_query($connection,$qproductpath)or die(mysqli_error($connection));
    
$path = mysqli_fetch_assoc($queryresult);
echo"<img src='../".$path['product_photo_path']."'  width=100 height=100 class='thumbnailz' onerror='this.onerror=null; this.remove();'> </img>" ;    
    
    
}


?>