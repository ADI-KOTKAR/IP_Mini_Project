<?php 
    $Connection = new mysqli('localhost', 'root', '');
    $ConnectingDB = $Connection -> select_db('TechVents'); 

    // $Connection = new mysqli('sql12.freemysqlhosting.net', 'sql12381695', 'R2QRsfk1zG');
    // $ConnectingDB = $Connection -> select_db('sql12381695');
?>