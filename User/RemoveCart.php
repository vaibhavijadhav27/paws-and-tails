<?php
session_start();
error_reporting(0);
$showAlert = false;
if (!empty($_SESSION['user'])) {
    $userid = $_SESSION['user']['user_id'];
    $productid = !empty($_GET['productid']) ? $_GET['productid'] : '';
    $dogid = !empty($_GET['d_id']) ? $_GET['d_id'] : '';
    $professionalid = !empty($_GET['p_id']) ? $_GET['p_id'] : '';
    $dtype = !empty($_GET['dtype']) ? $_GET['dtype'] : '';
    if ($dtype == 'buy') {
        $dogidbuy = $dogid;
    } elseif ($dtype == 'adopt') {
        $dogidadopt = $dogid;
    } elseif ($dtype == 'foster') {
        $dogidfoster = $dogid;
    } else {
        $dogidbuy = '';
        $dogidadopt = '';
        $dogidfoster = '';
    }
    include('../DataBase/connection.php');
    if ($productid != '') {
        $sql = "DELETE from `cart` where dproduct_id='$productid' and user_id='$userid'";
    } elseif ($dogidbuy != '') {
        $sql = "DELETE from `cart` where d_id_buy='$dogidbuy' and user_id='$userid'";
    } elseif ($dogidadopt != '') {
        $sql = "DELETE from `cart` where d_id_adopt='$dogidadopt' and user_id='$userid'";
    } elseif ($dogidfoster != '') {
        $sql = "DELETE from `cart` where d_id_foster='$dogidfoster' and user_id='$userid'";
    } elseif ($professionalid != '') {
        $sql = "DELETE from `cart` where p_id='$professionalid' and user_id='$userid'";
    } else {
        echo "<script>alert('Invalid!');</script>";
    }
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $showAlert = true;
        $showError = false;
    } else {
        $showError = "There was some problem uploading, please try again later.";
    }
} else {
    header("refresh: 1, url: '../login.php'");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws and Tails | Remove from Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://kit.fontawesome.com/2c558ff8c9.js" crossorigin="anonymous"></script>

</head>

<body>

    <?php
    if ($showAlert == true) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Removed from Cart!
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div> ';
        header("refresh: 2; url = ./UserCart.php");
    }
    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div> ';
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>