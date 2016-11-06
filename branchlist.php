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
        <title>Branch List</title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li style="float:left; color:#999999"><a href="index.php">Carkea</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Search</a></li>
		<li><a href="#">Contact Us</a></li>
                <li><a class = "active" href="branchlist.php">Branch List</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div> <!-- nav close -->
        <div class="mainbody">
        <?php
            // change to Team7 and CarkeaDB for release
            $db = mysql_connect("silva.computing.dundee.ac.uk", "joshuacorps","AC32006"); // CONNECT TO DATABASE
            mysql_select_db("joshuacorpsdb"); // SELECT DATABASE
            
            if(!$db)
                echo mysql_error() ;
            else
                echo "Successfully connected. <br>";
            
            $queryBranchView = "SELECT * FROM branchView;";
            $branchQueryResult = mysql_query($queryBranchView,$db);

            // Displays branch list, needs cleaning up with css/html
            while ($row = mysql_fetch_array($branchQueryResult))
            {
                echo $row['Branch_Name']." ".$row['Telephone']." ".$row['Street_Number']
                        ." ".$row['Street']." ".$row['City']." ".$row['County']." ".$row['Postcode'];
                echo "<br>";
            }

            mysql_close($db); // CLOSE CONNECTION
        ?>
        </div> <!-- close mainbody -->
        
    </body>
</html>
