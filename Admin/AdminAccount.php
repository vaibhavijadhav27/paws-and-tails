<?php
session_start();
?>
<?php
include('../DataBase/connection.php');
if (empty($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}
$userID = $_SESSION['admin']['admin_id'];
$sql = "Select * from `admin` where `admin_id` = $userID";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $userInfo = mysqli_fetch_assoc($result);
} else {
    echo "admin not found";
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

    <nav class="navbar navbar-expand-sm navbar-light bg-light" style="height: 10%">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex">
                    <div class="mb-1 mt-3 ml-5 input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search text-secondary"></i>
                        </span>
                        <input type="search" id="search" name="search" class="form-control" placeholder="search here" style="font-style:italic" />
                    </div>
                    <button class="mb-1 mt-3 btn btn-outline-secondary" type="submit">Search</button>
                </form>
                <ul class="nav nav-pills me-auto mb-2 mb-lg-0" style="margin-left:20%">
                    <li class="nav-item px-3">
                        <a class="nav-link" aria-current="page" href="./AdminHomePage.php">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link  " href="./AdminProducts.php">Products</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link " href="./AdminGYD.php">Get a dog</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link " href="./AdminHT.html">Health and Train</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link active" href="./AdminAccount.php"> <i class="material-icons text-secondary md-24">account_circle</i>
                        </a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="./AdminManageAccount.html"><i class="material-icons text-secondary md-24">manage_accounts</i>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <main role="main" class="container">
        <div class="row justify-content-center wrapper">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Profile</h4>
                    </header>
                    <article class="card-body">
                        <div class="container" id="profile">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">

                                    <?php

                                    $image = "../assets/" . $userInfo['profile'];

                                    ?>
                                    <img style="width:150" src="<?php echo $image ?>" alt="" class="rounded-circle" />
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4 class="text-primary">
                                        <?php
                                        echo $userInfo['name'];
                                        ?>
                                    </h4>
                                    <p class="text-secondary">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <?php
                                        echo $userInfo['email'];
                                        ?>
                                        <br />
                                    </p>
                                    <p class="text-secondary">
                                        <i class="fa fa-phone-o" aria-hidden="true"></i>
                                        <?php
                                        echo $userInfo['phone'];
                                        ?>
                                        <br />
                                    </p>
                                    <p class="text-secondary">
                                        <i class="fa fa-house-o" aria-hidden="true"></i>
                                        <?php
                                        echo $userInfo['address'];
                                        ?>
                                        <br />
                                    </p>
                                    <!-- Split button -->
                                </div>
                            </div>

                        </div>
                    </article>

                </div>
            </div>

        </div> <!-- row.//-->

        <button class="btn btn-outline-secondary p-2" onclick="location.href = '../logout.php'">logout</button>
    </main>


</body>

</html>