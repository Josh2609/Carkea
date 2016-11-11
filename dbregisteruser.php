 <?php
 session_start();
 if(isset($_POST['username']) && $_POST['password'])
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $street_number = $_POST['streetnumber'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $postcode = $_POST['postcode'];
    
    
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');
    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    $insertUserSQL = "INSERT INTO CustomerLoginDetails(Login_Username,Login_Password_Hash) VALUES('$username','$passwordHash')"
            . "INSERT INTO CustomerAddress(Street_Number, Street, City, County, Postcode) VALUES('$street_number', '$street', '$city', '$county', '$postcode')"
            . "INSERT INTO Customer(First_Name, Last_Name, Telephone, Email) VALUES('$firstname', '$surname', '$telephone', '$email')";
    echo $insertUserSQL;
    
    mysql_query($insertUserSQL);
}
?>

