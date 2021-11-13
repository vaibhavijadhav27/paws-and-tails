<?php
session_start();
?>
<?php
include('../DataBase/connection.php');
if (empty($_SESSION['user'])) {
    $currentPage = !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $_SESSION['request_url'] = $currentPage;
    header('Location: ../login.php');
    exit();
}
$userID = $_SESSION['user']['user_id'];
$sql = "Select * from `user` where `user_id` = $userID";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $userInfo = mysqli_fetch_assoc($result);
} else {
    echo "user not found";
}
?>


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
        </h1>
    </header>


    <nav class="navbar navbar-expand-sm navbar-light bg-light" style="height: 10%;">
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
                        <a class="nav-link " aria-current="page" href="./UserHomePage.php">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link  " href="./UserProducts.php">Products</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link " href="./UserGYD.php">Get a dog</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link " href="./UserHT.php">Health and Train</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link active" href="./UserAccount.php"> <i class="material-icons text-secondary md-24">account_circle</i>
                        </a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="./UserCart.php"><i class="material-icons text-secondary md-24">shopping_cart</i>
                        </a>
                    </li>

            </div>
        </div>
    </nav>

    <main role="main" class="container">
        <div class="row justify-content-center wrapper">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Profile</h4>
                    </header>
                    <article class="card-body">
                        <div class="container" id="profile">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">

                                    <?php

                                    $image = "../assets/users/" . $userInfo['profile'];

                                    ?>
                                    <img style="width:150" src="<?php echo $image ?>" alt="" class="rounded-circle" />
                                </div>
                                <div class="col-sm-6 col-md-8" style="padding-left: 10%;">
                                    <p class="text-secondary">
                                        <i class="bi bi-person-fill text-secondary"></i>
                                        <?php
                                        echo $userInfo['name'];
                                        ?>
                                    </p>
                                    <p class="text-secondary">
                                        <i class="bi bi-envelope-fill text-secondary"></i>
                                        <?php
                                        echo $userInfo['email'];
                                        ?>
                                        <br />
                                    </p>
                                    <p class="text-secondary">
                                        <i class="bi bi-telephone-fill text-secondary"></i>
                                        <?php
                                        echo $userInfo['phone'];
                                        ?>
                                        <br />
                                    </p>
                                    <p class="text-secondary">
                                        <i class="bi bi-geo-alt-fill text-secondary"></i>
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
            <div class="col-md-6 " style="margin-top:10%;">
                <button class="btn btn-secondary p-2 my-1" style="height: 40px; width:400px;text-align: start" onclick="location.href = './UserEditProfile.php'">Edit Profile<i class="bi bi-caret-right" style="float:right"></i></button>
                <button class="btn btn-secondary p-2 my-1" style="height: 40px; width:400px;text-align: start" onclick="location.href = './UserChangePassword.php'">Change Password<i class="bi bi-caret-right" style="float:right"></i></button>
                <button class="btn btn-secondary p-2 my-1" style="height: 40px; width:400px;text-align: start" onclick="location.href = '../logout.php'">logout<i class="bi bi-caret-right" style="float:right"></i></button>
            </div>
        </div> <!-- row.//-->




    </main>


</body>

</html>