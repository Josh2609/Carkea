<?php
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
                <li><a class = "active" href="#">Register</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </div> <!-- nav close -->
        
        <div class="mainbody">
            <div class="regpage">
            <h2>Register</h2>
            <h3>Please enter your details below</h3>
            
            <style type="text/css">
                .regpage {
                    width: 300px;
                    clear: both;
                    text-align: left;
                    display: inline-block;
                }
                .regpage input {
                    width: 100%;
                    clear: both;
                    
                }
            </style>
            <form method="POST"  action="php_files/registeruser.php">
                <ul style='list-style:none;'>
                        <li>First Name<input type ="text" name ="firstname"></li>
                        <li><br></li>
                        <li>Surname<input type="text" name ="surname"></li>
                        <li><br></li>
                        <li>Street Number <input type ="text" name ="streetnumber"></li>
                        <li><br></li>
                        <li>Street<input type="text" name="street"></li>
                        <li><br></li>
                        <li>Postcode<input type ="text" name ="postcode"></li>
                        <li><br></li>
                        <li>City<input type ="text" name ="city"></li>
                        <li><br></li>
                        <li>County<input type="text" name="county"></li>
                        <li><br></li>
                        <li>Telephone<input type ="text" name="telephone"></li>
                        <li><br></li>
                        <li>Email<input type ="text" name="email"></li>
                        <li><br></li>
                    <li>User Name<input type="text" name="username"></li>
                    <li><br></li>
                    <li>Password<input type="password" name="password"></li>
                    <li><br></li>
                    
                    </ul>
                <br/> 
                <input type="submit" value="Register"> 
            </form>
            </div> <!-- close regpage -->
        </div> <!-- close mainbody -->
    </body>
</html>