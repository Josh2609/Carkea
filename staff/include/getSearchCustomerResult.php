<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
    session_start();
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    if ($username=="")
        $username="%";
    if ($firstName=="")
        $firstName="%";
    if ($lastName=="")
        $lastName="%";
    if ($email=="")
        $email="%";
    if ($telephone=="")
        $telephone="%";

    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $query = 'SELECT * FROM customerView WHERE First_Name LIKE ?'
            . ' AND Last_Name LIKE ? AND Telephone LIKE ? AND email LIKE ? '
            . 'AND Login_Username LIKE ?';
    
    $params = array("%$firstName%", "%$lastName%", "%$telephone%", "%$email%", "%$username%");
    
//    $stmt->bindParam(':firstName', $firstName);
//    $stmt->bindParam(':lastName', $lastName);
//    $stmt->bindParam(':telephone', $telephone);
//    $stmt->bindParam(':email', $email);
//    $stmt->bindParam(':username', $username);
//    $stmt->execute();
    $stmt = $dbConnection->prepare($query);
    $stmt->execute($params);
    
    
echo "<table>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Telephone</th>
<th>Username</th>
</tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row["First_Name"] . '</a></td>';
    echo "<td>" . $row['Last_Name'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['Telephone'] . "</td>";
    echo "<td>" . $row['Login_Username'] . "</td>";
    echo "</tr>";
}
echo "</table>";

?>
</body>
</html>