<?php
// Start the session
session_start(); 
if (isset($_SESSION['loggedIn']) || isset($_SESSION['staff']) || isset($_SESSION['accessLevel'])) 
{
    if($_SESSION['loggedIn'] !== "true" || $_SESSION['staff'] !== "true" || $_SESSION['accessLevel'] != "4")
    {
        header("Location: ../index.php");
    } 
} else {
    header("Location: ../index.php");
}

    $companyName = $_POST["compName"];
    $companyEmail = $_POST["compEmail"];
    $companyTelephone = $_POST["compTelephone"];
    $companyTelephone = str_replace(' ', '', $companyTelephone);

    include "../../php_files/dbconnect/pdoconnect.php";
    
        $stmt = $dbConnection->prepare('INSERT INTO financeCompanyView'
            . '(Finance_Company_ID, Company_Name, Email, Telephone)'
                . ' VALUES (NULL, :name, :email, :telephone)');
    
        $stmt->bindParam(':name', $companyEmail);
        $stmt->bindParam(':email', $companyName);
        $stmt->bindParam(':telephone', $companyTelephone);
       
        
        if ($stmt->execute()) 
        {
            header("Location: ../addfinancecompany.php?message=success");
        } else {
            header("Location: ../addfinancecompany.php?message=error");
            exit();
        }