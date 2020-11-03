<?php
include('config.php');
// insert the reserve id in the relacement table
if(isset($_GET['Fordrid']) && !isset($_GET['npcode']) && !isset($_GET['setdv'])){
    echo "inserting iinto replacement";
    $dv = $_GET['deliveryCharge'];
    $odid=$_GET['Fordrid'];
    $rpid=$_GET['rpid'];
    $qty = $_GET['qty'];
    //GETTING THE PRICE FROM MULTIPLE_RESERVED_PRODUCT
    $q1 ="SELECT * FROM multiple_reserved_product WHERE multiple_reserve_id = '$odid' AND multiple_reserve_product_id = '$rpid' ORDER BY multiple_reserve_id DESC LIMIT 1";
    $result1=mysqli_query($connection,$q1)or die(mysqli_error($connection));
$data1 = mysqli_fetch_assoc($result1);
$old_p_price = $data1['price'];
//getting the shipment number from multiple reserved
$qship = "SELECT shipment_number from multiple_reserved where multiple_reserve_id = '$odid'";
    $result2=mysqli_query($connection,$qship)or die(mysqli_error($connection));
$shipmntnbrslt = mysqli_fetch_assoc($result2);
$shipmntnb = $shipmntnbrslt['shipment_number'];

echo "<br> DELIVERY CHARGE: ".$dv;
    //inserting the data in the Replacement table
    $q="INSERT INTO Replacement(mres_id,old_pid,old_p_qty,shipment_number,old_pprice,delivery_charge)VALUES('$odid','$rpid','$qty','$shipmntnb','$old_p_price','$dv')";
    mysqli_query($connection,$q)or die(mysqli_error($connection));

    echo"ok";

}

//Set the data in the change_order_details table
if(isset($_GET['npcode']) && isset($_GET['npqty'])){
//get the product id from its code
    $GetProductCode=$_GET['npcode'];
    $q="SELECT product_id FROM products WHERE product_Code='$GetProductCode'";
    $result=mysqli_query($connection,$q)or die(mysqli_error($connection));
    $data = mysqli_fetch_assoc($result);
    $ProductId= $data['product_id'];

/// getting the replacement id from replacement table to to insert into the replacement details,
//getdid=$_GET['Fordrid'];
    $odid=$_GET['Fordrid'];

    $rpid=$_GET['rpid'];
    $qty = $_GET['qty'];
$q1="SELECT rep_id FROM Replacement WHERE mres_id='$odid' AND old_pid='$rpid' AND old_p_qty='$qty' ORDER BY rep_id DESC";
$result1=mysqli_query($connection,$q1)or die(mysqli_error($connection));
$data1 = mysqli_fetch_assoc($result1);
$ChangeId=$data1['rep_id'];
echo "rep Id is: ".$ChangeId."<br>";
print_r($data1);
echo"<br>";



// insert the data into change_details  
$newqty=$_GET['npqty'];


//getting the new product price 
$getpricequerytext = "SELECT Product_Price FROM products WHERE product_id = '$ProductId'";

$resultPrice=mysqli_query($connection,$getpricequerytext)or die(mysqli_error($connection));
$dataprice = mysqli_fetch_assoc($resultPrice);
$NewProductPrice=$dataprice['Product_Price'];
$NewProductPrice= $NewProductPrice * $newqty ;

$q3="INSERT INTO Relacement_details(rep_id,new_pid,new_p_qty,mres_id,new_pprice)VALUES('$ChangeId','$ProductId','$newqty','$odid','$NewProductPrice')";
mysqli_query($connection,$q3)or die(mysqli_error($connection));


/*
// Change The Order Status In Multiple reserve
$q4="UPDATE multiple_reserved SET multiple_reserve_status='Replacement' WHERE multiple_reserve_id=$odid ";
mysqli_query($connection,$q4)or die(mysqli_error($connection));
*/

//Decrease The New ordered Product Quantity from products
$qDecrease = "UPDATE products SET product_Quantity = product_Quantity - '$newqty' WHERE product_id='$ProductId' ";
mysqli_query($connection,$qDecrease)or die(mysqli_error($connection));


//set the price in multiple_reserved_product = 0 for the replaced product
$qurytxt ="UPDATE multiple_reserved_product SET price = 0 where multiple_reserve_id = '$odid' AND multiple_reserve_product_id = '$rpid' ";
mysqli_query($connection,$qurytxt)or die(mysqli_error($connection));


}
// to return quantity to stock
if(isset($_GET['ReturnSTK'])){
    $MRESID = $_GET['mres'];

    echo "got into function to return the quantity to the product table <br> MRES ID: ".$MRESID;
// First Need To Reset The Quantity To The Product Table.
    //Getting The Product Code.
    $GetPid = $_GET['ReturnSTK'];
    //Getting The Quantity .
    $GetQt=$_GET['qt'];
$q1="UPDATE products SET product_Quantity = product_Quantity + '$GetQt' WHERE product_id = '$GetPid'";
mysqli_query($connection,$q1)or die(mysqli_error($connection));

// set return stts = 1 in replacement table
$q2= "UPDATE Replacement SET Return_Status=1 WHERE mres_id='$MRESID' AND old_pid='$GetPid'";
mysqli_query($connection,$q2)or die(mysqli_error($connection));

}

//// set the delivery charge :
if(isset($_GET['setdv'])){
    echo "GOT INTO SET DELIVERY CHARGE FUNCTION";
    $dvc = $_GET['setdv'];
        $odid=$_GET['Fordrid'];

    $rpid=$_GET['rpid'];
    $qty = $_GET['qty'];
$q1="SELECT rep_id FROM Replacement WHERE mres_id='$odid' AND old_pid='$rpid' AND old_p_qty='$qty' ORDER BY rep_id DESC";
$result1=mysqli_query($connection,$q1)or die(mysqli_error($connection));
$data1 = mysqli_fetch_assoc($result1);
$ChangeId=$data1['rep_id'];
echo "changeid:".$ChangeId;
echo "<br> dvc= ".$dvc;
$q2 = "UPDATE Replacement SET delivery_charge = '$dvc' WHERE rep_id = '$ChangeId'";
    mysqli_query($connection,$q2)or die(mysqli_error($connection));
    
}

/*
if(isset($_GET['ReturnOID'])){
    $odid=$_GET['ReturnOID'];
    $rpid=$_GET['OPID'];
    $qty = $_GET['Qty'];
    //inserting the data in the change_order table
    $q="INSERT INTO change_order(order_id,old_product_id,old_product_id_qty)VALUES('$odid','$rpid','$qty')";
    mysqli_query($connection,$q)or die(mysqli_error($connection));

    //get the change id
    $q1="SELECT change_id FROM change_order WHERE order_id='$odid' AND old_product_id='$rpid' AND old_product_id_qty='$qty' ORDER BY change_id DESC";
$result1=mysqli_query($connection,$q1)or die(mysqli_error($connection));
$data1 = mysqli_fetch_assoc($result1);
$ChangeId=$data1['change_id'];


// insertig 0 
$q3="INSERT INTO change_details(change_id,new_order_details_product_id,new_order_details_product_id_qty,order_id)VALUES('$ChangeId',0,0,'$odid')";
mysqli_query($connection,$q3)or die(mysqli_error($connection));
}
    */





?>