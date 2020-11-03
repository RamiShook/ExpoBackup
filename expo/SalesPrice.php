<?php
include('info.php');
if (!isset($_SESSION['type'])){
    HEADER("LOCATION: ./ajx.html");
}
$strt = $_GET['strt'];
$to = $_GET['to'];
global $strt,$to;
?>
<html>
  <head>
      <style>
          .thumbnailz:active {
 position:fixed;
    top:0px;
    left:0px;
    width:500px;
    height:auto;
    display:block;
    z-index:999;
    margin:auto; /* Will not center vertically and won't work in IE6/7. */

   
}
          
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
          <span class="mdl-layout-title">Sent Orders Between <?php echo ".$strt. AND .$to. " ?></span>
         
      </header>
      <div class="mdl-layout__drawer">
        
      <span class="mdl-layout-title"><div id="meee"> <a href='index.php'> EXPO</a></div></span>
        <nav class="mdl-navigation">
        <?php if(isset($_SESSION['type']) && ($_SESSION['type']=="worker")){
          include ('DefUserOptions.php');
        }        
           else if(isset($_SESSION['type']) && ($_SESSION['type']=="admin")){
            include('AdminOptions.php');
          }else if(isset($_SESSION['type'])&& ($_SESSION['type']=="Fulfillment") ){
            include('Fulfillment/FulfOptions.php');
        
          }else{
echo"You Need To Login First!";
         }
          ?>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="page-content"><!-- Your content goes here -->
      
		<div align="center">
<label for="start">Start date:</label>
<input type="date" id="start" name="trip-start"
       value="<?php echo $strt ?>"
       min="2020-01-01" max="2030-12-31" >
       
       &nbsp; &nbsp; &nbsp; 
       <label for="end">End date:</label>
<input type="date" id="end" name="trip-start"
       value="<?php echo $to ?>"
       min="2020-01-01" max="2030-12-31" >
       <br> <input type ="button" value="Calculate" onclick="printDate()"></input>
       <br> <br> <br>
       Total Sum Of The <U> <B>Sent</B></U> Orders Between <u> <b> <?php echo $strt ?> </b></u>AND <u> <b> <?php echo $to ?></u></b>  IS:   <br>
       <?PHP
    include("./config.php");
    $wkid=$_SESSION['uid'];
     $q = mysqli_query($connection, "
     SELECT sum(reserve_full_price) FROM multiple_reserved
     where ( CAST(reserve_date AS DATE) between '$strt'  AND  '$to') AND (multiple_reserve_status='Sent') ORDER BY `multiple_reserve_id` DESC");
     
     
       while($row = mysqli_fetch_assoc($q)){
           
           $amount = $row['sum(reserve_full_price)'];
           
$formatter = new NumberFormatter('en_GB',  NumberFormatter::CURRENCY);
echo ': ', $formatter->formatCurrency($amount, 'LBP');

          // echo $row['sum(reserve_full_price)'];
       }
     ?>
       <BR>
           <br> 
           <b><u>Note:</u></b> For Now We Calculate The Sum Of Prices Just For The <B> <U>Sent Orders</U></B>, And <U><B> Delivery Charge Not Counted.</B></U> 
           <br>
           <br> 
         <a href= 'https://cedarslandshoes.com/expo/LoadWay.php?strt=<?php echo $strt ?>&to=<?php echo $to ?>'> See <u><b>All</b></u> Orders Between <?php echo ".$strt. AND .$to. " ?>   </a> 
           	<bR><BR><BR>	<bR><BR><BR>	<div align="center">
      Codded By Rami Shook<br>
      FOR More Details : 79103686<br>
      ‫admin@cedarslandshoes.com‬


   
	  
		
		
</div>
       </body>


<script>
function printDate(){
    var end_date = document.getElementById("end").value;
    strt_date = document.getElementById("start").value;
        window.location.replace('https://cedarslandshoes.com/expo/SalesPrice.php?strt='+strt_date+'&to='+end_date)

}

function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("productTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function SearchByName() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("NameInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("productTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
		</div>
      </main>
    </div>
  </body>

</html>
