<?php include('info.php');
if (!isset($_SESSION['type'])){
    HEADER("LOCATION: ./ajx.html");}
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); header( 'Cache-Control: no-store, no-cache, must-revalidate' ); header( 'Cache-Control: post-check=0, pre-check=0', false ); header( 'Pragma: no-cache' );
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

<script> window['Tab'] = 0;
    window['rownb'] =0;

 // confirmed = new array();


window.onbeforeunload = function() {
            return "you can not refresh the page";
        }


        seized = new Array();
 </script>
 </script>
 
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes ">
          <link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" href="css/material.min.css">
<script src="js/material.min.js"></script>
<script src="js/myscripts.js"></script>
<link rel="stylesheet" type="text/css" href="css/pic.css">

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
        <?php if(isset($_SESSION['type']) && ($_SESSION['type']=="worker")){
          include ('DefUserOptions.php');
        }        
           else if(isset($_SESSION['type']) && ($_SESSION['type']=="admin")){
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
      <input type="text" placeholder="Client Phone Number" id="PhoneNumberDialog" name="phone" class="mdl-textfield__input"  />
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
    arrHead = ['#','Remove Row','Client Phone Number', 'Product Code','Check!', 'Quantity','Seize','Notes','Price','Reserve','Multiple Order'];

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
                // set input attributes.
              //  button.setAttribute('type', 'text');
                //button.setAttribute('disabled', 'true');
                //button.setAttribute('size', '3');
                //button.setAttribute('value', ++rownb);




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
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('value', '');
                ele.setAttribute('id','ClientPhoneNumber'+RandomId)
                ele.setAttribute('value', '');
                ele.setAttribute('onblur', 'CheckPhoneNumber(this.id,'+RandomId+')');
              // ele.setAttribute('size', '12');


                td.appendChild(ele);
                var dv=document.createElement('div');
                dv.setAttribute('id','TheDv'+RandomId);
                dv.setAttribute('hidden','true');
                td.appendChild(dv);
            }
            //Product Code
            else if(c==3) {
                var cnt = document.createElement('div');
                cnt.setAttribute('id','xx'+RandomId);
                
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('value', '');
                ele.setAttribute('id','ProductCode'+RandomId)
                ele.setAttribute('size', '14');

                cnt.appendChild(ele);
                td.appendChild(cnt);
            } //product info 
             else if(c==4) {
                var ele = document.createElement('input');
                ele.setAttribute('type', 'button');
                ele.setAttribute('value', 'Check!');
                ele.setAttribute('id','Check'+RandomId);
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
            }else if(c==6){//seize
                var ele = document.createElement('input');
                ele.setAttribute('type', 'button');
                ele.setAttribute('value', 'Seize!');
                ele.setAttribute('id','Seize'+RandomId)
                ele.setAttribute('onclick', 'Seize(this.id,'+RandomId+')');
                td.appendChild(ele);

            }

            else if(c==7) {
                //Notes
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('value', '');
                ele.setAttribute('id','Notes'+RandomId)
                ele.setAttribute('size', '20');


                td.appendChild(ele);
            }
            else if(c==8) {
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
            else if(c==9) {
                //confirm
                var btn = document.createElement('input');
                btn.setAttribute('id',''+RandomId);
                btn.setAttribute('type','button')
                btn.setAttribute('disabled','true')

                btn.setAttribute('value','Confirm')
                btn.setAttribute('onclick','SendData(this.id,this)');
                td.appendChild(btn);

            }
            else if(c==10) {//mixed order
                var btn = document.createElement('input');
                btn.setAttribute('id','multi'+RandomId);
                btn.setAttribute('type','button')

                btn.setAttribute('value','Multiple Order')
                btn.setAttribute('disabled','true')
                btn.setAttribute('onclick','Multiple('+RandomId+')');
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

    // function to extract and submit table data.
    function submit() {
        var myTab = document.getElementById('empTable');
        var arrValues = new Array();

        // loop through each row of the table.
        for (row = 1; row < myTab.rows.length - 1; row++) {
        	// loop through each cell in a row.
            for (c = 0; c < myTab.rows[row].cells.length; c++) {  
                var element = myTab.rows.item(row).cells[c];
                if (element.childNodes[0].getAttribute('type') == 'text') {
                    arrValues.push("'" + element.childNodes[0].value + "'");
                }
            }
        }
        
        // The final output.
        document.getElementById('output').innerHTML = arrValues;
        //console.log (arrValues);   // you can see the array values in your browsers console window. Thanks :-) 
    }


</script>
<script>
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
else {console.log("NO XML HTTP REQUEST IN THIS PAGE")       }
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



function subForm(){
    $.ajax({
        url:'./Functions.php',
        type:'get',
        data:$('#myForm').serialize(),
        success:function(){
            alert("Click Again Inside The Phone Number TextBox \n");
        }
    });}



    function Seize(btnid,rid){

    
  
rowId=rid;
RowClientPhone=document.getElementById('ClientPhoneNumber'+rowId).value;
RowProductCode = document.getElementById('ProductCode'+rowId).value;
RowQuantity = document.getElementById('Quantity'+rowId).value;
RowNotes = document.getElementById('Notes'+rowId).value;
RowPrice= document.getElementById('Price'+rowId).value;
// if want to seize
if(document.getElementById(btnid).value == "Seize!"){
    if(RowClientPhone.length <8 || RowProductCode.length <1 || RowQuantity.length<1){
        alert("Please Make Sure That All The Field is Inserted First!");
        return ;
    }
        //insert the row id in the array
        seized.push(rid);
    // reserve the order :

// Snding The Data To a Php File :
var xmlhttp;
if(window.XMLHttpRequest){ 
xmlhttp = new XMLHttpRequest(); 

}
else {console.log("NO XML HTTP REQUEST IN THIS PAGE")       }
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
console.log("On Ready State Change")
}
xmlhttp.open("GET","./Functions.php?ClientPhone="+RowClientPhone+"&ProductCode="+RowProductCode+"&Quantity="+RowQuantity+"&Price="+RowPrice+"&rowid="+rowId,false);
xmlhttp.send();

// disable the remove row button
document.getElementById("Remove"+rowId).disabled=true;
//disable the multiorder
document.getElementById("multi"+rowId).disabled=true;


// disable the product code input and the pgone number
document.getElementById('ProductCode'+rowId).disabled=true;
document.getElementById('ClientPhoneNumber'+rowId).disabled=true;
// disable The Qquantity and notes field

document.getElementById('Quantity'+rowId).disabled=true;
document.getElementById('Notes'+rowId).disabled=true;

    //chande the button value
    document.getElementById(btnid).value = "UnSeize";



}else if(document.getElementById(btnid).value=="UnSeize"){
    // first Remove The Row Id From The Array
    seized.splice( seized.indexOf(rowId) , 1);
    // reEnable the disabled buttons and textboxes
    document.getElementById('Quantity'+rowId).disabled=false;
document.getElementById('Notes'+rowId).disabled=false;
document.getElementById('ProductCode'+rowId).disabled=false;
document.getElementById('ClientPhoneNumber'+rowId).disabled=false;
document.getElementById("Remove"+rowId).disabled=false;
document.getElementById("multi"+rowId).disabled=false;

//reset the button value
document.getElementById(btnid).value = "Seize!";

//delete the data from the database.
var xmlhttp;
if(window.XMLHttpRequest)
xmlhttp = new XMLHttpRequest(); 


xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
console.log("On Ready State Change")
}
xmlhttp.open("GET","./Functions.php?delClientPhone="+RowClientPhone+"&delProductCode="+RowProductCode+"&delrowid="+rowId+"&delquantity="+RowQuantity,false);
xmlhttp.send();

}


} 
</script>

<script language="javascript">
    //to print the array of what reserved 
function showLocalStorage(therowd){
/*   THE OLD FUNCTION
    console.log("got into the function with"+therowd)
    var orderArray= new Array();
    //returning the json String to array
    orderArray= JSON.parse(localStorage.getItem('ordrz'));
    document.getElementById('xx'+therowd).innerHTML  ="<input type='button' value='Show What Reserved.' onclick='showLocalStorage("+therowd+")' > </input>"
    for(i=1 ; i<orderArray.length  ; i++)
        for(j=0; j<2 ; j++)
            if(orderArray[i][0] ==therowd){
              document.getElementById('xx'+therowd).innerHTML += "<br>ProductCode: "+orderArray[i][1] + " Quantity: "+orderArray[i][2];
            //    console.log('productCode: '+orderArray[i][1]+" qty :"+orderArray[i][2])
                                }   

*/


console.log("got into the function with"+therowd)
    var orderArray= new Array();
    //returning the json String to array
    orderArray= JSON.parse(localStorage.getItem(therowd));
    document.getElementById('xx'+therowd).innerHTML  ="<input type='button' value='Show What Reserved.' onclick='showLocalStorage("+therowd+")' > </input>"
    for(i=1 ; i<orderArray.length  ; i++)
            if(orderArray[i][0] ==therowd){
              document.getElementById('xx'+therowd).innerHTML += "<br>ProductCode: "+orderArray[i][1] + " Quantity: "+orderArray[i][2];
            //    console.log('productCode: '+orderArray[i][1]+" qty :"+orderArray[i][2])
                                }   


                                    }
// Make Multiple Order For One Customer

function Multiple(rwid){
  var rowId = rwid;
  document.getElementById(rwid).disabled = true;
  document.getElementById('ProductCode'+rwid).hidden=true;
  document.getElementById('Check'+rwid).hidden=true;
  document.getElementById('Quantity'+rwid).hidden=true;
  document.getElementById('Seize'+rwid).hidden=true;
  document.getElementById('Notes'+rwid).hidden=true;
  document.getElementById('Quantity'+rwid).hidden=true;
  document.getElementById('xx'+rwid).innerHTML="<input type='button' value='Show What Reserved.' onclick='showLocalStorage("+rwid+")' > </input>"
  
  var Client_Phone = document.getElementById("ClientPhoneNumber"+rowId).value

  window.open("./multi.php?client="+Client_Phone+"&row="+rowId,"_blank"); 

  // window.open("./multi.php?client="+Client_Phone,"_blank"); 

}


// get the product info 
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
//Check The Phone Number If Existed In The Database 

function CheckPhoneNumber(x,rid){
  rnd = rid;
    if(document.getElementById(x).value.length<8){
    alert("Are You Sure You Entered The Phone Number Right ! \nPlease Check It Again.")
    document.getElementById(rnd).disabled = true;
            document.getElementById('multi'+rnd).disabled = true;
    }
    else{ 
   var  PhoneNb=document.getElementById(x).value;
    var xmlhttp;
if(window.XMLHttpRequest)
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState ==4 & xmlhttp.status ==200)
        if (xmlhttp.responseText.indexOf('Founded')== -1){
            console.log("Founded!")
            document.getElementById(x).classList.remove("text-danger");
            document.getElementById(x).classList.remove("form-control");
            document.getElementById(x).classList.remove("is-invalid");
                        document.getElementById(rnd).disabled = false;
                        
                        document.getElementById('multi'+rnd).disabled = false;
                        document.getElementById("TheDv"+rnd).innerHTML = xmlhttp.responseText;
                        document.getElementById("TheDv"+rnd).hidden=false;


        }
        else {
            console.log("Not Founded!");
            console.log(xmlhttp.responseText);
            console.log(xmlhttp.responseText.length);
            document.getElementById(x).className += "form-control is-invalid text-danger";
            document.getElementById(rnd).disabled = true;
            document.getElementById('multi'+rnd).disabled = true;

            var dialog = document.querySelector('dialog');
            dialog.showModal();

            dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });

    dialog.addEventListener('click', function (event) {
    var rect = dialog.getBoundingClientRect();
    var isInDialog=(rect.top <= event.clientY && event.clientY <= rect.top + rect.height && rect.left <= event.clientX && event.clientX <= rect.left + rect.width);
    if (!isInDialog) {
        dialog.close();
    }
});

        }
                document.getElementById("PhoneNumberDialog").value=PhoneNb;

}
let d = new Date();
let timestamp = d.getTime();
xmlhttp.open("GET","./Functions.php?phonenb="+PhoneNb+"&rnd="+timestamp,true);
xmlhttp.send();


}
}

</script>
<script language="javascript">
    window['counter'] = 0;

    // Send The Data To The Php Then Database

function SendData(TheId,oButton){
    //check if seized 

    if(seized.indexOf(TheId)== -1){
  cnf=confirm("Are You Sure That You Want To Make This Reservation.!\nMake Sure All The Field Is In The Normal View.\nIf You Click Yes You Cannot Undo")
  
  if(cnf){

  
rowId=TheId;
RowClientPhone=document.getElementById('ClientPhoneNumber'+rowId).value;
RowProductCode = document.getElementById('ProductCode'+rowId).value;
RowQuantity = document.getElementById('Quantity'+rowId).value;
RowNotes = document.getElementById('Notes'+rowId).value;
RowPrice= document.getElementById('Price'+rowId).value;
//JUST A MESSAGE !
(function(){
    'use strict';
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var data = {message: 'Great Job! New Reservation Added #       Reservation Number (in This Session):'+ ++counter};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
  }());

  document.getElementById("TotalReservation").innerHTML=counter;
 

  if(window.XMLHttpRequest){ 
xmlhttp = new XMLHttpRequest(); 
console.log("XML HTTP REQUEST CREATED") 
xmlhttp.onreadystatechange = function(){
if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
AvQuantity = xmlhttp.responseText;
}
xmlhttp.open("GET","./WorkFunctions.php?mlrvcidPhone="+RowClientPhone+"&Notes="+RowNotes+"&Price="
+RowPrice+"&ProductCode="+RowProductCode+"&Qty="+RowQuantity,false);
xmlhttp.send();
 } 
// Snding The Data To a Php File :
// var xmlhttp;
// if(window.XMLHttpRequest){ 
// xmlhttp = new XMLHttpRequest(); 

// }
// else {console.log("NO XML HTTP REQUEST IN THIS PAGE")       }
// xmlhttp.onreadystatechange = function(){
// if (xmlhttp.readyState == 4 & xmlhttp.status ==200)
// console.log("On Ready State Change")
// }
// xmlhttp.open("GET","./Functions.php?ClientPhone="+RowClientPhone+"&ProductCode="+RowProductCode+"&Quantity="+RowQuantity+"&Price="+RowPrice+"&Notes="+RowNotes,false);
// xmlhttp.send();


var empTab = document.getElementById('empTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex);

}
  
    }else {
        //delete the row From table
        var empTab = document.getElementById('empTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex);
    }
}
</script>




		</div>
      </main>
    </div>
  </body>
</html>     