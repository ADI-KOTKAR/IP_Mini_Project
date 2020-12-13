<?php 
    // Local DB
    $Connection = new mysqli('host_name', 'db_username', 'db_user_password');
    $ConnectingDB = $Connection -> select_db('db_name'); 
?>