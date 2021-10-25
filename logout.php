<?php
ob_start();
session_start();
require_once './DataBase/connection.php';
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
    session_destroy();
    header('Location:./start.html');
} elseif (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_destroy();
    header('Location:./start.html');
}
else{
    echo "Something went wrong!";
}
