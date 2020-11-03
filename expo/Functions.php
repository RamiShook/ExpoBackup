<?php session_start(); include('config.php'); header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); header( 'Cache-Control: no-store, no-cache, must-revalidate' ); header( 'Cache-Control: post-check=0, pre-check=0', false ); header( 'Pragma: no-cache' );
// to check the phone number if exist
if (isset($_GET['phonenb'])){
    $phone=$_GET['phonenb'];
    $query="SELECT client_FullName,client_Address From clients WHERE client_Phone LIKE'%$phone'";
    $result = mysqli_query($connection,$query);   

    if(mysqli_num_rows($result) >0){
        $Name = mysqli_fetch_assoc($result);
        echo $Name['client_FullName']." <div style='font-size:10px;'>".$Name['client_Address']."</div>";
    }else
    die("Not Founded In The Database @". mysqli_error($connection)."<BR>");
}



//to add a new client to the database
if(isset($_GET['phone'])&& isset($_GET['name'])){
$name=$_GET['name'];
$phone=$_GET['phone'];
$address=$_GET['address'];
$notes=$_GET['notes'];
$query="INSERT INTO clients(client_FullName,client_Address,client_Phone,client_Notes) VALUES ('$name','$address','$phone','$notes')";
if(mysqli_query($connection,$query)){
    echo"added";
}else{
    die("Error Inserting Data". mysqli_error($connection)."<BR>");
}

}

if (isset($_GET['productCode'])){
    $pcode=$_GET['productCode'];

    $q="SELECT product_price FROM products WHERE product_Code='$pcode' ";
    $result = mysqli_query($connection,$q);

    $data = mysqli_fetch_assoc($result);
echo $data['product_price'];

}

if (isset($_GET['ClientPhone']) &&isset($_GET['ProductCode']) ){
$GetClientPhone=$_GET['ClientPhone'];
// query to get the client id.
$q="SELECT client_id FROM clients WHERE client_Phone='$GetClientPhone'";
$result=mysqli_query($connection,$q);
$data = mysqli_fetch_assoc($result);
//The Client Id That Have This Phone Number.
$ClientId= $data['client_id'];


// to get the worker id
$WorkerId=$_SESSION['uid'];


// to get the product id 
$GetProductCode=$_GET['ProductCode'];
$q="SELECT product_id FROM products WHERE product_Code='$GetProductCode'";
$result=mysqli_query($connection,$q)or die(mysqli_error($connection));

$data = mysqli_fetch_assoc($result);
//The Client Id That Have This Phone Number.
$ProductId= $data['product_id'];


//Decrease The Qantity From The Product Table

$GetQuantity=$_GET['Quantity'];
$q="UPDATE products SET product_Quantity = product_Quantity - '$GetQuantity' WHERE product_id='$ProductId'";

mysqli_query($connection,$q)or die(mysqli_error($connection));

// Getting The Calculated Price And The Notes
$GetPrice=$_GET['Price'];
$GetNotes=$_GET['Notes'];
$GetRow = $_GET['rowid'];
//insert The Data Into The Reservation Table.
$q="INSERT INTO reserved (reserve_product_id,reserve_worker_id,reserve_client_id,reverse_Notes,reserve_Price,reserve_Quantity,rw_id) VALUES ('$ProductId','$WorkerId','$ClientId','$GetNotes','$GetPrice','$GetQuantity','$GetRow')";
mysqli_query($connection,$q)or die(mysqli_error($connection));



}


if(isset($_GET['QuantityCheck'])){
    $GetpCode = $_GET['QuantityCheck'];
    $q="SELECT product_Quantity FROM products WHERE product_Code = '$GetpCode'";
    $result= mysqli_query($connection,$q)or die(mysqli_error($connection));
    
    $data = mysqli_fetch_assoc($result);
echo $data['product_Quantity'];
}


if(isset($_GET['deleterv'])&&isset($_GET['qt'])){

    $GetRvId= $_GET['deleterv'];
// First Need To Reset The Quantity To The Product Table.
    //Getting The Product Code.
    $GetPid = $_GET['pid'];
    //Getting The Quantity .
    $GetQt=$_GET['qt'];
$q1="UPDATE products SET product_Quantity = product_Quantity + '$GetQt' WHERE product_id = '$GetPid'";
mysqli_query($connection,$q1)or die(mysqli_error($connection));

// Remove The Record From The Reserved Table . 
$q2="DELETE FROM reserved WHERE reserve_id = '$GetRvId'";
mysqli_query($connection,$q2)or die(mysqli_error($connection));



}
if(isset($_GET['GetProductInfo'])){
    $code = $_GET['GetProductInfo'];

    $q="SELECT product_id,product_Quantity FROM products WHERE product_Code = '$code'";
    $result= mysqli_query($connection,$q)or die(mysqli_error($connection));
    
    $data = mysqli_fetch_assoc($result);
    if(is_null($data['product_id'])){
        echo"Error! <br>This Product Code Was Not Founded In The Database !<br>Please Make Sure You Enter The Code Right! ";
    }else {
$PID=$data['product_id'];
$q1="SELECT multiple_reserve_id,quantity FROM multiple_reserved_product WHERE multiple_reserve_product_id ='$PID' ORDER BY multiple_reserve_id DESC LIMIT 1";
$result= mysqli_query($connection,$q1)or die(mysqli_error($connection));
    
$data1 = mysqli_fetch_assoc($result);
if(is_null($data1)){
    echo "Available Quantity: " .$data['product_Quantity']. " <br><hr>";
    echo"This Product Was Not Reserved Before!";
}else {  
    echo "Available Quantity: " .$data['product_Quantity']. " <br><hr>";
    echo "last reserved quantity: ".$data1['quantity']."<hr>";
    //Getting The Order Data From Multiple Reserve Table ,
$MultipleReserveId = $data1['multiple_reserve_id'];
    $QueryGetOrderInfo = "SELECT * FROM multiple_reserved WHERE multiple_reserve_id = '$MultipleReserveId'";
    $OrderDataR= mysqli_query($connection,$QueryGetOrderInfo)or die(mysqli_error($connection));
$OrderData = mysqli_fetch_assoc($OrderDataR);

// Now Getting The Worker Full Name , 
$WORKERID = $OrderData['multiple_reserve_worker_id'];
$QueryGetWorkerInfo = "SELECT worker_Full_Name FROM workers WHERE worker_id = '$WORKERID'";
$WorkerDataR= mysqli_query($connection,$QueryGetWorkerInfo)or die(mysqli_error($connection));
$Worker_Data = mysqli_fetch_assoc($WorkerDataR);
    echo "Last Piece Reserved By: ".$Worker_Data['worker_Full_Name']."<hr>";
    echo "Reserve Time: ".$OrderData["reserve_date"]."<hr>";
    echo "Reserve Time: ".$OrderData['reserve_date']."<hr>";
    echo "Notes: ".$OrderData["multiple_reserve_note"]."<hr>";

//to get the product photo
$qproductpath = "SELECT product_photo_path FROM products WHERE product_code='$code' ";
$queryresult= mysqli_query($connection,$qproductpath)or die(mysqli_error($connection));
    
$path = mysqli_fetch_assoc($queryresult);

echo"<img src='".$path['product_photo_path']."'  width=100 height=100 class='thumbnailz' onerror='this.onerror=null; this.remove();'> </img>" ;
}
}
}



if(isset($_GET['mlrvcid'])&& isset($_GET['mrwid'])){

// insert a new field in the multiple reserved table.
// then get the id of the iserted row.
$mlrclientid=$_GET['mlrvcid'];
$mlrworkerid=$_GET['mrwid'];
$query="INSERT INTO multiple_reserved(multiple_reserve_worker_id,multiple_reserve_client_id,multiple_reserve_note,reserve_full_price) VALUES
 ('$mlrworkerid','$mlrclientid','','')";
if(mysqli_query($connection,$query)){
    echo"added";
     $last_id = $connection->insert_id;
    $_SESSION['last_id']= $last_id;
}else{
    die("Error Inserting Data". mysqli_error($connection)."<BR>");
}

}



if (isset($_GET['mrClientPhone']) &&isset($_GET['mrProductCode']) ){
    // to get the Client ID
    $client_phonez = $_GET['mrClientPhone'];
    $qclient="SELECT client_id FROM clients WHERE client_Phone LIKE '%$client_phonez%' LIMIT 1";
$resulta=mysqli_query($connection,$qclient);
$dataqclient = mysqli_fetch_assoc($resulta);
//The Client Id That Have This Phone Number.
$ClientId= $dataqclient['client_id'];
$wkr_id = $_SESSION['uid'];
    $lid=  $_SESSION['last_id'];
    //Getting The Res ID
   // echo "THE WORKER ID :".$wkr_id;
   //echo"<BR>the session worker id:".$wkr_id;
   //echo "<BR> THE CLIENT ID:".$ClientId."<BR>";
    $MResQ= "SELECT multiple_reserve_id FROM multiple_reserved WHERE multiple_reserve_worker_id = '$wkr_id' AND multiple_reserve_client_id = '$ClientId' ORDER BY multiple_reserve_id DESC LIMIT 1";
    $resultZZZ=mysqli_query($connection,$MResQ)or die(mysqli_error($connection));
    
    $dataZZZ = mysqli_fetch_assoc($resultZZZ);
    //The Client Id That Have This Phone Number.
    $MRV= $dataZZZ['multiple_reserve_id'];
  
  echo "MULTIPLE RESERVE ID IS : ".$MRV;
   
    // to get the product id 
    $GetProductCode=$_GET['mrProductCode'];
    $q="SELECT product_id FROM products WHERE product_Code='$GetProductCode'";
    $result=mysqli_query($connection,$q)or die(mysqli_error($connection));
    
    $data = mysqli_fetch_assoc($result);
    //The Client Id That Have This Phone Number.
    $mrProductId= $data['product_id'];
  //  echo "<br>mrProductid: ".$mrProductId;
    
    
    //Decrease The Qantity From The Product Table
    
    $mrGetQuantity=$_GET['mrQuantity'];
    echo "<br>mrGetQuantity".$mrGetQuantity;
    $q="UPDATE products SET product_Quantity = product_Quantity - '$mrGetQuantity' WHERE product_id='$mrProductId'";
    
    mysqli_query($connection,$q)or die(mysqli_error($connection));
    
    // Getting The Calculated Price And The Notes
    $mrGetPrice=$_GET['mrPrice'];
    
    //echo "<br>mrGetPrice".$mrGetPrice;
    //getting the row id
    $mrRowId=$_GET['rwid'];
    //echo "<br>mrRowId".$mrRowId;
    //insert The Data Into The Reservation Table.
    $q="INSERT INTO multiple_reserved_product (multiple_reserve_id,multiple_reserve_product_id,quantity,price,row_id) VALUES ('$MRV','$mrProductId','$mrGetQuantity','$mrGetPrice','$mrRowId') ";
          mysqli_query($connection,$q)or die(mysqli_error($connection));
          
            echo"The Request Confirmed";
    
    //Adding The Full Price To Multiple_Reserved Table
    
    $AddingTheFPCText = "UPDATE multiple_reserved SET reserve_full_price = reserve_full_price +'$mrGetPrice' WHERE multiple_reserve_id = '$MRV' ";
                mysqli_query($connection,$AddingTheFPCText)or die(mysqli_error($connection));
                
                ///Set The New Date And Time To The Multiple Reserve Table -> Order Date ,
                $qtx = "UPDATE multiple_reserved SET reserve_date = now() WHERE multiple_reserve_id='$MRV'";
                 mysqli_query($connection,$qtx)or die(mysqli_error($connection));

    }



    if(isset($_GET['delClientPhone'])&& isset($_GET['delProductCode'])&&isset($_GET['delrowid'])){
        $row_id=$_GET['delrowid'];
        $product_code=$_GET['delProductCode'];
        $client_phone=$_GET['delClientPhone'];
        $quantity = $_GET['delquantity'];

        //getting the client id
$q="SELECT client_id FROM clients WHERE client_Phone='$client_phone'";
$resulta=mysqli_query($connection,$q);
$data = mysqli_fetch_assoc($resulta);
//The Client Id That Have This Phone Number.
$ClientId= $data['client_id'];

// getting the product id
$q1="SELECT product_id FROM products WHERE product_Code='$product_code' ";
$result = mysqli_query($connection,$q1);
$data = mysqli_fetch_assoc($result);
$product_id= $data['product_id'];


// restore the quantity to the product table

$q="UPDATE products SET product_Quantity = product_Quantity + '$quantity' WHERE product_id='$product_id'";

mysqli_query($connection,$q)or die(mysqli_error($connection));

//
$q2="DELETE FROM reserved WHERE rw_id = '$row_id' AND reserve_client_id = '$ClientId' AND reserve_product_id = '$product_id'";
mysqli_query($connection,$q2)or die(mysqli_error($connection));

    }

    // to unreserve one of multiple reserve item.
   if(isset($_GET['rmrowid'])&& isset($_GET['rspcode'])){
       $row_id = $_GET['rmrowid'];
       $quantitym=$_GET['qty'];
       $GetProductCode=$_GET['rspcode'];
       
       
       
       
        // to get the Client ID
    $client_phonez = $_GET['mrClientPhone'];
    $qclient="SELECT client_id FROM clients WHERE client_Phone='$client_phonez'";
$resulta=mysqli_query($connection,$qclient);
$dataqclient = mysqli_fetch_assoc($resulta);
//The Client Id That Have This Phone Number.
$ClientId= $dataqclient['client_id'];
$wkr_id = $_SESSION['uid'];
    //Getting The Res ID
    echo "THE WORKER ID :".$wkr_id;
    echo"<BR>the session worker id:".$wkr_id;
    echo "<BR> THE CLIENT ID:".$ClientId."<BR>";
    $MResQ= "SELECT multiple_reserve_id FROM multiple_reserved WHERE multiple_reserve_worker_id = '$wkr_id' AND multiple_reserve_client_id = '$ClientId' ORDER BY multiple_reserve_id DESC LIMIT 1";
    $resultZZZ=mysqli_query($connection,$MResQ)or die(mysqli_error($connection));
    
    $dataZZZ = mysqli_fetch_assoc($resultZZZ);
    //The Client Id That Have This Phone Number.
    $MRV= $dataZZZ['multiple_reserve_id'];
  echo "MULTIPLE RESERVE ID IS : ".$MRV;
       
       
       
       
       

       // first getting the product id from the product code.
$q="SELECT product_id FROM products WHERE product_Code='$GetProductCode'";
$result=mysqli_query($connection,$q)or die(mysqli_error($connection));

$data = mysqli_fetch_assoc($result);
$ProductId= $data['product_id'];

//delete the row from the multiple_reserved_products
$dltrq="DELETE FROM multiple_reserved_product WHERE row_id = '$row_id' AND multiple_reserve_product_id='$ProductId'";
mysqli_query($connection,$dltrq)or die(mysqli_error($connection));

//restore the quantity to the table products :

$qzz="UPDATE products SET product_Quantity = product_Quantity + '$quantitym' WHERE product_id='$ProductId'";

mysqli_query($connection,$qzz)or die(mysqli_error($connection));

// Set The Full Reservation Price in multiple_reserved table
$TheFullPrice=$_GET['NewOrderPrice'];
echo "The New Full Price Is : "+$TheFullPrice;
$SetTheFPCText = "UPDATE multiple_reserved SET reserve_full_price = '$TheFullPrice' WHERE multiple_reserve_id = '$MRV'" ;
mysqli_query($connection,$SetTheFPCText)or die(mysqli_error($connection));

   }

   if(isset($_GET['delMultiRvId'])){ 
       $MultiRvId = $_GET['delMultiRvId'];

       // Loop In All The Product Reserved In This Reservation And Restore The Product Quantity To Products
       $QueryEachProduct = "SELECT multiple_reserve_product_id,quantity FROM multiple_reserved_product WHERE multiple_reserve_id = '$MultiRvId'";
       $ProductsId=mysqli_query($connection,$QueryEachProduct)or die(mysqli_error($connection));
  while($row = mysqli_fetch_assoc($ProductsId)){
      $Product_Id = $row['multiple_reserve_product_id'];
      $product_quantity = $row['quantity'];
      // now query to restore the quantity to the product table;
      $QueryRestoreQuantity = "UPDATE products SET product_Quantity = product_Quantity+'$product_quantity' WHERE product_id = '$Product_Id' ";
      $RestoreResult = mysqli_query($connection,$QueryRestoreQuantity)or die(mysqli_error($connection));
echo $RestoreResult;
      
      
  }
  //NOW Deleting The Record From The Multiple_Reserved Table;
      $MultiRvId = $_GET['delMultiRvId'];
       // To delete from multiple reserved product , 
       $dlquryMRP = "DELETE FROM multiple_reserved_product WHERE multiple_reserve_id = '$MultiRvId'";
       // To delete from multiple reserved  , 
       $dlquryMR = "DELETE FROM multiple_reserved WHERE multiple_reserve_id = '$MultiRvId'";
       mysqli_query($connection,$dlquryMRP)or die(mysqli_error($connection));
       mysqli_query($connection,$dlquryMR)or die(mysqli_error($connection));
    

   }

//Change The Check StatusFor Order ,
if(isset($_GET['SetChecked']) && isset($_GET['prodid'])){

$now = date("h:i:sa");
$stts = $_GET['SetChecked'];
    $pid = $_GET['prodid'];
    $Mid = $_GET['Ordrid'];
    
    $QuerySetCheckStatus = "UPDATE multiple_reserved_product SET Check_Status = '$stts' , Check_Date=now() WHERE multiple_reserve_id = '$Mid' AND multiple_reserve_product_id = '$pid' ";
           mysqli_query($connection,$QuerySetCheckStatus)or die(mysqli_error($connection));

}

//Add Note To The Pending Order
if(isset($_GET['SetNote']) && isset($_GET['NoteId'])){
    
    $note = $_GET['SetNote'];
    $Ordrid = $_GET['NoteId'];
    $QuerySetNote = "UPDATE multiple_reserved SET multiple_reserve_note = '$note' WHERE multiple_reserve_id ='$Ordrid' ";
               mysqli_query($connection,$QuerySetNote)or die(mysqli_error($connection));

    
}


if(isset($_GET['SetApproved'])){
    
    $oid = $_GET['SetApproved'];
    $QueySetApproved ="UPDATE multiple_reserved SET multiple_reserve_status ='Approved',Approve_Date=now(),waska='2020-10-21' WHERE multiple_reserve_id ='$oid'";
                   mysqli_query($connection,$QueySetApproved)or die(mysqli_error($connection));

    
    
}

//to restore the quantity from sent orders when returned
if(isset($_GET['RestoreQTY'])){
    $pcode= $_GET['RestoreQTY'];
    $pqty = $_GET['pqty'];
    
    $QueryRestoreQty = "UPDATE products SET product_Quantity = product_Quantity + '$pqty' WHERE product_Code = '$pcode'";
                       mysqli_query($connection,$QueryRestoreQty)or die(mysqli_error($connection));
                       
                       echo "pcode:".$pcode." qty:".$pqty." Restored";

    
    
}


// to delete product from confirmed multiple_reserve_product
if(isset($_GET['delMulResProduct'])){
    echo"got into delete multiple reserve product function";
    $mrid = $_GET['delMulResProduct'];
    $pqty= $_GET['pqty'];
    $pid = $_GET['pid'];
    echo"<br>mrid".$mrid."<br>pqty ".$pqty."<br>pid ".$pid;
    
    // first restore the qty to products table
    $QueryRestoreQty = "UPDATE products SET product_Quantity = product_Quantity + '$pqty' WHERE product_id = '$pid'";
                       mysqli_query($connection,$QueryRestoreQty)or die(mysqli_error($connection));
                       
    // delete the row from multiple reserved products 
    $QueryDeleteRow = "DELETE FROM multiple_reserved_product WHERE multiple_reserve_id = '$mrid' AND multiple_reserve_product_id = '$pid' AND quantity='$pqty'";
    mysqli_query($connection, $QueryDeleteRow)or die(mysqli_error($connection));
    
    
    
    
}
?>