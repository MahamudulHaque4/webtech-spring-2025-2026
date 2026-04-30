<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "store_ms_db";

    // create connection
    $connection = new mysqli ($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }
      
?>