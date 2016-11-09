<?php
//SELECT DISTINCT Date FROM buy ORDER BY Date
function getCarMakes()
{
    $stmt = $dbConnection->prepare('SELECT DISTINCT Make FROM Car ORDER BY Make DESC');
    $stmt->execute();

    return $stmt;
}