<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'slsuDb';

    $conn = mysqli_connect($server, $username, $password, $database);

    if(!$conn){
        echo "Unable to Connecte to the Database";
    }
?>