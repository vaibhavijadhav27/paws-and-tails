<?php

// connection
define('DB_SERVER', 'localhost:3307');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', "paws");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die("Could not connect to database due to " . mysqli_connect_error());
}

    // creating DB

    // $sql1 = "CREATE DATABASE myDB ";
    // $result1 = mysqli_query($conn,$sql1);

    // if($result1){
    //     echo "created";

    // }else{
    //     echo "not created".mysqli_connect_error();
    // }
