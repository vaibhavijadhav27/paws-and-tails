<?php
session_start();
$productID = $_GET['id'];
if (!empty($productID) && is_numeric($productID)) {
    include('../DataBase/connection.php');
    $sql = "select * from `professionals` where `p_id`= $productID";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        $product = mysqli_fetch_assoc($result);
        $type = $product['type'];
        if ($type == 'vet') {
            $src = "../assets/professionals/vets/" . $product['photo'];
            $form = "AdminVetForm.php";
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
            $form = "AdminCaretakerForm.php";
        } elseif ($type == 'walker') {
            if ($product['check'] == 'request') {
                $src = "../assets/requests/walker/" . $product['photo'];
            } else {
                $src = "../assets/professionals/walkers/" . $product['photo'];
            }
            $form = "AdminWalkerForm.php";
        }
    } else {
        echo "Professional doesn't exist";
        exit();
    }
} else {
    echo "Invalid professional";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws and Tails</title>
    <!-- CSS -->
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


    <main role="main" class="container">
        <div class="row justify-content-center wrapper">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <header class="card-header">
                        <i class="bi bi-x text-secondary" style="font-size:40px; cursor:pointer; float: right; text-shadow:none;" onclick="history.go(-1);"></i>

                        <h4 class="card-title mt-2">Professional Detail</h4>
                    </header>
                    <article class="card-body">
                        <div class="container" id="profile">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img style=" width:300px" src="<?php echo $src; ?>" />
                                </div>
                                <div class="col-sm-6 col-md-8 " style="padding-left:20%">
                                    <p class="text-secondary"><i class="bi bi-person-fill text-secondary" style="font-size:18px !important; margin-right:8px;"></i>Name: <?php echo $product['name'] ?></p>
                                    <p class="text-secondary">
                                        <i class="material-icons text-secondary md-18" style="font-size:18px !important; margin-right:8px;">cake</i>Age: <?php echo $product['age'] ?>

                                    </p>
                                    <p class="text-secondary">
                                        <i class="material-icons text-secondary md-18" style="font-size:18px !important; margin-right:8px !important;">stars</i>Experience: <?php echo $product['experience'] ?>

                                    </p>
                                    <p class="text-secondary">
                                        <i class="fas fa-rupee-sign text-secondary" style="font-size:18px !important; margin-right:8px;"></i>Fee: <?php echo $product['fees'] ?>

                                    </p>
                                    <p class="text-secondary">
                                        <i class="fas fa-file-alt text-secondary" style="font-size:18px !important; margin-right:8px;"></i>Description: <?php echo $product['description'] ?>
                                    </p>
                                    <!-- Split button -->
                                    <a class=" btn btn-success btn-block" href='<?php echo 'AddToCart.php?p_id=' . $row['p_id']; ?>'><b>Add to Cart</b></a>
                                </div>
                            </div>

                        </div>
                    </article>

                </div>
            </div>

        </div>

    </main>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>