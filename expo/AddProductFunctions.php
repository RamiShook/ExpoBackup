<?php
include('./config.php');
#this file is just for manupilate the operation add product to existing multiple reservee
if(isset($_GET['AddPTomres'])){
    $mresid = $_GET['AddPTomres'];
    $pcode = $_GET['pcode'];
    $pprice = $_GET['pprice'];
    $pqty = $_GET['pqty'];
    
    
    #get the product id from its code
    $q="SELECT product_id FROM products WHERE product_Code='$pcode'";
$result=mysqli_query($connection,$q)or die(mysqli_error($connection));
echo"q1 finished";

$data = mysqli_fetch_assoc($result);
$ProductId= $data['product_id'];
    
    
    $q2 = "insert into multiple_reserved_product values('$mresid','$ProductId','$pqty','$pprice','79103686','','')";

    $result2=mysqli_query($connection,$q2)or die(mysqli_error($connection));
echo"q2 finished";


// now decrease the qty from the products table
$q3="UPDATE products SET product_Quantity= product_Quantity - '$pqty' WHERE product_id = '$ProductId'";
    $result2=mysqli_query($connection,$q3)or die(mysqli_error($connection));

}




?>