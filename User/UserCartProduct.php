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
    $value = isset($_POST['item']) ? $_POST['item'] : 1; //to be displayed
    $cartproduct = "SELECT * from `cart` WHERE (dproduct_id!=0) and user_id='$userid'";
    $value = 1;
    $result = mysqli_query($conn, $cartproduct);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {


    ?>
        <div class="wrap container-md" style="position: absolute;
  left: 2%;
  top: 5%;">
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
                    <div class="container-md">
                        <a href="<?php echo 'UserViewProduct.php?id=' . $productid; ?>" style="text-decoration: none; color: inherit;">
                            <div class="card mb-3" style="width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="row g-0 m-3">
                                            <img src="<?php echo $image; ?>" class="img-fluid rounded-start" style="width:300px" alt="...">
                                        </div>
                                        <div class="row g-0 m-4">
                                            <a class="btn btn-danger" href='<?php echo 'RemoveCart.php?id=' . $row['dreq_id'] . '&type=' . $type; ?>' onclick="return confirm('Are you sure you want to remove this?')" ;>Remove</a>

                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Product: <?php echo $product['name'] ?></h5>
                                            <p class="card-text">Brand: <?php echo $product['brand'] ?></p>


                                            <p class="card-text product-line-price">Price: <?php echo number_format($product['price']); ?> each</p>
                                            <div class="pass-quantity col-lg-3 col-md-4 col-sm-3">
                                                <label for="pass-quantity" class="pass-quantity">Quantity</label>
                                                <input class="form-control" type="number" value="1" min="1">
                                            </div>
                                            <p class="totals-value cart-total"></p>
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
    <script>
        $(document).ready(function() {

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
                var total = subtotal

                /* Update totals display */
                $('.totals-value').fadeOut(fadeTime, function() {
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
                var productRow = $(removeButton).parent().parent();
                productRow.slideUp(fadeTime, function() {
                    productRow.remove();
                    recalculateCart();
                });
            }

        });
    </script>
</body>

</html>