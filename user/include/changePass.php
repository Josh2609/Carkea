<?php
    session_start();
    $id = intval($_SESSION['customerID']);

    $currPassword = $_POST["currPassword"];
    $newPass = $_POST["newPassword"];
    $repeatNewPass = $_POST["repeatNewPass"];
    
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
    $stmt = $dbConnection->prepare('SELECT Login_Password_Hash FROM customerView WHERE Customer_ID = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    
    foreach ($stmt as $row)
    {
        $dbHash = $row['Login_Password_Hash'];
    }
    
    if (password_verify($currPassword,$dbHash))
    {
        $newPassHash = password_hash($newPass, PASSWORD_BCRYPT);
        if ($newPass !== $repeatNewPass)
        {
             header("Location: ../editProfile.php?message2=newpassnotmatch");
        } else {
            $stmt = $dbConnection->prepare('UPDATE customerView SET Login_Password_Hash=:newPassHash WHERE Customer_ID=:custID');
            $stmt->bindParam(':newPassHash', $newPassHash);
            $stmt->bindParam(':custID', $id);
            
            if ($stmt->execute())
            {
                header("Location: ../editProfile.php?message2=success");
            } else {  
                header("Location: ../editProfile.php?message2=error");
            }
        }
    } else {
        header("Location: ../editProfile.php?message2=passwordnotmatch");
    }

