/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function showAddressForm()
{
  document.getElementById("addressDiv").style.display = "block";
}

function deleteAddress(addressID)
{
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
        location.reload();
    }
  }
  xmlhttp.open("GET","include/deleteAddress.php?id="+addressID,true);
  xmlhttp.send();
}
