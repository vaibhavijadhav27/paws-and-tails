<?php
ob_start();
session_start();
error_reporting(0);
$showAlert = false;
$showError = false;
require_once './DataBase/connection.php';
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
    session_destroy();
    header('Location:./index.php');
} elseif (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_destroy();
    header('Location:./index.php');
} else {
    echo "Something went wrong!";
}
