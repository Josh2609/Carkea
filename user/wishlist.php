<?php
// Start the session
session_start(); // get on the sesh
$customerID = $_SESSION['customerID'];
if (isset($_SESSION['loggedIn'])) 
{
    if($_SESSION['loggedIn'] !== "true" )
    {
        header("Location: index.php");
    } 
} else {
    header("Location: ../index.php");
}
$id = $_GET['id'];
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include "include/getWishlist.php";
        ?>
    </body>
</html>
