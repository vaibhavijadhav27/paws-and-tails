<?php
session_start();
include('../DataBase/connection.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws and Tails | Cart</title>
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
            grid-template-columns: repeat(2, 1fr);
            column-gap: 5%;
            row-gap: 20px;
            grid-auto-rows: minmax(100, auto);
        }
    </style>
</head>

<body>

    <?php
    $userid = $_SESSION['user']['user_id'];
    $cartproduct = "SELECT * from `cart` WHERE (d_id_adopt!=0 or d_id_foster!=0) and user_id='$userid'";

    $result = mysqli_query($conn, $cartproduct);
    // print_r($result);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {


    ?>
        <div class="wrap container-md" style="position: absolute;
  left: 2%;
  top: 5%;">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $adoptid = $row['d_id_adopt'];
                $fosterid = $row['d_id_foster'];

                $sql1 = "SELECT * from `dog` WHERE `d_id`='$adoptid' or `d_id`='$fosterid' ";
                $result1 = mysqli_query($conn, $sql1);
                // print_r($result1);
                $num = mysqli_num_rows($result1);
                if ($num > 0) {
                    $product = mysqli_fetch_assoc($result1);
                    $type = $product['type'];
                    if ($type == 'adopt') {
                        if ($product['check'] == 'request') {
                            $src = "../assets/requests/adopt/" . $product['photo'];
                        } else {
                            $src = "../assets/dogs/adopt/" . $product['photo'];
                        }
                    } elseif ($type == 'foster') {
                        if ($product['check'] == 'request') {
                            $src = "../assets/requests/foster/" . $product['photo'];
                        } else {
                            $src = "../assets/dogs/foster/" . $product['photo'];
                        }
                    }
                    $image = !empty($product['photo']) ? $src  : "https://via.placeholder.com/150";
            ?>

                    <div class="container-md">
                        <a href="<?php echo 'UserViewProfessional.php?id=' . $productid; ?>" style=" text-decoration: none; color: inherit;">
                            <div class="card mb-3" style="width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="row g-0 m-3">
                                            <img src="<?php echo $image; ?>" style="width:300px;" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="row g-0 m-4">
                                            <a class="btn btn-danger" href='<?php echo 'RemoveCart.php?id=' . $row['dreq_id'] . '&type=' . $type; ?>' onclick="return confirm('Are you sure you want to remove this ')" ;>Remove</a>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Name: <?php echo $product['name'] ?></h5>
                                            <p class="card-text">Breed: <?php echo $product['breed'] ?></p>
                                            <p class="card-text">Age: <?php echo $product['age'] ?></p>
                                            <p class="card-text">Type: <?php echo $product['type'] ?></p>
                                            <?php
                                            if ($product['type'] == 'foster') { ?>
                                                <p class="card-text">Payment: <?php echo $product['price'] ?></p>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>





            <?php
                }
            }
            ?>
        </div>
    <?php
    }
    ?>
</body>

</html>