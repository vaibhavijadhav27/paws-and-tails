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
    <style>
        .wrap {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            column-gap: 30%;
            row-gap: 20px;
            grid-auto-rows: minmax(100, auto);
        }
    </style>

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
                        <a class="nav-link" aria-current="page" href="./AdminHomePage.php">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link  " href="./AdminProducts.php">Products</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link active " href="./AdminGYD.php">Get a dog</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link " href="./AdminHT.html">Health and Train</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link " href="./AdminAccount.php"> <i class="material-icons text-secondary md-24">account_circle</i>
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
    <?php
    session_start();
    if (!empty($_SESSION['admin'])) {
        $dogsql = "select * from `dog` where type='buy' order by d_id DESC";
        include('../DataBase/connection.php');
        $result = mysqli_query($conn, $dogsql);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {


    ?>
            <div class="wrap container-md" style="position: absolute;
  left: 15%;
  top: 30%;">

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = !empty($row['photo']) ? "../assets/dogs/buy/" . $row['photo'] : "https://via.placeholder.com/50.png/09f/666";

                ?>

                    <div class="card" style="width: 15em;">
                        <img src="<?php echo $image; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Breed: <?php echo $row['breed'] ?></p>
                            <p class="card-text">Age: <?php echo $row['age'] ?></p>
                            <p class="card-text">Gender: <?php echo $row['gender'] ?></p>
                            <p class="card-text">Price: <?php echo $row['price'] ?></p>
                        </div>

                        <div class="card-body">
                            <a href="#" class="card-link">Edit</a>
                            <a href="#" class="card-link">Delete</a>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
    <?php
        }
    }
    ?>
    <div class="position-fixed bottom-0 end-0 m-4 bg-light">
        <button class="btn btn-outline-secondary p-2" onclick="location.href = './AdminBuyForm.php'">Add
            New
            Dog</button>
    </div>
    <div class="navy col-md-1 m-4 bg-light" style="border: 1px solid gray; border-radius: 5px;">
        <nav class="nav-pills flex-column">
            <a class="nav-link active" aria-current="page" href="AdminGYD.php">Buy</a>
            <a class="nav-link" href="AdminAdopt.php">Adopt</a>
            <a class="nav-link" href="AdminFoster.php">Foster</a>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>