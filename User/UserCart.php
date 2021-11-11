<?php
session_start();
include('../DataBase/connection.php');
error_reporting(0);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://kit.fontawesome.com/2c558ff8c9.js" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <title>Paws and Tails | Cart</title>
    <style>
        .item {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .item1 {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-pay {
            background-color: #C800Da;
            border: 0;
            color: #fff;
            font-weight: 600;
        }

        .fa-ticket {
            color: #0e1fa1;
        }

        .container {
            background-color: #ffff;
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
                <form class="d-flex">
                    <div class="mb-1 mt-3  input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search text-secondary"></i>
                        </span>
                        <input type="search" id="search" name="search" class="form-control" placeholder="search here" style="font-style:italic" />
                    </div>
                    <button class="mb-1 mt-3 btn btn-outline-secondary" type="submit">Search</button>
                </form>
                <ul class="nav nav-pills me-auto mb-2 mb-lg-0" style="margin-left:15%">
                    <li class="nav-item px-3">
                        <a class="nav-link" aria-current="page" href="./UserHomePage.php">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link  " href="./UserProducts.php">Products</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link  " href="./UserGYD.php">Get a dog</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link " href="./UserHT.php">Health and Train</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link " href="./UserAccount.php"> <i class="material-icons text-secondary md-24">account_circle</i>
                        </a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link active" href="./UserCart.php"><i class="material-icons text-secondary md-24">shopping_cart</i>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container py-5 mt-5 mb-5">
        <?php
        $userid = $_SESSION['user']['user_id'];
        $cartproduct = "SELECT * from `cart` WHERE (dproduct_id!=0) and user_id='$userid'";
        $result = mysqli_query($conn, $cartproduct);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {


        ?>

            <div class="row justify-content-center">

                <div class="col-xl-7 col-lg-8 col-md-7">
                    <div class="border border-gainsboro p-3 mb-4">

                        <h2 class="h6 text-uppercase mb-0">Cart Total : <strong class="cart-total"></strong></h2>
                    </div>
                    <div class="border border-gainsboro p-3">

                        <h2 class="h6 text-uppercase mb-0">Dog Products</h2>
                    </div>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $productid = $row['dproduct_id'];
                        $sql1 = "SELECT * from `dog_products` WHERE `dproduct_id`='$productid'";
                        $result1 = mysqli_query($conn, $sql1);
                        $num = mysqli_num_rows($result1);
                        if ($num > 0) {
                            $product = mysqli_fetch_assoc($result1);

                            $image = !empty($product['photo']) ? "../assets/products/" . $product['photo'] : "https://via.placeholder.com/150";
                    ?>
                            <div class="border border-gainsboro p-3 mt-3 clearfix item">
                                <div class="text-lg-left">
                                    <img src="<?php echo $image; ?>" class="img-fluid rounded-start" style="width:100px" alt="...">
                                </div>
                                <div class="col-lg-5 col-5 text-lg-left">
                                    <h3 class="h6 mb-0">Product: <?php echo $product['name'] ?><br>
                                        <span>
                                            <p class="card-text">Brand: <?php echo $product['brand'] ?></p>
                                        </span>
                                        <small>cost: <?php echo number_format($product['price']); ?> each</small>
                                    </h3>
                                </div>
                                <div class="product-price d-none"><?php echo number_format($product['price']); ?></div>
                                <div class="pass-quantity col-lg-3 col-md-4 col-sm-3">
                                    <label for="pass-quantity" class="pass-quantity">Quantity</label>
                                    <input class="form-control" type="number" value="1" min="1">
                                </div>
                                <div class="col-lg-2 col-md-1 col-sm-2 product-line-price pt-4">
                                    <span class="product-line-price"><?php echo number_format($product['price']); ?>
                                    </span>
                                </div>
                                <div class="remove-item pt-4">
                                    <a class="remove-product btn btn-danger btn-block" href='<?php echo './RemoveCart.php?productid=' . $product['dproduct_id']; ?>' onclick=" return confirm('Are you sure you want to remove this product from cart?');"><b>Remove</b></a>
                                </div>



                            </div>
                    <?php
                        }
                    }
                    ?>

                <?php
            }
                ?>
                <?php

                $userid = $_SESSION['user']['user_id'];
                $cartproduct = "SELECT * from `cart` WHERE (d_id_buy!=0) and user_id='$userid'";

                $result = mysqli_query($conn, $cartproduct);
                $rows = mysqli_num_rows($result);
                if ($rows > 0) {


                ?>

                    <div class="border border-gainsboro p-3 mt-4">

                        <h2 class="h6 text-uppercase mb-0">Your Dogs</h2>
                    </div>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $productid = $row['d_id_buy'];
                        $sql1 = "SELECT * from `dog` WHERE `d_id`='$productid'";
                        $result1 = mysqli_query($conn, $sql1);
                        $num = mysqli_num_rows($result1);
                        if ($num > 0) {
                            $product = mysqli_fetch_assoc($result1);
                            $image = !empty($product['photo']) ? "../assets/dogs/buy/" . $product['photo'] : "https://via.placeholder.com/150";
                    ?>
                            <div class="border border-gainsboro p-3 mt-3 clearfix item">
                                <div class="text-lg-left">
                                    <img src="<?php echo $image; ?>" class="img-fluid rounded-start" style="width:100px" alt="...">

                                </div>
                                <div class="col-lg-5 col-5 text-lg-left">
                                    <h3 class="h6 mb-0">Breed: <?php echo $product['breed'] ?><br>
                                        <span>
                                            <p class="card-text">Age: <?php echo $product['age'] ?></p>
                                        </span>
                                        <small>cost: <?php echo number_format($product['price']); ?> each</small>
                                    </h3>
                                </div>
                                <div class="product-price d-none"><?php echo number_format($product['price']); ?></div>
                                <div class="pass-quantity col-lg-3 col-md-4 col-sm-3">
                                    <label for="pass-quantity" class="pass-quantity"></label>
                                    <input class="form-control" type="hidden" value="1">
                                </div>
                                <div class="col-lg-2 col-md-1 col-sm-2 product-line-price pt-4">
                                    <span class="product-line-price"><?php echo number_format($product['price']); ?>
                                    </span>
                                </div>

                                <div class="remove-item pt-4">
                                    <a class="remove-product btn btn-danger btn-block" href='<?php echo './RemoveCart.php?d_id=' . $product['d_id'] . '&dtype=' . $product['type']; ?>' onclick=" return confirm('Are you sure you want to remove this dog from cart?');"><b>Remove</b></a>
                                </div>



                            </div>
                    <?php
                        }
                    }
                    ?>

                <?php
                }
                ?>
                <?php
                $userid = $_SESSION['user']['user_id'];
                $cartproduct = "SELECT * from `cart` WHERE (d_id_adopt!=0 or d_id_foster!=0) and user_id='$userid'";

                $result = mysqli_query($conn, $cartproduct);
                // print_r($result);
                $rows = mysqli_num_rows($result);
                if ($rows > 0) {


                ?>

                    <div class="border border-gainsboro p-3 mt-4 item1">

                        <h2 class="h6 text-uppercase mb-0">Adopted/Fostered Dogs</h2>
                    </div>
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
                            <div class="border border-gainsboro p-3 mt-3 clearfix item1">
                                <div class="text-lg-left">
                                    <img src="<?php echo $image; ?>" class="img-fluid rounded-start" style="width:100px" alt="...">
                                    <div class="remove-item pt-4">
                                        <a class="remove-product btn btn-danger btn-block" href='<?php echo './RemoveCart.php?d_id=' . $product['d_id'] . '&dtype=' . $product['type']; ?>' onclick=" return confirm('Are you sure you want to remove this dog from cart?');"><b>Remove</b></a>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-5 text-lg-left">
                                    <h3 class="h6 mb-0">Dog Name: <?php echo $product['name'] ?><br>
                                        <span>
                                            <p class="card-text">Breed: <?php echo $product['breed'] ?></p>
                                        </span>
                                        <small>Age: <?php echo $product['age'] ?></small>
                                    </h3>
                                </div>
                                <?php
                                if ($product['type'] == 'foster') { ?>
                                    <div>Payment: <?php echo $product['price'] ?></div>
                                <?php
                                }
                                ?>


                            </div>
                    <?php
                        }
                    }
                    ?>

                <?php
                }

                $userid = $_SESSION['user']['user_id'];
                $cartproduct = "SELECT * from `cart` WHERE (p_id!=0) and user_id='$userid'";

                $result = mysqli_query($conn, $cartproduct);
                $rows = mysqli_num_rows($result);
                if ($rows > 0) {


                ?>

                    <div class="border border-gainsboro p-3 mt-4">

                        <h2 class="h6 text-uppercase mb-0">Hired professionals</h2>
                    </div>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $productid = $row['p_id'];
                        $sql1 = "SELECT * from `professionals` WHERE `p_id`='$productid'";
                        $result1 = mysqli_query($conn, $sql1);
                        $num = mysqli_num_rows($result1);
                        if ($num > 0) {
                            $product = mysqli_fetch_assoc($result1);
                            $type = $product['type'];
                            if ($type == 'vet') {
                                $src = "../assets/professionals/vets/" . $product['photo'];
                            } elseif ($type == 'trainer') {
                                if ($product['check'] == 'request') {
                                    $src = "../assets/requests/trainer/" . $product['photo'];
                                } else {
                                    $src = "../assets/professionals/trainers/" . $product['photo'];
                                }

                                $form = "AdminTrainerForm.php";
                            } elseif ($type == 'caretaker') {
                                if ($product['check'] == 'request') {
                                    $src = "../assets/requests/caretaker/" . $product['photo'];
                                } else {
                                    $src = "../assets/professionals/caretakers/" . $product['photo'];
                                }
                            } elseif ($type == 'walker') {
                                if ($product['check'] == 'request') {
                                    $src = "../assets/requests/walker/" . $product['photo'];
                                } else {
                                    $src = "../assets/professionals/walkers/" . $product['photo'];
                                }
                            }
                            $image = !empty($product['photo']) ? $src  : "https://via.placeholder.com/150";
                    ?>
                            <div class="border border-gainsboro p-3 mt-3 clearfix item1">
                                <div class="text-lg-left">
                                    <img src="<?php echo $image; ?>" class="img-fluid rounded-start" style="width:100px" alt="...">
                                    <div class="remove-item pt-4">
                                        <a class="remove-product btn btn-danger btn-block" href='<?php echo './RemoveCart.php?p_id=' . $product['p_id']; ?>' onclick=" return confirm('Are you sure you want to remove this professional from cart?');"><b>Remove</b></a>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-5 text-lg-left">
                                    <h3 class="h6 mb-0">Name: <?php echo $product['name'] ?><br>
                                        <span>
                                            <p class="card-text">Job: <?php echo $product['type'] ?></p>
                                        </span>
                                        <small>Fee: <?php echo $product['fees'] ?></small>
                                    </h3>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                <?php
                }
                ?>

                </div>

                <div class="col-xl-3 col-lg-4 col-md-5 totals">
                    <div class="border border-gainsboro px-3">
                        <div class="border-bottom border-gainsboro">
                            <p class="text-uppercase mb-0 py-3"><strong>Products Order Summary</strong></p>
                        </div>
                        <div class="totals-item d-flex align-items-center justify-content-between mt-3">
                            <p class="text-uppercase">Subtotal</p>
                            <p class="totals-value" id="cart-subtotal"></p>
                        </div>
                        <div class="totals-item d-flex align-items-center justify-content-between">
                            <p class="text-uppercase">Estimated Tax</p>
                            <p class="totals-value" id="cart-tax"></p>
                        </div>
                        <div class="totals-item totals-item-total d-flex align-items-center justify-content-between mt-3 pt-3 border-top border-gainsboro">
                            <p class="text-uppercase"><strong>Total</strong></p>
                            <p class="totals-value font-weight-bold cart-total"></p>
                        </div>
                        <!-- Modal -->

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Order Placed!</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                        <h6>Estimated Delivery Date</h6>
                                        <div id="m-date"></div><br>

                                        <div class="totals-item totals-item-total d-flex align-items-center justify-content-between mt-3 pt-3 border-top border-gainsboro">
                                            <p class="text-uppercase"><strong>Total</strong></p>
                                            <p class="totals-value font-weight-bold cart-total"></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between" style="padding-left:0;">
                                        <h5 style="text-align:start">Thankyou for Shopping with us!</h5>

                                        <button type="button" class="btn btn-secondary" onclick="location.href='./MyOrders.php'">Close</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="border border-gainsboro px-3 mt-4">
                        <p class="text-uppercase mt-3">Note:</p>
                        <p>payment/yield will be done in person for Adopted or Fostered Dogs, Bought Dogs and Hired professionals.</p>
                    </div>
                    <div class="border border-gainsboro px-3 mt-4">
                        <form action="" method="get">
                            <label for="payment">Payment Option</label><br>
                            <input type="radio" id="credit" name="payment_method" value="Credit/Debit" checked>
                            <label for="credit">Credit/Debit</label><br>
                            <input type="radio" id="cod" name="payment_method" value="Cash on Delivery" ">
                            <label for=" cod">Cash on Delivery</label><br>
                        </form>

                    </div>
                    <a style="width:auto; color:white" type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Pay Now
                    </a>

                </div>





            </div>
    </div>
    </div>





    </div>
    </div><!-- container -->

    <script>
        //--------------
        //Estimated delivery date

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, "0"); // get the date padStart => 01
        var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
        var yyyy = today.getFullYear();
        var fullDate = dd + "." + mm + "." + yyyy;

        var someDate = new Date();
        var numberOfDaysToAdd = 4;
        someDate.setDate(someDate.getDate() + numberOfDaysToAdd);

        var dd = String(someDate.getDate()).padStart(2, "0");
        var mm = String(someDate.getMonth() + 1).padStart(2, "0");
        var y = someDate.getFullYear();

        var someFormattedDate = dd + "." + mm + "." + y;

        today = someFormattedDate;

        document.getElementById("m-date").innerHTML = today;


        $(document).ready(function() {

            /* Set rates + misc */
            var taxRate = 0.05;
            var fadeTime = 300;

            $('.pass-quantity input').change(function() {
                updateQuantity(this);
            });

            $('.remove-item button').click(function() {
                removeItem(this);
            });


            /* Recalculate cart */
            function recalculateCart() {
                var subtotal = 0;

                /* Sum up row totals */
                $('.item').each(function() {
                    subtotal += parseFloat($(this).children('.product-line-price').text());
                });

                /* Calculate totals */
                var tax = subtotal * taxRate;
                var total = subtotal + tax;

                /* Update totals display */
                $('.totals-value').fadeOut(fadeTime, function() {
                    $('#cart-subtotal').html(subtotal.toFixed(2));
                    $('#cart-tax').html(tax.toFixed(2));
                    $('.cart-total').html(total.toFixed(2));
                    if (total == 0) {
                        $('.checkout').fadeOut(fadeTime);
                    } else {
                        $('.checkout').fadeIn(fadeTime);
                    }
                    $('.totals-value').fadeIn(fadeTime);
                });

            }

            /* Update quantity */
            function updateQuantity(quantityInput) {
                /* Calculate line price */
                var productRow = $(quantityInput).parent().parent();
                var price = parseFloat(productRow.children('.product-price').text());
                var quantity = $(quantityInput).val();
                var linePrice = price * quantity;

                /* Update line price display and recalc cart totals */
                productRow.children('.product-line-price').each(function() {
                    $(this).fadeOut(fadeTime, function() {
                        $(this).text(linePrice.toFixed(2));
                        recalculateCart();
                        $(this).fadeIn(fadeTime);
                    });
                });
            }

            /* Remove item from cart */
            function removeItem(removeButton) {
                /* Remove row from DOM and recalc cart total */
                <?php

                ?>
                var productRow = $(removeButton).parent().parent();
                productRow.slideUp(fadeTime, function() {
                    productRow.remove();
                    recalculateCart();
                });
            }

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>