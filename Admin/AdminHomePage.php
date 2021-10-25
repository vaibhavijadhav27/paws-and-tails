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
            <a class="nav-link active" aria-current="page" href="./AdminHomePage.php">Home</a>
          </li>
          <li class="nav-item px-3">
            <a class="nav-link  " href="./AdminProducts.php">Products</a>
          </li>

          <li class="nav-item px-3">
            <a class="nav-link " href="./AdminGYD.php">Get a dog</a>
          </li>
          <li class="nav-item px-3">
            <a class="nav-link " href="./AdminHT.html">Health and Train</a>
          </li>
          <li class="nav-item px-3">
            <a class="nav-link" href="./AdminAccount.php"> <i class="material-icons text-secondary md-24">account_circle</i>
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
  <img src="../assets/home.png" style="width:100%; margin-top:2%;margin-bottom:2%">
  <?php
  session_start();
  if (!empty($_SESSION['admin'])) {
    $productsql = "select * from `dog_products` order by dproduct_id DESC LIMIT 3";
    include('../DataBase/connection.php');
    $result = mysqli_query($conn, $productsql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {


  ?>
      <h3>What's New?</h3>
      <div class="wrapper" style="position: relative; width:1000px;top:10%;left:15% ;">

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
          $image = !empty($row['photo']) ? "../assets/products/" . $row['photo'] : "https://via.placeholder.com/50.png/09f/666";

        ?>

          <div class="card" style="width: 15em;">
            <img src="<?php echo $image; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Product: <?php echo $row['name'] ?></h5>
              <p class="card-text">Brand: <?php echo $row['brand'] ?></p>
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

  <h3 style="position: relative; width:1000px;top:30%;left:5% ;"> Educate yourself with useful blogs</h3>
  <?php
  if (!empty($_SESSION['admin'])) {
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
  }
  ?>
  <div class="position-fixed bottom-0 end-0 m-4 bg-light">
    <button class="btn btn-outline-secondary p-2" onclick="location.href = './AdminAddBlogForm.php'">Add Blog</button>
  </div>


</body>

</html>