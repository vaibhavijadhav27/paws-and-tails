<?php
error_reporting(0);
?>
<?php
$showError="";
$targetDir = "products/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$product = $_POST["productname"];
  $brand = $_POST["brand"];
  $price = $_POST["price"];
  $desc = $_POST["description"];
  $sql = "INSERT INTO `dog_products` (`Name`, `Brand`,`Quantity`,`Price`, `Description`,`Photo`,`product_id`,`post_id`) VALUES ('$productname', '$brand','', '$price', '$description','".$fileName."','','')";
if(isset($_POST['submit']) && !empty($_FILES["file"]["name"])){
  include ('DataBase/connection.php');
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            
      $result = mysqli_query($conn, $sql);
      if ($result){
          $showAlert = true;
      }
      // header("location: ./productadded.html");
  else{
    $showError="There was some problem uploading, please try again later." ;
  }
            
      }
    }
 
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paws and Tails | Home</title>
    <!-- <link rel="stylesheet" href="style/style.css" /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c558ff8c9.js" crossorigin="anonymous"></script>
    <style>
    section {
      padding: 60px 0;
    }
    body{
      background-color: #e3f2fdbd
    }
    header h1 {
  color: black;
  text-shadow: 2px 2px 2px rgb(104, 102, 107);
  padding-top: 10px;
  padding-left: 30px;
  font-family: "Gochi Hand", cursive;
  font-size: 40px;
}
.material-icons.md-18 { font-size: 18px; }
.material-icons.md-24 { font-size: 24px; }
.material-icons.md-36 { font-size: 36px; }
.material-icons.md-48 { font-size: 48px; }
  </style>
  </head>
  <body>
    <header>
      <h1>Paws and Tails</h1>
    </header>
    
    <section id="contact">
    <div class="container-lg">

      <div class="text-center">
        <h2>Add Product</h2>

      </div>
      <div class="row justify-content-center my-5">
        <div class="col-lg-6">

          <form action="./AdminAddProductForm.php" method="post" enctype="multipart/form-data">
            <label for="productname" class="form-label">Name of the Product:</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
              <!-- <i class="material-icons text-secondary md-18">sell</i> -->
              
              <i class="fas fa-bone text-secondary"></i>
              </span>
              <input type="text" id="productname" name="productname" class="form-control" placeholder="e.g. Dog food" />
            </div>
            <label for="brand" class="form-label">Brand:</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <i class="bi bi-award-fill text-secondary"></i>
              </span>
              <input type="text" id="brand" name="brand" class="form-control" placeholder="e.g. Pedigree"/>
            </div>
                       
            <label for="price" class="form-label">Pricing Details:</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
              <i class="material-icons md-18 text-secondary">
currency_rupee
</i>
              </span>
              <input class="form-control" type="text" id="price" name="price" pattern="\d+" placeholder="e.g. &#8377; 300"
                />
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
              <input class="form-control custom-file-input" type="file" id="file" name="file" required>
              
            </div>
              
            
            <label for="description" class="form-label">Description:</label>
            <div class="input-group mb-4">
              <span class="input-group-text">
              <i class="material-icons text-secondary md-18">description</i>
              </span>
              <textarea class="form-control" name="description" id="description" rows="5"></textarea>

            </div>
            </div>

        <div class="mb-4 text-center">
          <input type="submit" class="btn btn-secondary" name="submit" value="Add Product">
        </div>

        </form>
      </div>
    </div>
    </div>
  </section>

    
  </body>
</html>