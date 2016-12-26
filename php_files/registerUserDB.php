<?php
session_start();
if(isset($_POST['username']) && $_POST['password'])
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPass = $_POST['repeatPass'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    
    $telephone = str_replace(' ', '', $telephone);

    if ($password !== $repeatPass)
    {
        header("Location: ../register.php?message=passwordmatch");
        exit();
    }
    
    
    include "dbconnect/pdoconnect.php";
   
    
    $stmt = $dbConnection->prepare("INSERT INTO CustomerDetailsView(Customer_ID, First_Name, Last_Name, Telephone, Email) "
            . "VALUES(NULL, :firstName, :surname, :telephone, :email)");
    $stmt->bindParam(':firstName', $firstname);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $customerID = $dbConnection->lastInsertId();
    
    $stmt = $dbConnection->prepare("INSERT INTO CustomerLoginView(Login_Username, Login_Password_Hash, Customer_ID) "
            . "VALUES(:username, :passwordHash, :custID)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':passwordHash', $passwordHash);
    $stmt->bindParam(':custID', $customerID);
    
     try
    {
        if ($stmt->execute())
        {
            header("Location: ../register.php?message=success");
        } else {
            $stmt = $dbConnection->prepare('DELETE FROM Customer WHERE Customer_ID=:custID');
            $stmt->bindParam(':custID', $customerID);

            $stmt->execute();

            header("Location: ../register.php?message=error");
            exit();
        }
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) 
        {
            $stmt = $dbConnection->prepare('DELETE FROM Customer WHERE Customer_ID=:custID');
            $stmt->bindParam(':custID', $customerID);

            $stmt->execute();

            header("Location: ../register.php?message=duplicate");
        } else {
            $stmt = $dbConnection->prepare('DELETE FROM Customer WHERE Customer_ID=:custID');
            $stmt->bindParam(':custID', $customerID);

            $stmt->execute();
            header("Location: ../register.php?message=error");
            exit();
        }
    }   
}