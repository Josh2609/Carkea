<?php

    session_start();
    $id = intval($_SESSION['employeeID']);
    
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $password = $_POST["currPassword"];

    
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
    $stmt = $dbConnection->prepare('SELECT * FROM customerView WHERE Customer_ID = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    foreach ($stmt as $row)
    {
        $dbHash = $row['Login_Password_Hash'];
    }
    
    if (password_verify($password,$dbHash))
    {
        $stmt = $dbConnection->prepare('UPDATE customerView SET First_Name=:firstName, Last_Name=:lastName,'
                . ' Telephone=:telephone, Email=:email WHERE Customer_ID = :id');
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute())
        {
            header("Location: ../editProfile.php?message=success");
        } else {  
            header("Location: ../editProfile.php?message=error");
        }
    } else {
        header("Location: ../editProfile.php?message=passwordnotmatch");
    }