<?php include('info.php');
if ($_SESSION['type']!="Fulfillment"){
    HEADER("LOCATION:../ajx.html");
}
?>
<?php
include('../config.php');
if(isset($_FILES['image'])){

  
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
     // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      // if(in_array($file_ext,$extensions)=== false){
      //    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      // }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"./../photo/".$file_name);
         echo "Success<br>";
         echo "The Photo Name: ".$file_name;
         $file_name_path ="./photo/".$file_name; 

          if (isset($_POST['ssad']) && $_POST['ssad']!=""){
          echo $_POST['ssad'];
          $pcodess=$_POST['ssad'];
          echo"product_Code LIKE'%$pcodess%'" ;
          $AddPhotoQueryText="UPDATE products SET product_photo_path ='$file_name_path' WHERE product_Code LIKE'%$pcodess%' ";
          mysqli_query($connection,$AddPhotoQueryText)or die(mysqli_error($connection));
      
        }else if (!isset($_POST['ssad']) || $_POST['ssad']==""){
          echo"ssad not posted";
         $PID=$_GET['id'];
         $AddPhotoQueryText="UPDATE products SET product_photo_path ='$file_name_path' WHERE product_id='$PID' ";
         mysqli_query($connection,$AddPhotoQueryText)or die(mysqli_error($connection));
      }}else{
         print_r($errors);
      }
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
          <link rel="stylesheet" type="text/css" href="../css/index.css">
		<link rel="stylesheet" href="../css/material.min.css">
<script src="../js/material.min.js"></script>
<script src="../js/myscripts.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assets/bootstrap.css">
<script type="text/javascript" src="../assets/jquery.js"></script>
<script type="text/javascript" src="../assets/bootstrap.js"></script>
<script type="text/javascript" src="../assets/bootbox.min.js"></script>
<script type="text/javascript" src="../assets/sorttable.js"></script> 
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
include "../config.php";
$iod = $_GET['id'];
$q = mysqli_query($connection ,"SELECT * FROM products WHERE product_id='$iod' ");

$r = mysqli_fetch_assoc($q);


// user not found


global $r;
?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>if The Product Already Have a Photo This Will Override The Old Photo.</b></div>

<div id="container" align="center" >

<div id="container" align="center" >

<div class="row" align="center" class="align-center">
  <div class="col-md-4" class="align-center">
    <br>
    <div id="myTabContent" class="tab-content" class="align-center">
      <div class="tab-pane active in" id="home" class="align-center">

          <div class="align-center">
    

        <div class="form-group align-center">

        <label>Product Code</label>
        <input type="text" value="<?php echo $r['product_Code'];?>" class="form-control" name="product_Code" disabled>
        </div> </div>
       
         <label>Product Photo(If Founded!)</label><br>
        <?php echo '<td> <img src= "../'.$r['product_photo_path'].'"  class="thumbnailz" height="40px" width="100px" alt="No Available Photo" ></img></td>
      ';?> 
     
     <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
                   </br>
                   <input type="radio" id="ThisProduct" name="ThisProduct" value="thisP" checked></input> 
                   <label for="ThisProduct" >Change The Photo Just For This Product <label>
                   <input type="radio" id="AllProduct" name="ThisProduct" value="allP"></input>
                   <label for="AllProduct" >Change The Photo For All Product Code Start With: <label>
<br>
<br>
                   <input type="text" id="sad" name="ssad" size="60" hidden placeholder="Enter The Product Code(Without Color And Size EX:C200)" DISABLED> </input>
                   <br>
         <input type="submit"/>
      </form>
        <br>
         </div>
      </div>
    </div>
  </div>
  </div>

		</div>
      </main>
    </div>

  </body>
  <script>
 document.addEventListener('input',(e)=>{
if(e.target.getAttribute('name')=="ThisProduct")
if(e.target.value=="thisP"){
        document.getElementById("sad").hidden=true;
        document.getElementById("sad").disabled=true;

          
   } else if(e.target.value=="allP") {
     
        document.getElementById("sad").hidden=false;
        document.getElementById("sad").disabled=false;


          
}
})

  </script>
</html>