<?php
     include('config.php');
    # Functions For Change The Status Of Reservations Send To Fullfilment   
     if(isset($_GET['changeToFf'])){
     $orderid= $_GET['changeToFf'];
     $query="UPDATE multiple_reserved SET multiple_reserve_status = 'Fulfillment' WHERE multiple_reserve_id='$orderid'";
if(mysqli_query($connection,$query)){
    echo"Confirmed!";
}else{
    die("Error Inserting Data". mysqli_error($connection)."<BR>");
}
     }


if(isset($_GET['changeToFfOne'])){
    $orderid= $_GET['changeToFfOne'];
    $query="UPDATE reserved SET reverse_Status = 'Fulfillment' WHERE reserve_id='$orderid'";
    mysqli_query($connection,$query)or die(mysqli_error($connection));
     }



     ?>


