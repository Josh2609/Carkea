/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function showSearchResults(make, model, colour, fuel, carType, transType, numDoors, condition, mileLow, mileHigh, postcode, distance) {
  if (make=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","newgetSearchResults.php?make="+make+"&model="+model+"&colour="+colour+"&fuel="+fuel+"&cartype="+carType+"&transtype="+transType+"&numdoors="+numDoors+"&condition="+condition+"&milelow="+mileLow+"&milehigh="+mileHigh+"&postcode="+postcode+"&distance="+distance,true);                      
  xmlhttp.send();
}


