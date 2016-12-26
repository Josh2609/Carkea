<?php

    session_start();
    $id = intval($_SESSION['customerID']);
    
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $password = $_POST["currPassword"];
    
    $telephone = str_replace(' ', '', $telephone);

    
    include "../../php_files/dbconnect/pdoconnect.php";
            
    $stmt = $dbConnection->prepare('SELECT Login_Password_Hash FROM customerView WHERE Customer_ID = :id');
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
            header("Location: ../editProfile.php?id=$id&message=success");
        } else {  
            header("Location: ../editProfile.php?id=$id&message=error");
        }
    } else {
        header("Location: ../editProfile.php?id=$id&message=passwordnotmatch");
    }