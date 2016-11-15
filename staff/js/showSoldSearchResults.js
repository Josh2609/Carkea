/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function showSoldSearchResults(make, model, colour, fuel, carType, transType, numDoors, mileLow, mileHigh,priceLow, priceHigh, registration) {
  if (make=="") {
    document.getElementById("searchResults").innerHTML="";
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
      document.getElementById("searchResults").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","include/getSoldCars.php?make="+make+"&model="+model+"&colour="+colour+"&fuel="+fuel+"&cartype="+carType+"&transtype="+transType+"&numdoors="+numDoors+"&milelow="+mileLow+"&milehigh="+mileHigh+"&pricelow="+priceLow+"&pricehigh="+priceHigh+"&registration="+registration,true);                      
  xmlhttp.send();
}

