<?php
// Start the session
session_start(); 
if (isset($_SESSION['loggedIn']) || isset($_SESSION['staff']) || isset($_SESSION['accessLevel'])) 
{
    if($_SESSION['loggedIn'] !== "true" || $_SESSION['staff'] !== "true" || $_SESSION['accessLevel'] != "3")
    {
        header("Location: ../index.php");
    } 
} else {
    header("Location: ../index.php");
}

    $roleID = $_POST["roleSelect"];
    $branchID = $_POST["branchSelect"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $salary = $_POST["salary"];
    $manager = $_POST["manager"];
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    
    if ($password !== $repeatPassword)
    {
        header("Location: ../addemployee.php?message=passwordmatch");
        exit();
    }
    
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($manager == "")
    {
        $stmt = $dbConnection->prepare('INSERT INTO employee (Employee_ID, First_Name, Last_Name, Salary, Role_ID, Branch_ID)'
                . ' VALUES (NULL, :firstName, :lastName, :salary, :roleID, :branchID)');

        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':roleID', $roleID);
        $stmt->bindParam(':branchID', $branchID);
    } else {
        $stmt = $dbConnection->prepare('INSERT INTO employee (Employee_ID, First_Name, Last_Name, Salary, Role_ID, Branch_ID, Line_Manager_ID)'
                . ' VALUES (NULL, :firstName, :lastName, :salary, :roleID, :branchID, :manager)');

        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':roleID', $roleID);
        $stmt->bindParam(':branchID', $branchID);
        $stmt->bindParam(':manager', $manager);
    }
    
    $stmt->execute();
    
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    $employeeID = $dbConnection->lastInsertId();
    
    echo "<p><?=$employeeID?> </p>";
    
    $stmt = $dbConnection->prepare('INSERT INTO EmployeeLoginDetails (Login_Username, Login_Password_Hash, Data_Access_Permissions, Employee_ID)'
            . ' VALUES (:username, :passwordHash, :roleID, :employeeID)');
    
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':passwordHash', $passwordHash);
    $stmt->bindParam(':roleID', $roleID);
    $stmt->bindParam(':employeeID', $employeeID);
    
//    try {
//        $stmt->execute();
//    } catch (PDOException $e) {
//        if ($e->errorInfo[1] == 1062) {
//        header("Location: ../addstock.php?message=duplicate");
//        } else {
//            header("Location: ../addstock.php?message=error");
//            exit();
//        }
//    }   
    try
    {
        if ($stmt->execute())
        {
            header("Location: ../addemployee.php?message=Success");
        } else {
            $stmt = $dbConnection->prepare('DELETE FROM employee WHERE Employee_ID=:empID');
            $stmt->bindParam(':empID', $employeeID);

            $stmt->execute();

            header("Location: ../addemployee.php?message=error");
            exit();
        }
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) 
        {
            $stmt = $dbConnection->prepare('DELETE FROM employee WHERE Employee_ID=:empID');
            $stmt->bindParam(':empID', $employeeID);

            $stmt->execute();
            header("Location: ../addemployee.php?message=duplicate");
        } else {
            header("Location: ../addemployee.php?message=error");
            exit();
        }
    }   
    
    

