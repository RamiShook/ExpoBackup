<?php
include('info.php');
include('config.php');
if (!isset($_SESSION['type'])){
    HEADER("LOCATION: ./ajx.html");

}
?>
<html>
  <head>
<script> window['Tab'] = 0;
    window['counter'] = 0;
    window['Allprice'] = 0;
    window['close'] = 0;
    window['rownb'] =0;
   

//var seized = new Array();
if(close == 0){ 
  window.onbeforeunload = function() {
          return "you can not refresh the page";
       } }

   

 </script>
 
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
  <body onload="createTable()">
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">Dashboard</span>
         
      </header>
      <div class="mdl-layout__drawer">
        
      <span class="mdl-layout-title"><div id="meee"> <a href='index.php'> EXPO</a></div></span>
        <nav class="mdl-navigation">
        <?php if(isset($_SESSION['type']) && ($_SESSION['type']=="Centerworker")){
          include ('DefUserOptions.php');
        }        
           else if(isset($_SESSION['type']) && ($_SESSION['type']=="Centeradmin")){
            include('AdminOptions.php');
          }else{
echo"You Need To Login First!";
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
   
      

  
    <div class="">
        <div class="panel panel-default">
        <div class="panel-heading no-collapse">  <center>Total Rows Opened: <span class="label label-warning" id="TabsCount"> 0 </center></span>
        <div class="panel-heading no-collapse">  <center>Total Reservation (In This Session): <span class="label label-warning" id="TotalReservation"> 0 </center></span>
        <?php 
echo "<hr>"
//echo "the worker id = ".$WorkerId['0'];
//echo "the client id = ".$ClientId['0'];
?>
        <input type="button" id="addRow" value="Add New Row" onclick="addRow()" />

        </div>

        <div id="cont"> </div>
        



<div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>




        <dialog class="mdl-dialog">
        <h4 class="mdl-dialog__title">Dealing With a New Client?</h4>
    <div class="mdl-dialog__content">
    This Phone Number I Not Inserted In The Database.<br>Pleasae Fill The Client Info Before Continue The Reservation
      <p>
          <form id="myForm">
          <div class="mdl-textfield mdl-js-textfield">

              <label for="PhoneNumber" class="mdl-textfield__label">Phone Number:</label>
      <input type="text" placeholder="Client Phone Number" id="PhoneNumber" name="phone" class="mdl-textfield__input" required />
      </div>
      <div class="mdl-textfield mdl-js-textfield">

      <label for="FullName" class="mdl-textfield__label">FullName:</label>
      <input type="text" placeholder="Client Full Name" class="mdl-textfield__input" id="FullName" name="name" required/>
</div>
<div class="mdl-textfield mdl-js-textfield">

      <label for="Address" class="mdl-textfield__label">Address:</label> 
      <input type="text" placeholder="Client Address"class="mdl-textfield__input"  name="address" id="Address" required/>
</div>
      <div class="mdl-textfield mdl-js-textfield">

      <label for="Notes" class="mdl-textfield__label">Notes:</label>
      <input type="text" placeholder="Client Notes" class="mdl-textfield__input" id="Notes" name="notes" required/>
      </div>

</form>
      </p>
    </div>

    <div class="mdl-dialog__actions--full-width">
        <input type="button" class="mdl-button close" value="Submit" onclick="subForm()"></input>
    </div>
  </dialog>





 
              <button class="mdl-button mdl-button--raised mdl-js-button dialog-button-1 hidden" id="vModal">View Product</button>

              <dialog id="dialog-1" class="mdl-dialog">
                  <h3 class="mdl-dialog__title" id="pcd">Product 2</h3>
                  <div class="mdl-dialog__content">
                    <p>
                      <div id="pinfo"> </div>
                    </p>
                  </div>
                  <div class="mdl-dialog__actions">
                    <button type="button" class="mdl-button">Close</button>

                  </div>
                </dialog>



















<script language="javascript">
 (function() {
    'use strict';
    var dialogButton = document.querySelector('.dialog-button-1');
    var dialog = document.querySelector('#dialog-1');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    dialogButton.addEventListener('click', function() {
       dialog.showModal();
    });
    dialog.querySelector('button:not([disabled])')
    .addEventListener('click', function() {
      dialog.close();
    });

    dialog.addEventListener('click', function (event) {
    var rect = dialog.getBoundingClientRect();
    var isInDialog=(rect.top <= event.clientY && event.clientY <= rect.top + rect.height && rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
    if (!isInDialog) {
        dialog.close();
    }
});
  }());
function GetPhoneFieldId(){
var id=id+1;
console.log(id)
console.log("got into the function")
return id;
}

function CheckClient(x){
    var PhoneNb=x.value;
if(PhoneNb.length>=8){

    var xmlhttp;
if(window.XMLHttpRequest)
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState ==4 & xmlhttp.status ==200)
    //krmel a3melo redirect eza ken l username wl password mazbutin
        if (xmlhttp.responseText.length==3){
            console.log("Founded!")

        }
        else {
            console.log(xmlhttp.responseText.length)
            console.log("New Phone Number")
            
        }
}
xmlhttp.open("GET","./Functions.php?phonenb="+PhoneNb,true);
xmlhttp.send();
}

}



</script>







<script>
    var arrHead = new Array();	// array for header.
    arrHead = ['#','Remove Row','Client Phone Number', 'Product Code','Check!', 'Quantity', '','Price','Reserve',' '];

    // first create TABLE structure with the headers. 
    function createTable() {
        var empTable = document.createElement('table');
        empTable.setAttribute('id', 'empTable'); // table id.
        empTable.setAttribute('class', 'table table-bordered table-striped');




        var tr = empTable.insertRow(-1);
        for (var h = 0; h < arrHead.length; h++) {
            var th = document.createElement('th'); // create table headers
            th.innerHTML = arrHead[h];
            tr.appendChild(th);
        }

        var div = document.getElementById('cont');
        div.appendChild(empTable);  // add the TABLE to the container.
    }

    // now, add a new to the TABLE.
    function addRow() {

      document.getElementById('TabsCount').innerHTML= ++Tab;
        RandomId = Math.floor(Math.random() * 9999999); 
        var empTab = document.getElementById('empTable');

        var rowCnt = empTab.rows.length;   // table row count.
        var tr = empTab.insertRow(rowCnt); // the table row.
        tr = empTab.insertRow(rowCnt);

        for (var c = 0; c < arrHead.length; c++) {
            var td = document.createElement('td'); // table definition.
            td = tr.insertCell(c);
            if (c == 0) {      // the first column.
                // add a button in every new row in the first column.
                var button = document.createElement('strong');

                button.innerHTML=++rownb;




                td.appendChild(button);
            }
            if (c == 1) {      
                // add a button in every new row in the first column.
                var button = document.createElement('input');

                // set input attributes.
                button.setAttribute('type', 'button');
                button.setAttribute('value', 'Remove');
                button.setAttribute('id', 'Remove'+RandomId);


                // add button's 'onclick' event.
                button.setAttribute('onclick', 'removeRow(this)');

                td.appendChild(button);
            }
            //Phone Number
            else if(c==2) {
                /*
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('id','ClientPhoneNumber'+RandomId)
                ele.setAttribute('disabled','true')

                ele.setAttribute('value','');
                ele.setAttribute('onblur', 'CheckPhoneNumber(this.id)');
              // ele.setAttribute('size', '12');


                td.appendChild(ele);*/
            }
            //Product Code
            else if(c==3) {
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('value', '');
                ele.setAttribute('id','ProductCode'+RandomId)
                ele.setAttribute('size', '14');


                td.appendChild(ele);
            } //product info 
             else if(c==4) {
                var ele = document.createElement('input');
                ele.setAttribute('type', 'button');
                ele.setAttribute('value', 'Check!');
                ele.setAttribute('id','check'+RandomId);
               // ele.setAttribute('click','GetProductInfo("ProductCode'+RandomId");
                ele.setAttribute('onclick','GetProductInfo('+RandomId+')');

                td.appendChild(ele);
            }
            else if(c==5) {
                //Quantity
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('value', '');
                ele.setAttribute('id','Quantity'+RandomId)
                ele.setAttribute('onkeyup', 'CalcPrice(this.id,'+RandomId+')');
                ele.setAttribute('size', '10');


                td.appendChild(ele);
            }

            else if(c==6) {
                //Notes
                var ele = document.createElement('input');
                ele.setAttribute('type', 'button');
                ele.setAttribute('value', 'Seize!');
                ele.setAttribute('id','Seize'+RandomId)
                ele.setAttribute('onclick', 'Seize(this.id,'+RandomId+')');
ele.setAttribute('hidden','true')


                td.appendChild(ele);
            }
            else if(c==7) {
                // Price
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text')
                ele.setAttribute('value', '');
                ele.setAttribute('disabled', 'true');

                ele.setAttribute('id','Price'+RandomId)
                ele.setAttribute('Name','Price'+RandomId)
                ele.setAttribute('size', '9');


                td.appendChild(ele);
            }
            else if(c==8) {
                //confirm
                var btn = document.createElement('input');
                btn.setAttribute('id',RandomId);
                btn.setAttribute('type','button')

                btn.setAttribute('value','Confirm')
                btn.setAttribute('onclick','SendData(this.id)');
                td.appendChild(btn);

            }
            else if(c==9) {
                var btn = document.createElement('input');
                btn.setAttribute('id','multi'+RandomId);
                btn.setAttribute('type','button')
                btn.setAttribute('disabled','true')
                btn.setAttribute("hidden", true);

                btn.setAttribute('value','Unreserve')
                btn.setAttribute('onclick','unreserve(this.id,'+RandomId+')');
                td.appendChild(btn);

            }
        }
        var Thehr = document.createElement('br')

        tr.appendChild(Thehr)
    }

    // delete TABLE row function.
    function removeRow(oButton) {
      x=confirm("Are You Sure You Want To Remove This Row!\nYou Cannot Undo After This!");
      if(x){ 
      document.getElementById("TabsCount").innerHTML= --Tab;
        var empTab = document.getElementById('empTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
    } }




    function GetProductInfo(x){
  document.getElementById("vModal").click()

  code = document.getElementById("ProductCode"+x).value;

  var xmlhttp;
if(window.XMLHttpRequest){ 
xmlhttp = new XMLHttpRequest(); 

console.log("XML HTTP REQUEST CREATED")  } 
else {console.log("NO XML HTTP REQUEST IN THIS PAGE")       }
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
var Pinfo = xmlhttp.responseText;
document.getElementById("pinfo").innerHTML=""+Pinfo;
document.getElementById("pcd").innerHTML="CODE:"+code;
}
xmlhttp.open("GET","./Functions.php?GetProductInfo="+code,false);
xmlhttp.send();

}








    function SendData(TheId){
        var mresid =<?php echo $_GET['mresid'] ?>;
 var pcode = document.getElementById("ProductCode"+TheId).value;
 var pprice = document.getElementById("Price"+TheId).value;
 var pqty = document.getElementById("Quantity"+TheId).value;
 console.log("Processing The Data: pcode: "+pcode+" pprice: "+pprice);
 console.log("Proceesing Data..."+mresid);
 var xmlhttp;
if(window.XMLHttpRequest){ 
xmlhttp = new XMLHttpRequest(); 

console.log("XML HTTP REQUEST CREATED")  } 
else {
    console.log("NO XML HTTP REQUEST IN THIS PAGE")       }
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
console.log("Request Sent")
document.getElementById(TheId).disabled=true;
}
xmlhttp.open("GET","./AddProductFunctions.php?AddPTomres="+mresid+"&pcode="+pcode+"&pprice="+pprice+"&pqty="+pqty,false);
xmlhttp.send();

}
 




function CalcPrice(x,id){
      console.log(x);
      console.log(id)
      v=x;
        var xy=id;
        productCode=document.getElementById("ProductCode"+xy).value;
    RealPrice= 0;
    var xmlhttp;
if(window.XMLHttpRequest){ 
xmlhttp = new XMLHttpRequest(); 

console.log("XML HTTP REQUEST CREATED")  } 
else {
    console.log("NO XML HTTP REQUEST IN THIS PAGE")       }
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
RealPrice = xmlhttp.responseText;
}
xmlhttp.open("GET","./Functions.php?productCode="+productCode,false);
xmlhttp.send();

//after getting the product price
RealPrice *= parseInt(document.getElementById(x).value);
document.getElementById("Price"+xy).value=RealPrice;
QnatityCheck(x,xy,productCode);

}

function QnatityCheck(x,xy,productCode){
var pcode=productCode;
var Quantity=document.getElementById(x).value;
var rndId=xy;

if(window.XMLHttpRequest){ 
xmlhttp = new XMLHttpRequest(); 

console.log("XML HTTP REQUEST CREATED")  } 
else {console.log("NO XML HTTP REQUEST IN THIS PAGE")       }
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
AvQuantity = xmlhttp.responseText;
}
xmlhttp.open("GET","./Functions.php?QuantityCheck="+productCode,false);
xmlhttp.send();

if (parseInt(AvQuantity) < parseInt(Quantity)){
  alert("The Quantity That You Want To Reserve Is Greater Than The Available Quantity For This Product. \nPlease Check The Product Again From The Available Product Page.\nDont Forget To Refresh The Av.Product Page!.\nIf You Think Something Goes Wrong Please Contact The Admin.")

  document.getElementById(x).className += "is-invalid text-danger form-control";

}else{
  
  document.getElementById(x).classList.remove("text-danger");
            document.getElementById(x).classList.remove("form-control");
            document.getElementById(x).classList.remove("is-invalid");

}
}
</script>


</div>
      </main>
    </div>
  </body>
</html>     