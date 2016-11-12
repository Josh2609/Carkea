<?php

$dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db = mysql_connect("silva.computing.dundee.ac.uk", "16ac3u07", "bac132");
// SELECT DATABASE - use your own database name
mysql_select_db("16ac3d07");

$image = mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
$image_name = mysql_real_escape_string($_FILES['image']['name']);
$id = "NULL";

$query = "INSERT INTO testblob (image_id, image, image_name ) VALUES (NULL, '$image', '$image_name')";
// Execute query
mysql_query($query,$db);


    
    $stmt = $dbConnection->prepare("SELECT image FROM testblob WHERE image_id =?");
    //$stmt->execute();
    
     //$stmt = $dbConnection->prepare("SELECT image FROM image where imageid = ?");
    if ($stmt->execute(array(27))) {
        $row=$stmt->fetch();
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"">'; //this prints the image data, transforming the image.php to an image
        }
        

// ** WORKING ON BELOW **
//if($_FILES['image']['name'])
//{
//  $save_path = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
//  echo "<p> savepath = '$save_path'</p>";
//  $save_path = "/Applications/XAMPP/xamppfiles/htdocs/Carkea/car_images/";
//  //$save_path="../"; // Folder where you wanna move the file.
//  $myname = strtolower($_FILES['image']['tmp_name']); //You are renaming the file here
//  $myname = "1";
//  echo "<p> myname = '$myname'</p>";
//  $ayy = $_FILES['image']['tmp_name'];
//  echo "<p> loc = ' $ayy'</p>";
//  echo "<p> loc =  $save_path$myname</p>";
//  $root = getcwd();
//  echo "<p> root =  $root</p>";
//  move_uploaded_file($_FILES['image']['tmp_name'], $save_path.$myname); // Move the uploaded file to the desired folder
//}

// ** WORKING ON ABOVE

//$inser_into_db="INSERT INTO `database`.`table` (`folder_name`, `file_name`) VALUES('$save_path', '$myname'))";



//  if ($_FILES["file"]["error"] > 0)
//    {
//        echo "Error: " . $_FILES["file"]["error"] . "<br>";
//    } else {
//        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
//        echo "Type: " . $_FILES["file"]["type"] . "<br>";
//        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//        echo "Stored in: " . $_FILES["file"]["tmp_name"];
//    }
    
//    $imgData = file_get_contents($_FILES['file']['tmp_name']);
//    $size = getimagesize($_FILES['file']['tmp_name']);
//
//    mysql_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132");
//    mysql_select_db ("16ac3d07");
//          
//    $sql = sprintf("INSERT INTO testblob
//    (image_type, image, image_size, image_name)
//    VALUES
//    ('%s', '%s', '%d', '%s')",
//    /***
//     * For all mysqli_ functions below, the syntax is:
//     * mysqli_whartever($link, $functionContents); 
//     ***/
//    mysql_real_escape_string($size['mime']),
//    mysql_real_escape_string($imgData),
//    $size[3],
//    mysql_real_escape_string($_FILES['file']['tmp_name'])
//    );
    
//    $final_save_dir = '../car_images/';
//    move_uploaded_file($_FILES['file']['tmp_name'], $final_save_dir . $_FILES['file']['name']);
//    
//    $image_full_path = $final_save_dir . $_FILES['file']['name'];

    
//    $image_dir= '../../car_images/';
//    
//    move_uploaded_file($_FILES['file']['tmp_name'], $image_dir. $_FILES['file']['name']);
//    $image = $final_save_dir . $_FILES['file']['name'];
    
    //echo "<p>'$image'</p>";

//    ob_start();
//    $mimeExt = array();
//    $mimeExt['image/jpeg'] ='.jpg';
//    $mimeExt['image/pjpeg'] ='.jpg';
//    $mimeExt['image/bmp'] ='.bmp';
//    $mimeExt['image/gif'] ='.gif';
//    $mimeExt['image/x-icon'] ='.ico';
//    $mimeExt['image/png'] ='.png';
//    
//    $carImgDirectory;
//    
//    if(isset($_FILES["carImage"])) { 
//        //Begins image upload
//        $user_avatar = md5(uniqid(time())).$mimeExt[$_FILES["carImage"]["type"]]; //Get image extension
//        $user_avatar_dir = "../img/".$user_avatar; //Path file
//        move_uploaded_file($_FILES["carImage"]["tmp_name"], $carImgDirectory); 
//
//    } else {
//       $user_avatar = "default_130x130.png";
//    }