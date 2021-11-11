<?php
error_reporting(0);
ob_start();
session_start();
$productID = !empty($_GET['id']) ? $_GET['id'] : '';
if (!empty($productID) && is_numeric($productID)) {
  include('../DataBase/connection.php');
  $sql = "select * from `dog_products` where `dproduct_id`= $productID";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
  if ($rows > 0) {
    $productR = mysqli_fetch_assoc($result);
  } else {
    echo "Product doesn't exist";
    exit();
  }
}

$productName = (!empty($productR) && !empty($productR['name'])) ? $productR['name'] : '';
$brandName = (!empty($productR) && !empty($productR['brand'])) ? $productR['brand'] : '';
$productPrice = (!empty($productR) && !empty($productR['price'])) ? $productR['price'] : '';
$productDesc = (!empty($productR) && !empty($productR['description'])) ? $productR['description'] : '';



$showError = false;
if (isset($_POST) && !empty($_FILES)) {
  $product = $_POST["productname"];
  $brand = $_POST["brand"];
  $price = $_POST["price"];
  $desc = $_POST["description"];
  $photo = !empty($_FILES['photo']) ? $_FILES['photo'] : [];
  $pid = !empty($_POST['pid']) ? $_POST['pid'] : '';
  if (empty($product)) {
    $showError = "Product name cannot be empty!";
  } elseif (empty($brand)) {
    $showError = "Brand name cannot be empty!";
  } elseif (empty($price)) {
    $showError = "Price cannot be empty!";
  } elseif (empty($desc)) {
    $showError = "Description cannot be empty!";
  } else {

    // --------------
    $photoName = '';
    if (!empty($photo['name'])) {
      $fileTempPath = $photo['tmp_name'];
      $fileName = $photo['name'];
      $fileNameCmp = explode('.', $fileName);
      $fileExtension = strtolower(end($fileNameCmp));
      $fileNewName = $fileName . $fileExtension;
      $photoName = $fileName;

      $allowed = ['jpg', 'jpeg', 'png'];
      if (in_array($fileExtension, $allowed)) {
        $uploadFileDir = "../assets/products/";
        $destFilePath = $uploadFileDir . $photoName;
        if (!move_uploaded_file($fileTempPath, $destFilePath))
          $showError = "Picture couldn't be uploaded";
      } else {
        $showError = "Invalid file format";
      }
    }
    // ----------------------
    // else {
    //   $targetDir = "../assets/products/";
    //   $fileName = basename($_FILES["photo"]["name"]);
    //   $targetFilePath = $targetDir . $fileName;
    //   $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    //   $allowTypes = array('jpg', 'png', 'jpeg');
    //   if (in_array($fileType, $allowTypes)) {
    //     // Upload file to server
    //     if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
    //       include('../DataBase/connection.php');
    //----------------
    if (!empty($pid)) {
      if (!empty($photoName)) {

        $sql = "UPDATE `dog_products` SET name = '{$product}', brand = '{$brand}',  price = '{$price}', description = '{$desc}',photo='{$photoName}' WHERE dproduct_id = {$pid}";
        $message = 'Product Updated';
      } else {
        $sql = "UPDATE `dog_products` SET name = '{$product}', brand = '{$brand}', price= '{$price}', description = '{$desc}'  WHERE dproduct_id = {$pid}";
        $message = 'Product Updated';
      }
    } else {

      $sql = "INSERT INTO `dog_products` (`name`, `brand`, `price`, `description`, `photo`) VALUES ('$product', '$brand', '$price', '$desc','$photoName')";

      $message = 'New product added';
    }
    include('../DataBase/connection.php');
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $showAlert = true;
      $showError = false;
    } else {
      $showError = "There was some problem, please try again later.";
    }
    //---------------------
    //   }
    // } else {
    //   $showError = "Invalid file format!";
    // }
    // }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Paws and Tails | Add Products</title>
  <!-- <link rel="stylesheet" href="style/style.css" /> -->
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
      <a href="AdminHomePage.php" style="text-decoration:none !important; color:inherit">Paws and Tails</a>
      <i class="bi bi-x text-secondary" style="font-size:40px; cursor:pointer; float: right; text-shadow:none;" onclick="history.go(-1);"></i>
    </h1>
  </header>



  <?php
  if ($showAlert == true) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>' . $message . '!
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div> ';
    header("refresh: 2; url = ./AdminProducts.php");
  }
  if ($showError) {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div> ';
  }
  ?>
  <section id=" contact" style="padding:0">
    <div class="container-lg">
      <div class="text-center">
        <h2>Add Product</h2>
      </div>
      <div class="row justify-content-center my-5">
        <div class="col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">
            <label for="productname" class="form-label">Name of the Product:</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <!-- <i class="material-icons text-secondary md-18">sell</i> -->
                <i class="fas fa-bone text-secondary"></i>
              </span>
              <input type="text" id="productname" name="productname" value="<?php echo $productName ?>" class="form-control" placeholder="e.g. Dog food" />
            </div>
            <label for="brand" class="form-label">Brand:</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <i class="bi bi-award-fill text-secondary"></i>
              </span>
              <input type="text" id="brand" name="brand" value="<?php echo $brandName ?>" class="form-control" placeholder="e.g. Pedigree" />
            </div>
            <label for="price" class="form-label">Pricing Details:</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <i class="material-icons md-18 text-secondary">
                  currency_rupee
                </i>
              </span>
              <input class="form-control" type="text" id="price" name="price" value="<?php echo $productPrice ?>" placeholder="e.g. &#8377; 300" />
            </div>
        </div>
        <div class="col-lg-6">
          <label class="custom-file-label form-label" for="file">Add a Picture:</label>
          <div class="custom-file mb-4 input-group">
            <span class="input-group-text">
              <i class="material-icons md-18 text-secondary">
                add_a_photo
              </i>
            </span>
            <input class="form-control custom-file-input" type="file" id="photo" name="photo">
          </div>
          <label for="description" class="form-label">Description:</label>
          <div class="input-group mb-4">
            <span class="input-group-text">
              <i class="material-icons text-secondary md-18">description</i>
            </span>
            <textarea class="form-control" name="description" id="description" rows="5"><?php echo $productDesc ?></textarea>
          </div>
        </div>
        <div class="mb-4 text-center">
          <input type="hidden" name="pid" value="<?php echo $productID; ?>" />
          <input type="submit" class="btn btn-secondary" name="submit" value="Add Product" onclick="location:'./AdminAddProductForm.php'">
        </div>
        </form>
      </div>
    </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>