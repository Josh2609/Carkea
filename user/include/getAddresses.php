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

    $noAddress; //true if no addresses added, false otherwise
    
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
    $stmt = $dbConnection->prepare('SELECT * FROM customerAddressView WHERE Customer_ID = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    //$row = $stmt->fetch();

    if (!$stmt->rowCount() > 0) {
        echo "<p>You currently have no addresses on record.</p>";
        echo '<button type="button" onclick="showAddressForm()">Add New Address</button> ';
    } else {
        echo "<br><br>";
        echo "<table>
                <tr>
                <th>Street Number</th>
                <th>Street</th>
                <th>City</th>
                <th>County</th>
                <th>Postcode</th>
                <th>Delete?</th>
            </tr>";
        foreach ($stmt as $row)
        {
            echo "<tr>";
            echo "<td>{$row['Street_Number']}</td>";
            echo "<td>{$row['Street']}</td>";
            echo "<td>{$row['City']}</td>";
            echo "<td>{$row['County']}</td>";
            echo "<td>{$row['Postcode']}</td>";
            echo '<td><button type="button" onclick="deleteAddress('.$row["Address_ID"].')">Delete Address</button></td>';
            echo "</tr>";
        }
        echo "</table>";
        echo "<br>";
        echo '<button class="profButton" type="button" onclick="showAddressForm()">Add New Address</button> ';
    }
    
    ?>
</body>
</html>