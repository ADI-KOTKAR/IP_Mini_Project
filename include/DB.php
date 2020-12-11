<?php 
    // Local Database
    // $Connection = new mysqli('localhost', 'root', '');
    // $ConnectingDB = $Connection -> select_db('TechVents');

    //Deployed Database
    $Connection = new mysqli('remotemysql.com', '8Q4BVzL1B5', '9bs2ZDV0Xe');
    $ConnectingDB = $Connection -> select_db('8Q4BVzL1B5');
    
?>