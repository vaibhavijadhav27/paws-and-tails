<?php
ob_start();
session_start();
error_reporting(0);
$showAlert = false;
$showError = false;
$user = $_SESSION['user'];
$userid = $_SESSION['user']['user_id'];
include '../DataBase/connection.php';
$sql = "Select * from `user` where `user_id`=$userid";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $userInfo = mysqli_fetch_assoc($result);
    $passwordinDB = $userInfo['password'];
} else {
    echo "user not found";
    exit();
}
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldpassword = $_POST['oldpassword'];
    $password = $_POST['newpassword'];
    $cpassword = $_POST['cpassword'];

    if (empty($oldpassword)) {
        $showError = "Old Password cannot be empty!";
    } elseif (empty($password)) {
        $showError = "New Password cannot be empty!";
    } elseif (empty($cpassword)) {
        $showError = "please retype your new password!";
    } elseif ($password != $cpassword) {
        $showError = "Passwords do not match";
    }
    if ($oldpassword == $passwordinDB) {

        $sql = "UPDATE `user` SET password='{$password}' WHERE user_id=$userid";
        $message = 'Password has been changed';
    } else {
        $showError = "Old password is incorrect!";
    }

    $result1 = mysqli_query($conn, $sql);
    if ($result1) {
        $showAlert = true;
        $showError = false;
    } else {
        $showError = "There was some problem, please try again later.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws and Tails | Account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="../style/style.css"> -->
    <script src="https://kit.fontawesome.com/2c558ff8c9.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php
    if ($showAlert == true) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>' . $message . '!
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            </button>
        </div> ';
        header("refresh: 2; url = ./UserAccount.php");
    } elseif ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>
    <section id="contact">
        <div class="container-lg">
            <header class="card-header">
                <i class="bi bi-x text-secondary mb-2" style="font-size:40px; cursor:pointer; float: right; text-shadow:none;" onclick="history.go(-1);"></i>
                <h4 class="card-title mt-2">Change Password</h4>
            </header>

            <div class="row justify-content-center my-5">
                <div class="col-lg-6">

                    <form action="./UserChangePassword.php" method="post">
                        <label for="oldpassword" class="form-label">Current Password</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill text-secondary"></i>
                            </span>
                            <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter your old password">
                        </div>
                        <label for="newpassword" class="form-label">New Password</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill text-secondary"></i>
                            </span>
                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Choose your new password">
                        </div>
                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-check-circle-fill text-secondary"></i>
                            </span>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-type new password">
                        </div>


                        <div class="mb-4 text-center">
                            <button type="submit" class="btn btn-success">Change Password</button>
                        </div>
                </div>
                </form>
            </div>
        </div>


    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>