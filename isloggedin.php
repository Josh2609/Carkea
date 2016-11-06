<?php
// use PDO to prevent SQLi
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    echo $username;
    $db = mysql_connect("silva.computing.dundee.ac.uk", "joshuacorps","AC32006"); // CONNECT TO DATABASE
            mysql_select_db("joshuacorpsdb"); // SELECT DATABASE
            
    $dbConnection = new PDO('mysql:dbname=joshuacorpsdb;host=silva.computing.dundee.ac.uk;charset=utf8', 'joshuacorps', 'AC32006');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
    // used bcrypt cos it's a fixed size (60) and seems secure enough. Default could change in the future so it's easier this way
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    echo "<p>$passwordHash</p>";
    
    $stmt = $dbConnection->prepare('SELECT * FROM employeelogindetails WHERE Login_Username=:username');
    
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    //$loginQuery = mysql_query("SELECT * FROM employeelogindetails WHERE Login_Username=$username;" ,$db);

    foreach ($stmt as $row)
    {
        $dbHash = $row['Login_Password_Hash'];
    }
            
    if (password_verify($password,$dbHash))
    {
        echo "<h1>Match</h1>";
        $_SESSION["loggedIn"] = "true";
        $_SESSION["username"] = $username;
        echo "<p>{$_SESSION['username']}</p>";
        header("Location: index.php"); // redirects back to home page if logged in
        exit();
    } else {
        echo "<h1>Not Match</h1>";
    }
?>

