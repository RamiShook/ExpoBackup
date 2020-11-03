<?php include('info.php');
if ($_SESSION['type']!="Fulfillment"){
    HEADER("LOCATION:../ajx.html");
}
?>
<html>
  <head>
<style>
/* 
.center_div{
    align:center;
    width:80%
} */
</style>
          <link rel="icon" href="https://cedarslandshoes.com/expo/photo/ExpoLogo.jpg">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" href="css/material.min.css">
<script src="js/material.min.js"></script>
<script src="js/myscripts.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
<script type="text/javascript" src="./assets/jquery.js"></script>
<script type="text/javascript" src="./assets/bootstrap.js"></script>
<script type="text/javascript" src="./assets/bootbox.min.js"></script>
<script type="text/javascript" src="./assets/sorttable.js"></script> 
  </head>
  <body>
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">Product Edit</span>
         
      </header>
      <div class="mdl-layout__drawer">
        
      <span class="mdl-layout-title"><div id="meee"> <a href='index.php'>EXPO</a></div></span>
        <nav class="mdl-navigation">
      <?php if(isset($_SESSION['type']) && ($_SESSION['type']=="worker")){
          include ('DefUserOptions.php');
        }else if(isset($_SESSION['type']) && ($_SESSION['type']=="admin")){
          include ('AdminOptions.php');
        }else{
            include('FulfOptions.php');
          }
          ?>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="page-content"><!-- Your content goes here -->
		<div align="center">
    
        <?php
include "./config.php";
$iod = $_GET['id'];
$q = mysqli_query($connection ,"SELECT * FROM products WHERE product_id='$iod' ");

$r = mysqli_fetch_assoc($q);


// user not found


global $r;
?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Please Be Responsible When Making Changes <BR> You Need To Change All The Fields Manually EX:If You Changed The Size Or Adding a Real Size Then You Need To Change The Product Code Manually To Fit With The New Data!.</b></div>

<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>You Are Editing The Product Code: <?php echo $r['product_Code']; ?></b></div>
<div id="container" align="center" >

<div id="container" align="center" >

<div class="row" align="center" class="align-center">
  <div class="col-md-4" class="align-center">
    <br>
    <div id="myTabContent" class="tab-content" class="align-center">
      <div class="tab-pane active in" id="home" class="align-center">

          <div class="align-center">
      <form id="tab" method="post" align="center" postion="absolute" class="align-center">

        <div class="form-group align-center">

        <label>Product Code</label>
        <input type="text" value="<?php echo $r['product_Code'];?>" class="form-control" name="product_Code">
        </div> </div>
        <div class="form-group">
        <label>Product Name</label>
        <input type="text" value="<?php echo $r['Product_Name'];?>" class="form-control" name="Product_Name">
        </div>
        <div class="form-group">
        <label>Product Size</label>
        <input type="text" value="<?php echo $r['product_Size'];?>" class="form-control" name="product_Size">
        </div>
        <div class="form-group">
        <label>Product Color</label>
        <input type="text" value="<?php echo $r['product_Color'];?>" class="form-control" name="product_Color">
        </div>
        <div class="form-group">
        <label>Product Quantity</label>
        <input type="text" value="<?php echo $r['product_Quantity'];?>" class="form-control" name="product_Quantity">
        </div>
        <div class="form-group">
        <label>Product Real Size</label>
        <input type="text" value="<?php echo $r['Real_Size'];?>" class="form-control" name="Real_Size">
        </div> 
        <label>Product Price</label>
        <input type="text" value="<?php echo $r['product_Price'];?>" class="form-control" name="product_Price">
        </div>
         <label>Product Note</label>
        <input type="text" value="<?php echo $r['product_Note'];?>" class="form-control" name="product_Note">
        </div>
        <br>
        <input type="submit" class="btn btn-primary" name="op" value="Update" />
        <input type="submit" class="btn btn-danger" name="op" value="Delete" />
        <input type="reset" value="Reset" class="btn btn-reset"/>

        <input type="button" value="Back" class="btn btn-primary" onclick="window.location.replace('./ProductsEdit.php')"/>
        </form> </div>
      </div>
    </div>
  </div>
  </div>
<?php
if (isset($_POST['product_Code']) && isset($_POST['Product_Name'])&& isset($_POST['product_Price'])){
    $Product_Code = $_POST['product_Code'];
    $Product_Name = $_POST['Product_Name'];
    $Product_Size = $_POST['product_Size'];
    $Product_Color = $_POST['product_Color'];
    $Product_Quantity = $_POST['product_Quantity'];
    $Product_RealSize = $_POST['Real_Size'];
    $Product_Price = $_POST['product_Price'];
    $Product_Note = $_POST['product_Note'];



$id = mysqli_real_escape_string($connection, $_GET['id']);
if($_POST['op'] and $_POST['op'] == "Update"){
   $qq = mysqli_query($connection, "UPDATE products SET product_Code='$Product_Code',Product_Name='$Product_Name',product_Size='$Product_Size',product_Color='$Product_Color', product_Quantity='$Product_Quantity',Real_Size='$Product_RealSize',product_Price='$Product_Price',product_Note='$Product_Note' WHERE product_id='$id' ");
   if($qq){
     echo "<b><font color='green'>Editing Done !!</font></b>";
echo "<script language='javascript'>   location.replace('./ProductEdit.php?id='+ ".$id.") </script>";
   }else{
    echo "<b><font color='red'>Editing Error !!</font></b>";
    echo mysqli_error($connection);

   }
}else if($_POST['op'] && $_POST['op'] == "Delete"){
   $qq = mysqli_query($connection, "DELETE FROM products WHERE product_id='$id'");
   
   if($qq){
     echo "<b><font color='green'>Product Deleted !!</font></b>";
   }else{
    echo "<b><font color='red'>Product not Deleted !!</font></b>";
   echo mysqli_error($connection,$qq);
   }
}

}

?>
		</div>
      </main>
    </div>

  </body>
</html>