<?php
error_reporting(0);
session_start();
$user = $_SESSION['admin'];
$userid = $_SESSION['admin']['admin_id'];
include '../DataBase/connection.php';
$sql = "Select * from `admin` where `admin_id`=$userid";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $userInfo = mysqli_fetch_assoc($result);
} else {
    echo "Admin not found";
    exit();
}

$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $photo = !empty($_FILES['photo']) ? $_FILES['photo'] : [];

    if (empty($name)) {
        $showError = "Please enter your Name !";
    } elseif (!empty($name) && !preg_match("/[a-zA-Z]+ [a-zA-Z]+$/", $name)) {
        $showError = "Please match the requested format for Name!";
    } elseif (empty($email)) {
        $showError = "Please enter your email id!";
    } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $showError = "Invalid Email ID!";
    } elseif (empty($phone)) {
        $showError = "Please enter your Phone Number!";
    } elseif (!empty($phone) && !preg_match("/^[0-9]{10}$/", $phone)) {
        $showError = "Invalid Phone Number!";
    } elseif (empty($address)) {
        $showError = "Please enter your address!";
    }
    $photoName = '';
    if (!empty($photo['name'])) {
        $fileTempPath = $photo['tmp_name'];
        $fileName = $photo['name'];
        $fileNameCmp = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmp));
        $fileNewName = $fileName . $fileExtension;
        $photoName = $fileName;

        $allowed = ['jpg', 'jpeg', 'png'];
        if (in_array($fileExtension, $allowed)) {
            $uploadFileDir = "../assets/users/";
            $destFilePath = $uploadFileDir . $photoName;
            if (!move_uploaded_file($fileTempPath, $destFilePath))
                $showError = "Picture couldn't be uploaded";
        } else {
            $showError = "Invalid file format";
        }
    }
    if (!empty($userid)) {
        if (!empty($photoName)) {

            $sql = "UPDATE `admin` SET name = '{$name}', email = '{$email}', phone = '{$phone}', address = '{$address}',  profile='{$photoName}' WHERE admin_id = {$userid}";
            $message = 'Profile Updated';
        } else {
            $sql = "UPDATE `admin` SET name = '{$name}', email = '{$email}', phone = '{$phone}', address = '{$address}' WHERE admin_id = {$userid}";
            $message = 'Profile Updated';
        }
        $result1 = mysqli_query($conn, $sql);
        if ($result1) {
            $showAlert = true;
            $showError = false;
        } else {
            $showError = "There was some problem, please try again later.";
        }
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
        header("refresh: 2; url = ./AdminAccount.php");
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
                <h4 class="card-title mt-2">Edit Profile </h4>
            </header>

            <div class="row justify-content-center my-5">
                <div class="col-lg-6">

                    <form action="./AdminEditProfile.php" method="post" enctype="multipart/form-data">
                        <label for="name" class="form-label">Full Name:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill text-secondary"></i>
                            </span>
                            <input type="text" id="name" name="name" value="<?php echo $userInfo['name']; ?>" class="form-control" placeholder="Firstname Surname ">
                        </div>
                        <label for=" email" class="form-label">Email address:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill text-secondary"></i>
                            </span>
                            <input type="text" id="email" name="email" value="<?php echo $userInfo['email']; ?>" class="form-control" placeholder="e.g. email@example.com">
                        </div>
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-telephone-fill text-secondary"></i>
                            </span>
                            <input class="form-control" type="text" id="phone" name="phone" value="<?php echo $userInfo['phone']; ?>" placeholder="eg. 9652XXXXX0">
                        </div>
                        <label class="custom-file-label form-label" for="photo">Update profile picture:</label>
                        <div class="custom-file mb-4 input-group">
                            <span class="input-group-text">
                                <i class="material-icons md-18 text-secondary">
                                    add_a_photo
                                </i>
                            </span>
                            <input class="form-control custom-file-input" type="file" id="photo" name="photo">

                        </div>
                        <label for="address" class="form-label">Address:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="material-icons text-secondary">place</i>
                            </span>
                            <textarea required class="form-control" name="address" id="address" rows="4"><?php echo $userInfo['address']; ?></textarea>

                        </div>

                        <div class="mb-4 text-center">
                            <button type="submit" class="btn btn-success">Update </button>
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