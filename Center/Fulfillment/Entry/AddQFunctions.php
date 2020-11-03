<?php
include ('../../config.php');
if(isset($_GET['ProductCode']) && !isset($_GET['QuantityAdd']) && !isset($_GET['GetPrice'])){

$PCODE=$_GET['ProductCode'];
    $QTextCheckProduct = "SELECT product_Quantity FROM products WHERE product_Code = '$PCODE'";
    $result = mysqli_query($connection,$QTextCheckProduct);
    if(mysqli_num_rows($result) >0){
        $data = mysqli_fetch_assoc($result);
        echo $data['product_Quantity'];
    
    }else
    die("The Product Was  Not Founded In The Database!". mysqli_error($connection)."<BR>");
}
if(isset($_GET['ProductCode'])&& isset($_GET['QuantityAdd'])){
    $PCODE=$_GET['ProductCode'];
    $Qty = $_GET['QuantityAdd'];
    $QTextAddQuantity = "UPDATE products SET product_Quantity = product_Quantity+ '$Qty' WHERE product_Code = '$PCODE'";
    $result = mysqli_query($connection,$QTextAddQuantity);
if($result)
echo "Quantity Added To The Product!";
else
echo "Something Happened! Quantity Not Added! ERROR : ".mysqli_error($connection);
}



/// for Change The Price ! 
// first getting the product price
if(isset($_GET['ProductCode']) && isset($_GET['GetPrice']) &&!isset($_GET['QuantityAdd'])){
    $PCODE=$_GET['ProductCode'];
        $QTextCheckProduct = "SELECT product_Price FROM products WHERE product_Code LIKE '%$PCODE%'";
        $result = mysqli_query($connection,$QTextCheckProduct);
        if(mysqli_num_rows($result) >0){
            $data = mysqli_fetch_assoc($result);
            echo $data['product_Price'];
        
        }else
        die("The Product Was  Not Founded In The Database!". mysqli_error($connection)."<BR>");
    }


    if(isset($_GET['ProductCodeForPrice']) && !isset($_GET['GetPrice']) &&isset($_GET['PriceAdd'])){
       
        $PCODE=$_GET['ProductCodeForPrice'];
        $PRC = $_GET['PriceAdd'];
        $QTextSetPrice = "UPDATE products SET product_Price =  '$PRC' WHERE product_Code LIKE '%$PCODE%'";
        $result = mysqli_query($connection,$QTextSetPrice);
    if($result)
    echo "New Price afflicted!";
    else
    echo "Something Happened! Price Not Changed! ERROR : ".mysqli_error($connection);
    
    }

    
?>