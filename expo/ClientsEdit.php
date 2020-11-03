<?php include('info.php');
if (!isset($_SESSION['type'])){
    HEADER("LOCATION:./ajx.html");
}
?>
<html>
  <head>
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
          <span class="mdl-layout-title">Client's</span>
         
      </header>
      <div class="mdl-layout__drawer">
        
      <span class="mdl-layout-title"><div id="meee"> <a href='index.php'> EXPO</a></div></span>
        <nav class="mdl-navigation">
      <?php if(isset($_SESSION['type']) && ($_SESSION['type']=="worker")){
          include ('DefUserOptions.php');
        }
         
           else if(isset($_SESSION['type']) && ($_SESSION['type']=="admin")){
            include('AdminOptions.php');
          }else{
            include('DefUserOptions.php');
          }
          ?>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="page-content"><!-- Your content goes here -->
        <script>
	$(function() {
		$(".preload").fadeOut(500, function() {
			$(".content").fadeIn(0);
		});
	});
</script> 
     <div class="preload">
<div id="mydiv" align="center"><img src="assets/wait.gif" class="ajax-loader"></div>   </div>
		<div align="center">
    <?PHP
    include("./config.php");
     $q = mysqli_query($connection, "SELECT * FROM clients")or die(mysqli_error($connection));
     $t = mysqli_num_rows($q);

     $record_count = mysqli_num_rows($q);

     echo '
    <div class="">
        <div class="panel panel-default">
          <div class="panel-heading no-collapse">  <center>Total Clients <span class="label label-warning">'.$t.'  </center></span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Client id</th>
                  <th>Client Full Name</th>
                  <th>Client Address</th>
                  <th>Client Phone</th>
                  <th>Notes</th>
                  
                  
                </tr>
              </thead>
              <tbody>';
  while($row = mysqli_fetch_assoc($q)){
              echo '<tr>
                  <td>'.$row['client_id'].'</td>
                  <td>'.$row['client_FullName'].'</td>
                  <td>'.$row['client_Address'].'</td>
                  <td>'.$row['client_Phone'].'</td>
                  <td>'.$row['client_Notes'].'</td>
                  
                  <td>
      <a href="ClientEdit.php?id='.$row['client_id'].'"><center><span class="btn label-danger"><font color=white>Edit/Delete</font></center></span></a>
      </td><td>'; }



?>
		</div>
      </main>
    </div>
  </body>
</html>