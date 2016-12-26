<?php

    $soldPrice = $_POST["soldPrice"];
    $soldCustID = $_POST["soldCustID"];
    $vin = $_POST["vin"];
    $branchID = $_POST["branchID"];
    $carStockID = $_POST["carStockID"];
    if ($_POST["paymentMethod"] != '')
    {
        $yesFinance = 'true';
        $paymentMethod = $_POST["paymentMethod"];
        $financeAmount = $_POST["financeAmount"];
        $monthlyPayments = $_POST["monthlyPayments"];
        $fCompanyID = $_POST["fCompanySelect"];
    }

    include "dbconnect/pdoconnect.php";

    
    $stmt = $dbConnection->prepare('INSERT INTO soldCarView '
             . '(Sold_Car_ID, Sold_Price, Sold_Date, Vehicle_Identification_Number, Customer_ID, Branch_ID)'
             . 'VALUES (NULL, :soldPrice, CURDATE(), :vin, :custID, :branchID)');
     
    $stmt->bindParam(':soldPrice', $soldPrice);
    $stmt->bindParam(':vin', $vin);
    $stmt->bindParam(':custID', $soldCustID);
    $stmt->bindParam(':branchID', $branchID);
    
    $lastID = $dbConnection->lastInsertId();
    
    if ($stmt->execute())
    {
        if ($yesFinance == 'true')
        {
            $stmt = $dbConnection->prepare('INSERT INTO financePlanView '
                    . '(Finance_ID, Payment_Method, Monthly_Repayment_Amount, Total_Finance_Amount, Outstanding_Payment_Remaining, Finance_Company_ID, Sold_Car_ID)'
                    . 'VALUES(NULL, :paymentMethod, :monthlyPayments, :financeAmount, :outstandingPayment, :companyID, :soldCarID)');
            $stmt->bindParam(':paymentMethod', $paymentMethod);
            $stmt->bindParam(':monthlyPayments', $monthlyPayments);
            $stmt->bindParam(':financeAmount', $financeAmount);
            $stmt->bindParam(':outstandingPayment', $financeAmount);
            $stmt->bindParam(':companyID', $fCompanyID);
            $stmt->bindParam(':soldCarID', $lastID);

            $stmt->execute();
        }
        
        $stmt = $dbConnection->prepare('DELETE FROM carstock WHERE Car_Stock_ID=:carStockID');
        $stmt->bindParam(':carStockID', $carStockID);
        
        if ($stmt->execute())
        {
             header("Location: ../search.php");
        }
    }