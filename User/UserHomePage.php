<?php
ob_start();
session_start();
error_reporting(0);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws and Tails | Home</title>
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
            grid-template-columns: repeat(2, 2fr);
            column-gap: 30%;
            row-gap: 50px;
            grid-auto-rows: minmax(100, auto);
        }

        .wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: minmax(100, auto);
        }

        .card {
            position: relative;
            width: 17rem;
            height: 22rem;
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

        .wrapper>.card>img {
            height: 50%;
            object-fit: contain;
            margin-top: 10px
        }
    </style>
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
                <form class="d-flex" method="post" action="../Admin/AdminSearchProduct.php">
                    <div class="mb-1 mt-3 ml-5 input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search text-secondary"></i>
                        </span>
                        <input type="text" name="user_query" class="form-control" placeholder="search here" style="font-style:italic" />
                    </div>
                    <button class="mb-1 mt-3 btn btn-outline-secondary" type="submit" name="searchHome">Search</button>
                </form>
                <ul class="nav nav-pills me-auto mb-2 mb-lg-0" style="margin-left:20%">
                    <li class="nav-item px-3">
                        <a class="nav-link active" aria-current="page" href="./UserHomePage.php">Home</a>
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
                        <a class="nav-link" href="./UserAccount.php"> <i class="material-icons text-secondary md-24">account_circle</i>
                        </a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="./UserCart.php"><i class="material-icons text-secondary md-24">shopping_cart</i>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <img src="../assets/home2.png" style="width:100%;margin-bottom:2%">
    <?php

    $productsql = "select * from `dog_products` order by dproduct_id DESC LIMIT 3";
    include('../DataBase/connection.php');
    $result = mysqli_query($conn, $productsql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {


    ?>
        <h3 style="position: relative;top: 5%; margin-left:3% ; text-decoration: underline;"><b>What's New?</b></h3>
        <div class="wrapper" style="position: relative; width:1000px;top:10%;left:15% ;">

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $image = !empty($row['photo']) ? "../assets/products/" . $row['photo'] : "https://www.arraymedical.com/wp-content/uploads/2018/12/product-image-placeholder.jpg";

            ?>

                <div class="card">
                    <img src="<?php echo $image; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title"><b>Product:</b> <?php echo $row['name'] ?></p>
                        <p class="card-text"><b>Brand:</b> <?php echo $row['brand'] ?></p>
                        <p class="card-text"><b>Price:</b> &#8377; <?php echo $row['price'] ?></p>
                    </div>

                    <div class="card__inner d-grid">

                        <a class="btn btn-outline-light btn-block" style="height: 50px; margin-top:90%" href='<?php echo 'UserViewProduct.php?id=' . $row['dproduct_id']; ?>'><b>View</b></a>
                        <a class=" btn btn-outline-light btn-block" style="height: 50px;" href='<?php echo 'AddToCart.php?productid=' . $row['dproduct_id']; ?>'><b>Add to Cart</b></a>

                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    <?php
    }

    ?>

    <h3 style="position: relative;top: 20%; margin-left:3%; margin-bottom:3%; text-decoration: underline;"><b>Educate yourself with useful Blogs</b></h3>
    <?php

    $blogsql = "select * from `blog` order by blog_id DESC";
    $result = mysqli_query($conn, $blogsql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {


    ?>
        <div class="wrap" style="position: relative;margin:10%">

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $image1 = !empty($row['photo1']) ? "../assets/blogs/" . $row['photo1'] : "https://via.placeholder.com/50.png/09f/666";
                $image2 = !empty($row['photo2']) ? "../assets/blogs/" . $row['photo2'] : "https://via.placeholder.com/50.png/09f/666";

            ?>
                <img style="width: 30em;" src="<?php echo $image1; ?>">
                <img style="width: 30em;" src="<?php echo $image2; ?>">


            <?php
            }

            ?>

        </div>
    <?php

    }
    ?>



</body>

</html>