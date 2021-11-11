<?php
session_start();
error_reporting(0);
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


    <style>
        .wrap {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            column-gap: 30%;
            row-gap: 20px;
            grid-auto-rows: minmax(100, auto);
        }

        .card {
            position: relative;
            width: 17rem;
            height: 26rem;
            border-radius: 20px;
            background-position: center center;
            overflow: hidden;
        }

        /* Assigning properties to inner
            content of card  */
        .card__inner {
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0px;
            bottom: 0px;
            left: 0px;
            right: 0px;
            z-index: 1;
            opacity: 0;
            padding: 2rem 1.3rem 2rem 2rem;
            transition: all 0.6s ease 0s;
        }

        /* On hovering card opacity of
            content must be 1*/
        .card:hover .card__inner {
            opacity: 1;

        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

        .card__inner p {
            overflow-y: scroll;
            height: 87%;
            padding-right: 1rem;
            font-weight: 200;
            line-height: 2.5rem;
            margin-top: 1.5rem;
        }

        .container-md>.card>img {
            height: 50%;
            object-fit: contain;
            margin-top: 10px
        }

        .view:hover {
            font-weight: 600;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <h1>
            <icon style="padding-right:10px ">
                <img src="../assets/snoopy2.png" style="width:6% ;">
            </icon>
            <a href="AdminHomePage.php" style="text-decoration:none !important; color:inherit">Paws and Tails</a>
        </h1>
    </header>

    <nav class="navbar navbar-expand-sm navbar-light bg-light" style="height: 10%;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex" method="post" action="./AdminSearchDog.php">
                    <div class="mb-1 mt-3 ml-5 input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search text-secondary"></i>
                        </span>
                        <input type="text" name="user_query1" class="form-control" placeholder="search here" style="font-style:italic" />
                    </div>
                    <button class="mb-1 mt-3 btn btn-outline-secondary" type="submit" name="searchDog">Search</button>
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
                        <a class="nav-link " href="./AdminHT.php">Health and Train</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="./AdminAccount.php"> <i class="material-icons text-secondary md-24">account_circle</i>
                        </a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="./AdminManageAccount.php"><i class="material-icons text-secondary md-24">manage_accounts</i>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <?php
    $type = 'foster';
    if (!empty($_SESSION['admin'])) {
        $dogsql = "select * from `dog` where type='foster' order by d_id DESC";
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
                    if ($row['check'] == "request") {
                        $image = !empty($row['photo']) ? "../assets/requests/" . $row['type'] . "/" . $row['photo'] : "https://via.placeholder.com/150";
                    } else {
                        $image = !empty($row['photo']) ? "../assets/dogs/foster/" . $row['photo'] : "https://via.placeholder.com/150";
                    }
                ?>

                    <div class="card" style="width: 15em;">
                        <img src="<?php echo $image; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-title"><b>Name:</b>
                                <?php echo $row['name'] ?>
                            </p>
                            <p class="card-text"><b>Breed:</b>
                                <?php echo $row['breed'] ?>
                            </p>
                            <p class="card-text"><b>Age:</b>
                                <?php echo $row['age'] ?>
                            </p>
                            <p class="card-text"><b>Gender:</b>
                                <?php echo $row['gender'] ?>
                            </p>
                            <p class="card-text"><b>Payment: </b>&#8377;
                                <?php echo $row['price'] ?>
                            </p>
                        </div>

                        <div class="card__inner d-grid">

                            <a class="btn btn-outline-light btn-block" style="height: 50px; margin-top:80%" href='<?php echo 'AdminViewDog.php?id=' . $row['d_id']; ?>'><b>View</b></a>
                            <a class=" btn btn-outline-light btn-block" style="height: 50px;" href='<?php echo 'AdminFosterForm.php?id=' . $row['d_id']; ?>'><b>Edit</b></a>
                            <a class=" btn btn-outline-light btn-block" style="height: 50px;" href='<?php echo 'AdminDeleteDog.php?id=' . $row['d_id'] . '&type=' . $type; ?>' onclick="return confirm('Are you sure you want to delete this dog?')" ;><b>Delete</b></a>
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
        <button class="btn btn-outline-secondary p-2" onclick="location.href = './AdminFosterForm.php'">Add
            New
            Dog</button>
    </div>
    <div class="navy col-md-1 m-4 bg-light" style="border: 1px solid gray; border-radius: 5px;">
        <nav class="nav-pills flex-column">
            <a class="nav-link " aria-current="page" href="AdminGYD.php">Buy</a>
            <a class="nav-link " href="AdminAdopt.php">Adopt</a>
            <a class="nav-link active" href="AdminFoster.php">Foster</a>
        </nav>
    </div>

    <div class="m-4">
        <button class="view p-2 col-md-1 m-1 bg-light" style="border: 1px solid gray; border-radius: 5px;" onclick="location.href = './AdminRequestFoster.php'">
            View Requests</button>
    </div>

</body>

</html>