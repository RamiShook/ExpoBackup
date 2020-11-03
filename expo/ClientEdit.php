<?php include('info.php');
if (!isset($_SESSION['type'])){
    HEADER("LOCATION:./ajx.html");
}
?>
<html>
  <head>
              <link rel="icon" href="https://cedarslandshoes.com/expo/photo/ExpoLogo.jpg">

<style>
/* 
.center_div{
    align:center;
    width:80%
} */
</style>
  
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
          <span class="mdl-layout-title">Client Edit</span>
         
      </header>
      <div class="mdl-layout__drawer">
        
      <span class="mdl-layout-title"><div id="meee"> <a href='index.php'>EXPO</a></div></span>
        <nav class="mdl-navigation">
      <?php if(isset($_SESSION['type']) && ($_SESSION['type']=="worker")){
          include ('DefUserOptions.php');
        }else if(isset($_SESSION['type']) && ($_SESSION['type']=="admin")){
          include ('AdminOptions.php');
        }else{
            include('DefUserOptions.php');
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
$q = mysqli_query($connection ,"SELECT * FROM clients WHERE client_id='$iod' ");

$r = mysqli_fetch_assoc($q);


// user not found


global $r;
?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Please Be Responsible When Making Changes <BR> Deleting a Client That Related To Order's Can Harm The Database.!</b></div>

<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>You Are Editing The Client <?php echo $r['client_FullName']; ?></b></div>
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

        <label>Client Full Name</label>
        <input type="text" value="<?php echo $r['client_FullName'];?>" class="form-control" name="client_FullName">
        </div> </div>
        <div class="form-group">
        <label>Client Address</label>
        <input type="text" value="<?php echo $r['client_Address'];?>" class="form-control" name="client_Address">
        </div>
        <div class="form-group">
        <label>Client Phone Number</label>
        <input type="text" value="<?php echo $r['client_Phone'];?>" class="form-control" name="client_Phone">
        </div>
        <div class="form-group">
        <label>Notes</label>
        <input type="text" value="<?php echo $r['client_Notes'];?>" class="form-control" name="client_Notes">
            </div>
        <br>
        <input type="submit" class="btn btn-primary" name="op" value="Update" />
        <input type="submit" class="btn btn-danger" name="op" value="Delete" />
        <input type="reset" value="Reset" class="btn btn-reset"/>

        <input type="button" value="Back" class="btn btn-primary" onclick="window.location.replace('./ClientsEdit.php')"/>
        </form> </div>
      </div>
    </div>
  </div>
  </div>
<?php
if (isset($_POST['client_FullName']) && isset($_POST['client_Address'])&& isset($_POST['client_Phone'])){
    $client_FullName= $_POST['client_FullName'];
    $client_Address= $_POST['client_Address'];
    $client_Phone= $_POST['client_Phone'];
    $client_Notes= $_POST['client_Notes'];



$id = mysqli_real_escape_string($connection, $_GET['id']);
if($_POST['op'] and $_POST['op'] == "Update"){
   $qq = mysqli_query($connection, "UPDATE clients SET client_FullName='$client_FullName',client_Address = '$client_Address', client_Phone = '$client_Phone',client_Notes ='$client_Notes'  WHERE client_id='$id' ");
   if($qq){
     echo "<b><font color='green'>Editing Done !!</font></b>";
echo "<script language='javascript'>   location.replace('./ClientEdit.php?id='+ ".$id.") </script>";
   }else{
    echo "<b><font color='red'>Editing Error !!</font></b>";
    echo mysqli_error($connection);

   }
}else if($_POST['op'] && $_POST['op'] == "Delete"){
   $qq = mysqli_query($connection, "DELETE FROM clients WHERE client_id='$id'");
   
   if($qq){
     echo "<b><font color='green'>Client Deleted !!</font></b>";
   }else{
    echo "<b><font color='red'>Client not Deleted !!</font></b>";
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