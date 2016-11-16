<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>
            $(document).ready(function(e) {  
            Chevrolet = ['Silverado','Suburban','Tahoe'];
Ford = ['F150','Taurus','Pinto','Bronco'];
Toyota = ['Camry','Tacoma','4Runner'];
GMC = ['blah1','blah2','blah3'];

$('#make').change(function() {
    $('#models').prop('disabled', true);
    $("#models").html(""); //clear existing options
    var newOptions = window[this.value]; //finds the array w/the name of the selected value
    //populate the new options
    for (var i=0; i<newOptions.length; i++) {
        $("#models").append("<option>"+newOptions[i]+"</option>");
    }
    $('#models').prop('disabled', false); //enable the dropdown
});
 });
</script>
        <title></title>
    </head>
    <body>
         <form>  
    <select id="make">
        <option>Make</option>
        <option>Chevrolet</option>
        <option>Ford</option>
    	<option>GMC</option>
    	<option>Toyota</option> 
     </select>
    <select id="models" class="models" disabled>
        <option>Model</option>
        <option>Silverado</option>
        <option>Suburban</option>
    	<option>Tahoe</option>
     </select>
</form>
    </body>
</html>
