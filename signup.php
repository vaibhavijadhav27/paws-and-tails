<?php
error_reporting(0);
?>
<?php
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'DataBase/connection.php';
  $num1 = 0;
  $num2 = 0;
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $already = "Select * from `user` where phone='$phone'";
  $already1 = "Select * from `user` where email='$email'";
  $alreadyresult = mysqli_query($conn, $already);
  $num1 = mysqli_num_rows($alreadyresult);
  $already1result = mysqli_query($conn, $already1);
  $num2 = mysqli_num_rows($already1result);
  if (empty($name)) {
    $showError = "Please enter your Name !";
  } elseif (!empty($name) && !preg_match("/[a-zA-Z]+ [a-zA-Z]+$/", $name)) {
    $showError = "Please match the requested format for Name!";
  } elseif (empty($email)) {
    $showError = "Please enter your email id!";
  } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $showError = "Invalid Email ID!";
  } elseif (empty($phone)) {
    $showError = "Please enter your Phone Number!";
  } elseif (!empty($phone) && !preg_match("/^[0-9]{10}$/", $phone)) {
    $showError = "Invalid Phone Number!";
  } elseif (empty($password)) {
    $showError = "Please choose your password!";
  } elseif (empty($cpassword)) {
    $showError = "Please Retype the password to confirm the password!";
  } elseif (empty($address)) {
    $showError = "Please enter your address!";
  } elseif ($password != $cpassword) {
    $showError = "Passwords do not match";
  } else {

    if (($num1 == 0) && ($num2 == 0)) {
      $sql = "INSERT INTO `user` (`name`, `email`, `address`, `phone`, `password`,`profile`) VALUES ('$name', '$email', '$address', '$phone', '$password','user.png')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = true;
      } else {
        $showError = "something went wrong, Please try again later";
      }
      header("location: User/UserHomePage.html");
    } else {
      $showError = "User already registered";
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
  <title>Paws and Tails | Signup</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="./style/style.css" /> -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    section {
      padding: 60px 0;
    }

    #welcome {
      text-align: center;
      color: black;
      text-shadow: 2px 2px 2px rgb(104, 102, 107);
      padding-top: 5%;
      font-family: "Gochi Hand", cursive;
      font-size: 40px;
    }
  </style>
</head>

<body>
  <?php
  if ($showError) {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
  }
  ?>
  <h1 id="welcome">Welcome to Paws and Tails!</h1>
  <section id="contact">
    <div class="container-lg">

      <div class="text-center">
        <h2>Sign Up</h2>
        <p class="lead">Already have an account? <a href="./login.php">Login here</a> </p>
      </div>
      <div class="row justify-content-center my-5">
        <div class="col-lg-6">

          <form action="./signup.php" method="post">
            <label for="name" class="form-label">Full Name:</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <i class="bi bi-person-fill text-secondary"></i>
              </span>
              <input type="text" id="name" name="name" class="form-control" placeholder="Firstname Surname ">
            </div>
            <label for=" email" class="form-label">Email address:</label>
            <div class="input-group mb-4">
              <span class="input-group-text">
                <i class="bi bi-envelope-fill text-secondary"></i>
              </span>
              <input type="text" id="email" name="email" class="form-control" placeholder="e.g. email@example.com">
            </div>
            <label for="phone" class="form-label">Phone Number</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <i class="bi bi-telephone-fill text-secondary"></i>
              </span>
              <input class="form-control" type="text" id="phone" name="phone" placeholder="eg. 9652XXXXX0">
            </div>
            <label for="password" class="form-label">Password</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <i class="bi bi-key-fill text-secondary"></i>
              </span>
              <input required type="password" class="form-control" id="password" name="password" placeholder="Choose your password">
            </div>
            <label for="password" class="form-label">Confirm Password</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <i class="bi bi-check-circle-fill text-secondary"></i>
              </span>
              <input required type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-type the password">
            </div>
            <label for="address" class="form-label">Address:</label>
            <div class="input-group mb-4">
              <span class="input-group-text">
                <i class="material-icons text-secondary">place</i>
              </span>
              <textarea required class="form-control" name="address" id="address" rows="4"></textarea>

            </div>
            <div class="mb-4 text-center">
              <button type="submit" class="btn btn-secondary">Create an Account</button>
            </div>
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