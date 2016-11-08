<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
    include "db_connect.php";
    $q = intval($_GET['q']);
    
    $stmt = $dbConnection->prepare('SELECT * FROM modelView');
    $stmt->execute();
    
    echo '
    <select id="modelSelect" name="modelSelect">
    <option value="anyModel">Model (Any)</option>';
                       
    foreach ($stmt as $row)
    { 
        $model = $row['Model'];
        echo '<option value="'.$model.'">'.$model.'</option>';
    }
    echo '</select>';
    ?>
</body>
</html>
    
    