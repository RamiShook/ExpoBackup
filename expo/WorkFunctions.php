<?php
include ('config.php');
session_start();
if(isset($_GET['mlrvcidPhone'])){
    $GetClientPhone=$_GET['mlrvcidPhone'];
    // query to get the client id.
    $q="SELECT client_id FROM clients WHERE client_Phone='$GetClientPhone'";
    $result=mysqli_query($connection,$q);
    $data = mysqli_fetch_assoc($result);
    //The Client Id That Have This Phone Number.
    $ClientId= $data['client_id'];
    
    
    $WorkerId=$_SESSION['uid'];
    
    global $WorkerId ,$ClientId ;
    // insert a new field in the multiple reserved table.
    // then get the id of the iserted row.
    $prc = $_GET['Price'];
    $notes = $_GET['Notes'];
    $query="INSERT INTO multiple_reserved(multiple_reserve_worker_id,multiple_reserve_client_id,multiple_reserve_note,reserve_full_price) VALUES
     ('$WorkerId','$ClientId','$notes','$prc')";
    if(mysqli_query($connection,$query)){
        echo"added";
        $last_id = $connection->insert_id;
echo $last_id;


        /// getting the product id from its code 
        $GetProductCode=$_GET['ProductCode'];

        $QTY = $_GET['Qty'];
        $q1="SELECT product_id FROM products WHERE product_Code='$GetProductCode'";
        $result1=mysqli_query($connection,$q1)or die(mysqli_error($connection));
        
        $data = mysqli_fetch_assoc($result1);
        //The Client Id That Have This Phone Number.
        $ProductId= $data['product_id'];

        //inserting the data in the multiple reserved PRODUCT TABLE 
        $insertQuery = "INSERT INTO multiple_reserved_product (multiple_reserve_id,multiple_reserve_product_id,quantity,price)VALUES ('$last_id','$ProductId','$QTY','$prc')";
        mysqli_query($connection,$insertQuery)or die(mysqli_error($connection));
        

        //Decreasing The Product Quantity
    $qDecrease="UPDATE products SET product_Quantity = product_Quantity - '$QTY' WHERE product_id='$ProductId'";
    
    mysqli_query($connection,$qDecrease)or die(mysqli_error($connection));
    
    }else{
        die("Error Inserting Data". mysqli_error($connection)."<BR>");
    }
    
    }
    


?>