<?php

    $db = mysql_connect("silva.computing.dundee.ac.uk", "joshuacorps","AC32006"); // CONNECT TO DATABASE
          mysql_select_db("joshuacorpsdb"); // SELECT DATABASE
            
    $dbConnection = new PDO('mysql:dbname=joshuacorpsdb;host=silva.computing.dundee.ac.uk;charset=utf8', 'joshuacorps', 'AC32006');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
