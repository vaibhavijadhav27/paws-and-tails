<?php
error_reporting(0);
?>
<?php
ob_start();
session_start();

$showError = false;
if (isset($_POST) && !empty($_FILES)) {
    $photo1 = $_FILES['image1'];
    $photo2 = $_FILES['image2'];

    if (empty($photo1)) {
        $showError = "blog 1 cannot be empty!";
    } elseif (empty($photo2)) {
        $showError = "blog 2 cannot be empty!";
    } else {
        $targetDir = "../assets/blogs/";
        $fileName1 = basename($_FILES["image1"]["name"]);
        $targetFilePath1 = $targetDir . $fileName1;
        $fileType1 = pathinfo($targetFilePath1, PATHINFO_EXTENSION);
        $fileName2 = basename($_FILES["image2"]["name"]);
        $targetFilePath2 = $targetDir . $fileName2;
        $fileType2 = pathinfo($targetFilePath2, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType1, $allowTypes) && in_array($fileType2, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image1"]["tmp_name"], $targetFilePath1) && move_uploaded_file($_FILES["image2"]["tmp_name"], $targetFilePath2)) {
                include('../DataBase/connection.php');
                $sql = "INSERT INTO `blog` (`photo1`,`photo2`) VALUES ('" . $fileName1 . "','" . $fileName2 . "')";
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

    <header>
        <h1>
            <icon style="padding-right:10px ">
                <img src="../assets/snoopy2.png" style="width:6% ;">
            </icon>
            Paws and Tails
        </h1>
    </header>
    <?php
    if ($showAlert == true) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> New blog added!
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div> ';
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

            <div class="text-center">
                <h2>Add Blog</h2>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-lg-6">
                    <form action="" method="post" enctype="multipart/form-data">

                        <label class="custom-file-label form-label" for="image">Add Blog1&nbsp; (<i>Cause</i>):</label>
                        <div class="custom-file mb-4 input-group">
                            <span class="input-group-text">
                                <i class="material-icons md-18 text-secondary">
                                    add_a_photo
                                </i>
                            </span>
                            <input class="form-control custom-file-input" type="file" id="image1" name="image1">
                        </div>

                        <label class="custom-file-label form-label" for="image">Add Blog2&nbsp; (<i>Cure</i>):</label>
                        <div class="custom-file mb-4 input-group">
                            <span class="input-group-text">
                                <i class="material-icons md-18 text-secondary">
                                    add_a_photo
                                </i>
                            </span>
                            <input class="form-control custom-file-input" type="file" id="image2" name="image2">
                        </div>
                </div>
                <div class="mb-4 text-center">
                    <button type="submit" class="btn btn-secondary" onclick="location:'./AdminAddBlogForm.php'">Add Blog</button>
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