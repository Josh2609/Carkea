//setup arrays
//Chevrolet = ['Silverado','Suburban','Tahoe'];
//Ford = ['F150','Taurus','Pinto','Bronco'];
//Toyota = ['Camry','Tacoma','4Runner'];
//GMC = ['blah1','blah2','blah3'];
//
//$('#make').change(function() {
//    $('#models').prop('disabled', true);
//    $("#models").html(""); //clear existing options
//    var newOptions = window[this.value]; //finds the array w/the name of the selected value
//    //populate the new options
//    for (var i=0; i<newOptions.length; i++) {
//        $("#models").append("<option>"+newOptions[i]+"</option>");
//    }
//    $('#models').prop('disabled', false); //enable the dropdown
//});
//
//$(document).ready(function(e) {  
//
//$("#modelSelect").prop('disabled', 'disabled');
//$("#makeSelect").on('change', function() {
//    var that = $("#makeSelect option:selected").val();
//    if (that !== "anyMake") {
//        $("#modelSelect").prop('disabled', false);
//    } else { 
//         $("#modelSelect").prop('disabled', 'disabled');        
//    } 
//});
//});

function showModels(str)
{
    if (str == "anyMake") {
        $("#modelSelect").prop('disabled', 'disabled');
        //document.getElementById("modelDropdown").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $('#modelSelect').prop('disabled', false);
                document.getElementById("modelDropdown").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../php_files/getModels.php?q="+str,true);
        xmlhttp.send();
    }
    
}
//function enableSelect()
//{
//    if (document.getElementById("makeSelect").value === "anyMake") {
//        document.getElementById("modelSelect").disable=true;
//    } else {
//        document.getElementById("modelSelect").disable=false;
//    }
//}