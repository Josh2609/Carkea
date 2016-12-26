<?php
// use PDO to prevent SQLi
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];
    $staff = $_POST["staff"];
            
    include "dbconnect/pdoconnect.php";
            
    // used bcrypt cos it's a fixed size (60) and seems secure enough. Default could change in the future so it's easier this way
    $passwordHash = password_hash($password, PASSWORD_BCRYPT); // **unused?**
    
    if ($staff)
    {
        $stmt = $dbConnection->prepare('SELECT * FROM employeeLoginView WHERE Login_Username=:username');
       
    } else {
        $stmt = $dbConnection->prepare('SELECT * FROM customerLoginView WHERE Login_Username=:username');
    }
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    

    foreach ($stmt as $row)
    {
        $dbHash = $row['Login_Password_Hash'];
        if ($staff)
        {
            $employeeID = $row['Employee_ID'];
            $stmt = $dbConnection->prepare('SELECT Branch_ID FROM employeeView WHERE Employee_ID=:empID');
            $stmt->bindParam(':empID', $employeeID);
            $stmt->execute();
            foreach ($stmt as $i)
            {
                $empBranch = $i['Branch_ID'];
            }
            
            $accessLevel = $row['Data_Access_Permissions'];
        } else {
            $customerID = $row['Customer_ID'];
        }
    }
            
    if (password_verify($password,$dbHash))
    {
        echo "<h1>Match</h1>";
        if ($staff)
        {
            $_SESSION["empBranch"] = $empBranch;
            $_SESSION["staff"] = 'true';
            $_SESSION["accessLevel"] = $accessLevel;
            $_SESSION["employeeID"] = $employeeID;
        } else {
            $_SESSION["customerID"] = $customerID;
            $_SESSION["staff"] = 'false';
        }
        $_SESSION["loggedIn"] = "true";
        $_SESSION["username"] = $username;
        $_SESSION["incorrectLogin"] = "false";
        header("Location: ../index.php"); // redirects back to home page if logged in
        exit();
    } else {
        $_SESSION["incorrectLogin"] = "true";
        header("Location: ../login.php");
        exit();
    }

