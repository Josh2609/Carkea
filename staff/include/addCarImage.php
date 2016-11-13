<?php
$db = mysql_connect("silva.computing.dundee.ac.uk", "16ac3u07", "bac132");
// SELECT DATABASE - use your own database name
mysql_select_db("16ac3d07");

$image = mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
$image_name = mysql_real_escape_string($_FILES['image']['name']);

$query = "INSERT INTO testblob (image_id, image, image_name ) VALUES (NULL, '$image', '$image_name')";
mysql_query($query,$db);


// ** CODE TO SHOW IMAGE, USE ON STOCK PAGE **EDIT**    
//    $stmt = $dbConnection->prepare("SELECT image FROM testblob WHERE image_id =?");
//
//    if ($stmt->execute(array(27))) 
//    {
//        $row=$stmt->fetch();
//        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"">'; //this prints the image data, transforming the image.php to an image
//    }
        