<?php
// Start the session
session_start();
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
        <link rel="stylesheet" type="text/css" href="Style.css" />
        <title>Login</title>
    </head>
    <body>
        
        <div class="nav">
            <ul>
                <li style="float:left; color:#999999"><a href="index.php">Carkea</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Search</a></li>
		<li><a href="#">Contact Us</a></li>
                <li><a href="branchlist.php">Branch List</a></li>
                <li><a class = "active" href="#">Login</a></li>
            </ul>
        </div> <!-- nav close -->
        
        <div class="mainbody">
            <div class="regpage">
            <h2>Enter your Username and password</h2>
            <h3>Login</h3>
            
            <form method="POST"  action="isloggedin.php">
                <ul style='list-style:none;'>
                    <li>User Name &nbsp;&nbsp;<input type="text" name="username"></li>
                    <br>
                    <li>Password  &nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password"></li>
                </ul>
                <br/> 
                <input type="submit" value="Login"> 
            </form>       
            </div> <!-- close regpage -->
        </div> <!-- close mainbody -->
    </body>
</html>
