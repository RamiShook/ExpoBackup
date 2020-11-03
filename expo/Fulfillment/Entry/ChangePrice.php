<?php
include('../../info.php');
include('../../config.php');
if (isset($_GET['logout'])){
  session_destroy();
  Echo "Logged Out , Please Login Again To Get All The Site Feature's.";
  header("Refresh: 3; url= ../../ajx.html");

}
?>
<!DOCTYPE html>
<!--
    Licensed to the Apache Software Foundation (ASF) under one
    or more contributor license agreements.  See the NOTICE file
    distributed with this work for additional information
    regarding copyright ownership.  The ASF licenses this file
    to you under the Apache License, Version 2.0 (the
    "License"); you may not use this file except in compliance
    with the License.  You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing,
    software distributed under the License is distributed on an
    "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
     KIND, either express or implied.  See the License for the
    specific language governing permissions and limitations
    under the License.
-->
<html>
    <head>
	
        <link rel="icon" href="https://cedarslandshoes.com/expo/photo/ExpoLogo.jpg">

        <!--
        Customize this policy to fit your own app's needs. For more guidance, see:
            https://github.com/apache/cordova-plugin-whitelist/blob/master/README.md#content-security-policy
        Some notes:
            * gap: is required only on iOS (when using UIWebView) and is needed for JS->native communication
            * https://ssl.gstatic.com is required only on Android and is needed for TalkBack to function properly
            * Disables use of inline scripts in order to mitigate risk of XSS vulnerabilities. To change this:
                * Enable inline JS: add 'unsafe-inline' to default-src
        -->
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
        <link rel="stylesheet" type="text/css" href="../../css/index.css">
		<link rel="stylesheet" href="../../css/material.min.css">
				<link rel="stylesheet" href="../../css/mysheet.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../assets/bootstrap.css">
<script type="text/javascript" src="../../assets/jquery.js"></script>
<script type="text/javascript" src="../../assets/bootstrap.js"></script>
<script type="text/javascript" src="../../assets/bootbox.min.js"></script>
<script type="text/javascript" src="../../assets/sorttable.js"></script> 
<script src="../../js/material.min.js"></script>
<script src="../../js/myscripts.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </script>
    </head>
    
  <body id="body">
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">Change Product Price.</span>
         
      </header>
      <div class="mdl-layout__drawer">
      <span class="mdl-layout-title"><div id="meee"> <a href='../index.php'> EXPO</a></div></span>
        <nav class="mdl-navigation">
        <?php 
         if(isset($_SESSION['type'])&& ($_SESSION['type']=="Fulfillment") ){
            include('FulfOptions.php');
        
          }else{
echo"You Need To Login First!";
         }
          ?>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="page-content"><!-- Your content goes here -->
<div id="container" align="center" >
<br>


Change Product Price <div class="panel panel-default">
          <div class="panel-heading no-collapse">  <center><span class="label label-warning">Note That The Old Price Will Be Replaced By Price You Entered!. </center><br><span class="label label-warning">You Can Specify a Product By Entering The Full Code Or Just Enter The Code Without The Color/Size To Change All Pieces price. </center></span></div>
        
<br>
<br>
<lable for="Pcode">Product Code:</label>
<input type="text" placeholder="EX:C200" id="Pcode" onblur="CheckCode(this.value)"> </input>
<br>
<br>

<lable for="Price">Price:</label>
<input type="text" placeholder="EX:10000" id="Price" disabled> </input>



<br>
<br> <div id ="TheResult"></div>
<br>

<input type="button" id="sbmt" onclick="sbmt()"value="Change The Product Price"> </input>
<br> <br> <div id = "AddingResult"> </div>
<hr>
<div id="AddNew" hidden="true"> <input type="button" value="New Operation!" onClick="window.location.reload();"></input> </div>


</div>

<div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

</body>
<script language = "javascript">




function CheckCode(Pcode){
    var xmlhttp;
if(window.XMLHttpRequest)
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState ==4 & xmlhttp.status ==200)
        if (xmlhttp.responseText.indexOf('Founded') != -1){
console.log("Product Not Founded")
document.getElementById("TheResult").innerHTML= xmlhttp.responseText;
document.getElementById("Price").disabled = true;



        }
        else {
            document.getElementById("TheResult").innerHTML="Currently Product Price: "+ xmlhttp.responseText;

            console.log(xmlhttp.responseText)
            console.log("Holly Crap Founded")
            document.getElementById("Price").disabled = false;
            
        }
}
let d = new Date();
let timestamp = d.getTime();
xmlhttp.open("GET","./AddQFunctions.php?ProductCode="+Pcode+"&GetPrice=1"+"&Random="+timestamp,true);
xmlhttp.send();
    
}




function sbmt(){
    var price = document.getElementById("Price").value;
    Pcode =  document.getElementById("Pcode").value;
    xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState ==4 & xmlhttp.status ==200)
       console.log("Requested!")
       document.getElementById("AddingResult").innerHTML = xmlhttp.responseText;
       document.getElementById("AddNew").hidden= false;
       (function(){
    'use strict';
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var data = {message: 'Good! Price Chnaged!'};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
  }());

       CheckCode(Pcode);

       
}
let d = new Date();
let timestamp = d.getTime();
    

xmlhttp.open("GET","./AddQFunctions.php?ProductCodeForPrice="+Pcode+"&PriceAdd="+price+"&&Random="+timestamp,true);
xmlhttp.send();

}
</script>
</html>
