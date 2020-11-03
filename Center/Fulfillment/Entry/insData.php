<?php
include('../../config.php');

if(isset($_GET['pcode'])&& !isset($_GET['RealSize'])){
    $pcode=$_GET['pcode'];
    $pname=$_GET['pname'];
    $psize=$_GET['psize'];
    $pquantity=$_GET['pquantity'];
    $pprice=$_GET['pprice'];
    $pnote=$_GET['pnote'];
    $pcolor=$_GET['pcolor'];
    
    $photo = "./photo/".$_GET['Photoname'];
    echo $photo;
    echo "raaaaab";
$query="INSERT INTO products (Product_Name,product_Code,product_Size,product_Color,product_Quantity,product_Price,product_Note,product_photo_path)
VALUES('$pname','$pcode','$psize','$pcolor','$pquantity','$pprice','$pnote','$photo')";


if(mysqli_query($connection,$query)){
    echo"added";
}else{
    die("Error Inserting Data". mysqli_error($connection)."<BR>");
}

}

if(isset($_GET['pcode'])&& isset($_GET['RealSize'])){
    $pcode=$_GET['pcode'];
    $pname=$_GET['pname'];
    $psize=$_GET['psize'];
    $pquantity=$_GET['pquantity'];
    $pprice=$_GET['pprice'];
    $pnote=$_GET['pnote'];
    $pcolor=$_GET['pcolor'];
    $relsize=$_GET['RealSize'];
    $photo = "./photo/".$_GET['Photoname'];
    echo $photo;
$query="INSERT INTO products (Product_Name,product_Code,product_Size,product_Color,product_Quantity,product_Price,product_Note,Real_Size,product_photo_path)VALUES('$pname','$pcode','$psize','$pcolor','$pquantity','$pprice','$pnote','$relsize','$photo')";


if(mysqli_query($connection,$query)){
    echo"added";
}else{
    die("Error Inserting Data". mysqli_error($connection)."<BR>");
}

}


?>