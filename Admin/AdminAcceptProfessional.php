<?php

session_start();
$showAlert = false;
$showError = false;
$type = !empty($_GET['type']) ? $_GET['type'] : '';
$jreqid = !empty($_GET['id']) ? $_GET['id'] : '';
$sql1 = "SELECT * from `job_req` where `jreq_id`=$jreqid";
include('../DataBase/connection.php');
$result = mysqli_query($conn, $sql1);
if ($result) {

    $rows =  mysqli_fetch_assoc($result);
    $name = $rows['name'];
    $age = $rows['age'];
    $experience = $rows['experience'];
    $gender = $rows['gender'];
    $phone = $rows['phone'];
    $fee = $rows['fees'];
    $fileName = $rows['photo'];
    $desc = $rows['description'];
    $sql = "INSERT INTO `professionals` (`name`, `age`, `experience`,`phone`,`gender`,`fees`, `photo`,`description`,`type`,`check`) VALUES ('$name', '$age', '$experience','$phone','$gender','$fee','$fileName','$desc','$type','request'); ";
    $sql .= "DELETE FROM `job_req` WHERE `jreq_id`='$jreqid'";
    if (mysqli_multi_query($conn, $sql)) {
        $showAlert = true;
    } else {
        $showError = "Request doesn't exist";
        exit();
    }
} else {
    $showError = "There was an error, try again later";
    exit();
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws and Tails | Get a Dog</title>
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
        <strong>Success!</strong>Request Accepted!
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div> ';
        if ($type == 'vet') {
            header("refresh: 2; url = ./AdminHT.php");
        } elseif ($type == 'trainer') {
            header("refresh: 2; url = ./AdminTrainer.php");
        } elseif ($type == 'caretaker') {
            header("refresh: 2; url = ./AdminCaretaker.php");
        } elseif ($type == 'walker') {
            header("refresh: 2; url = ./AdminWalker.php");
        }
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

</html>