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
    <!-- <link rel="stylesheet" href="./style/style.css"> -->
    <script src="https://kit.fontawesome.com/2c558ff8c9.js" crossorigin="anonymous"></script>
    <style>
        .wrap {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            column-gap: 5%;
            row-gap: 20px;
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

        .container-md>.card>img {
            height: 50%;
            object-fit: contain;
            margin-top: 10px
        }
    </style>
</head>

<body>

    <h1 class="card-header">
        Search Results
        <i class="bi bi-x text-secondary" style="font-size:40px; cursor:pointer; float: right; text-shadow:none;" onclick="history.go(-1);"></i>
    </h1>

    <?php
    $expression = $_POST['searchHome'] || $_POST['searchProduct'];
    if (isset($expression)) {
        include '../DataBase/connection.php';
        $userquery = $_POST['user_query'];
        $sql = "SELECT * FROM `dog_products` WHERE `name` LIKE '%$userquery%' or `brand` LIKE '%$userquery%' or `description` LIKE '%$userquery%' or `price` LIKE '%$userquery%'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {


    ?>

            <div class="wrap container-md" style="position: absolute;
  left: 2%;
  top: 20%;">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = !empty($row['photo']) ? "../assets/products/" . $row['photo'] : "https://via.placeholder.com/50.png/09f/666";
                ?>




                    <div class="card">
                        <img src="<?php echo $image; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Product: <?php echo $row['name'] ?></h5>
                            <p class="card-text">Brand: <?php echo $row['brand'] ?></p>
                            <p class="card-text">Price: <?php echo $row['price'] ?></p>
                        </div>

                        <!-- <div class="card-body">
                                <a href="#" class="card-link">Edit</a>
                                <a href="#" class="card-link">Delete</a>
                            </div> -->

                        <div class="card__inner d-grid">
                            <?php
                            if ($_SESSION['admin']) {
                            ?>
                                <a class="btn btn-outline-light btn-block" style="height: 50px; margin-top:40%" href='<?php echo 'AdminViewProduct.php?id=' . $row['dproduct_id']; ?>'><b>View</b></a>
                                <a class=" btn btn-outline-light btn-block" style="height: 50px;" href='<?php echo 'AdminAddProductForm.php?id=' . $row['dproduct_id']; ?>'><b>Edit</b></a>
                                <a class=" btn btn-outline-light btn-block" style="height: 50px;" href='<?php echo 'AdminDeleteProduct.php?id=' . $row['dproduct_id']; ?>' onclick=" return confirm('Are you sure you want to delete this product?');"><b>Delete</b></a>

                            <?php
                            } else {
                            ?>
                                <a class="btn btn-outline-light btn-block" style="height: 50px; margin-top:90%" href='<?php echo '../User/UserViewProduct.php?id=' . $row['dproduct_id']; ?>'><b>View</b></a>
                                <a class=" btn btn-outline-light btn-block" style="height: 50px;" href='<?php echo '../User/AddToCart.php?productid=' . $row['dproduct_id']; ?>'><b>Add to Cart</b></a>

                            <?php
                            }
                            ?>

                        </div>

                    </div>



                <?php
                }
                ?>
            </div>
    <?php
        }

        /* print divider */
    }
    ?>
</body>

</html>