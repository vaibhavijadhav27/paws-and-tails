<?php
ob_start();
session_start();
error_reporting(0);
$showAlert = false;
$showError = false;
if (empty($_SESSION['user'])) {
    $currentPage = !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $_SESSION['request_url'] = $currentPage;
    header('Location: ../login.php');
    exit();
}
$showError = false;
$showAlert = false;
if (isset($_POST) && !empty($_FILES)) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $experience = $_POST["experience"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $fee = $_POST["fee"];
    $photo = $_FILES["image"];
    $desc = $_POST["description"];
    $type = $_POST["type"];
    if (empty($type)) {
        $showError = "Profession cannot be empty!";
    } elseif (empty($name)) {
        $showError = "name cannot be empty!";
    } elseif (empty($age)) {
        $showError = "age cannot be empty!";
    } elseif (empty($experience)) {
        $showError = "Experience cannot be empty!";
    } elseif (empty($phone)) {
        $showError = "Phone Number cannot be empty!";
    } elseif (!empty($phone) && !preg_match("/^[0-9]{10}$/", $phone)) {
        $showError = "Invalid Phone Number!";
    } elseif (empty($gender)) {
        $showError = "gender cannot be empty!";
    } elseif (empty($fee)) {
        $showError = "Fee cannot be empty!";
    } elseif (empty($photo)) {
        $showError = "Photo cannot be empty!";
    } elseif (empty($desc)) {
        $showError = "Description cannot be empty!";
    } else {
        $targetDir = "../assets/requests/$type/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                include('../DataBase/connection.php');
                $user = $_SESSION['user']['name'];
                $useremail = $_SESSION['user']['email'];
                $sql = "INSERT INTO `job_req` (`name`, `age`, `experience`,`phone`,`gender`,`fees`, `photo`,`description`,`type`,`postedby`,`postedemail`) VALUES ('$name', '$age', '$experience','$phone','$gender','$fee','" . $fileName . "','$desc','$type','$user','$useremail')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true;
                    $showError = false;
                } else {
                    $showError = "There was some problem uploading, please try again later.";
                }
            }
        } else {
            $showError = "Invalid file format!";
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws and Tails | Health and Train</title>
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
    <header>
        <h1>
            <icon style="padding-right:10px ">
                <img src="../assets/snoopy2.png" style="width:6% ;">
            </icon>
            <a href="UserHomePage.php" style="text-decoration:none !important; color:inherit">Paws and Tails</a>
            <i class="bi bi-x text-secondary" style="font-size:40px; cursor:pointer; float: right; text-shadow:none;" onclick="history.go(-1);"></i>
        </h1>
    </header>
    <?php
    if ($showAlert == true) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Request Sent!
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div> ';
        header("refresh: 2; url = ./UserHT.php");
    }
    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div> ';
    }
    ?>
    <section id="contact">
        <div class="container-lg">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="type" class="form-label text-muted">Choose your respective profession</label>
                    <br>
                    <input type="radio" name="type" value="vet">
                    <label for="vet">Vet</label>
                    <input type="radio" name="type" value="trainer">
                    <label for="trainer">Trainer</label>
                    <input type="radio" name="type" value="walker">
                    <label for="walker">Walker</label>
                    <input type="radio" name="type" value="caretaker">
                    <label for="caretaker">Caretaker</label>
                </div>

                <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <input class="btn btn-secondary btn-md round" onclick="location.href = 'AdminVetForm.php'" type="reset" value="&nbsp;Vets&nbsp;" />
        <input class="btn btn-light btn-sm round" onclick="location.href = 'AdminTrainerForm.php'" type="reset" value="Trainers" />
        <input class="btn btn-light btn-sm round" onclick="location.href = 'AdminWalkerForm.php'" type="reset" value="Walkers" />
        <input class="btn btn-light btn-sm round" onclick="location.href = 'AdminCaretakerForm.php'" type="reset" value="Care Takers" />
      </div> -->

                <div class="text-center">
                    <h2>Job Request Form</h2>

                </div>
                <div class="row justify-content-center my-5">
                    <div class="col-lg-6">


                        <label for="name" class="form-label">Name:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill text-secondary"></i>
                            </span>
                            <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Dr. Tucker Budzyn" />
                        </div>

                        <label for="age" class="form-label">Age:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="material-icons text-secondary md-18">cake</i>
                            </span>
                            <input class="form-control" type="text" id="age" name="age" placeholder="e.g. 25 years" />
                        </div>


                        <label for="experience" class="form-label">Experience:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="material-icons text-secondary md-18">stars</i>
                            </span>
                            <input class="form-control" type="text" id="experience" name="experience" placeholder="e.g. 3 years" />
                        </div>

                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-telephone-fill text-secondary"></i>
                            </span>
                            <input class="form-control" type="text" id="phone" name="phone" placeholder="eg. 9652XXXXX0">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="gender" class="form-label">Gender:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-gender-ambiguous text-secondary md-18"></i>
                            </span>
                            <input type="text" id="gender" name="gender" class="form-control" placeholder="e.g. Male" />
                        </div>
                        <label for="fee" class="form-label">Fee:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="material-icons md-18 text-secondary">
                                    currency_rupee
                                </i>
                            </span>
                            <input class="form-control" type="text" id="fee" name="fee" placeholder="e.g. &#8377;1000" />
                        </div>

                        <label class="custom-file-label form-label" for="image">Add a Picture:</label>
                        <div class="custom-file mb-4 input-group">
                            <span class="input-group-text">
                                <i class="material-icons md-18 text-secondary">
                                    add_a_photo
                                </i>
                            </span>
                            <input class="form-control custom-file-input" type="file" id="image" name="image">

                        </div>

                        <label for="description" class="form-label">Description:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="material-icons text-secondary md-18">description</i>
                            </span>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>

                        </div>
                    </div>


                    <div class="mb-4 text-center">
                        <button type="submit" class="btn btn-secondary" onclick="location:'./AdminJobRequest.php'">Submit for review</button>
                    </div>

            </form>
        </div>
        </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>