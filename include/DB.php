<?php 
    // Local DB
    $Connection = new mysqli('localhost', 'root', '');
    $ConnectingDB = $Connection -> select_db('TechVents'); 

    // Hosted DB
    //$Connection = new mysqli('sql12.freemysqlhosting.net', 'sql12381795', 'CqQNmfwF5M');
    // $ConnectingDB = $Connection -> select_db('sql12381795');

    //AWS Hosting
    //3S33djdfNv
    // $Connection = new mysqli('techvents.cgath9fvd91j.us-east-2.rds.amazonaws.com', 'admin', '3S33djdfNv');
    // $ConnectingDB = $Connection -> select_db('techvents');
?>