function addToWishlist(stockID, custID) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("wishlistResult").innerHTML=this.responseText;
    }
  }
  document.getElementById("wishList").textContent = "Already in Wishlist"; 
  document.getElementById("wishList").disabled = true; 
  xmlhttp.open("GET","user/include/addToWishlist.php?custID="+custID+"&stockID="+stockID,true);                      
  xmlhttp.send();
}