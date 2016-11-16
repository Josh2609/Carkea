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

    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
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