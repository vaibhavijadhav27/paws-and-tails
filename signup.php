<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './DataBase/connection.php';
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists=false;
    if(($password == $cpassword) && $exists==false){
        $sql = "INSERT INTO `user` (`name`, `email`, `address`, `phone`, `password`,`profile`) VALUES ('$name', '$email', '$address', '$phone', '$password', 'C:\\xampp\\htdocs\\Paws and Tails\\assets\\user.png')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
        }
    }
    else{
        $showError = "Passwords do not match";
    }
}
    
?>
<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './Database/connection.php';
    $username = $_POST["email"];
    $password = $_POST["password"]; 
    
     
    $sql = "Select * from `user` where email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("location: AdminHome.html");

    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paws and Tails | Login/Signup</title>
    <link rel="stylesheet" href="./style/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow&display=swap"
      rel="stylesheet"
    />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous"> -->
  </head>

  <body>
  
    <div class="contain">
      <h1 id="welcome">Welcome to Paws and Tails!</h1>
      <div class="wrapper">
        <div class="login">
          <h1>Login</h1>
          <form action="./login.php" method="post">
            <div class="row">
              <div class="col-25">
                <label for="email">Email id</label>
              </div>
              <div class="col-60">
                <input
                  type="email"
                  id="email"
                  name="email"
                  placeholder="Enter your email"
                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                  oninvalid="setCustomValidity('Please enter your email id correctly. ')"
                /><br />
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="password">Password</label>
              </div>
              <div class="col-60">
                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="Enter your password"
                /><br />
              </div>
            </div>
            <br /><br />
            
            <div class="row">
              <input type="submit" value="Login" />
            </div>
          </form>
        </div>

        <div class="vl"></div>
        <div class="signup">
          <h1>Sign Up</h1>
          <div class="container">
            <form action="signup.php" method="post">
              <div class="row">
                <div class="col-25">
                  <label for="text">Name</label>
                </div>
                <div class="col-60">
                  <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="firstname lastname"
                    pattern="[a-zA-Z]+ [a-zA-Z]+$"
                    oninvalid="setCustomValidity('Please enter on alphabets only and match the requested format. ')"
                  /><br />
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="email">Email id</label>
                </div>
                <div class="col-60">
                  <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    oninvalid="setCustomValidity('Please enter your email id correctly. ')"
                  /><br />
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="password">Password</label>
                </div>
                <div class="col-60">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Choose your password"
                  /><br />
                </div>
              </div>
              <div class="row">
              <div class="col-25">
                <label for="cpassword">Confirm Password</label>
              </div>
              <div class="col-60">
                <input
                  type="password"
                  id="cpassword"
                  name="cpassword"
                  placeholder="Confirm Password"
                /><br />
              </div>
            </div>
            
              <div class="row">
                <div class="col-25">
                  <label for="Phone Number">Phone Number</label>
                </div>
                <div class="col-60">
                  <input
                    type="text"
                    id="phone"
                    name="phone"
                    placeholder="eg. 9652XXXXX0"
                    maxlength="10"
                    minlength="10"
                  /><br />
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="Address">Address</label>
                </div>
                <div class="col-60">
                  <textarea
                    name="address"
                    id="address"
                    cols="21"
                    rows="5"
                  ></textarea>
                  <br /><br />
                </div>
              </div>

              <br />
              <div class="row">
                <input type="submit" value="Sign Up" />
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>