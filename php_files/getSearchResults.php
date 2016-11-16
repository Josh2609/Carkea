<?php

    include "db_connect.php";
    
    $con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
          mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE
          
    session_start();
    
    $resultsPerPage;
    
    $make = $_POST["makeSelect"];
    $model = $_POST["modelSelect"];
    $colour = $_POST["colourSelect"];
    
    if ($make=="anyMake")
            $make="%";
    if ($model=="anyModel")
            $model="%";
    if ($colour=="anyColour")
            $colour="%";
    
    $stmt = $dbConnection->prepare('SELECT * FROM carSearchView WHERE Make LIKE :make AND Model LIKE :model AND Colour LIKE :colour');
    
    $stmt->bindParam(':make', $make);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':colour', $colour);
    $stmt->execute();
    
    foreach ($stmt as $row)
    {
        echo "<p>{$row['Make']}</p>";
        echo "<p>{$row['Model']}</p>";
        echo "<p>{$row['Colour']}</p>";
        echo "<p>{$row['Registration']}</p>";
    }
    
    echo "<p>$make, $model, $colour</p>";
