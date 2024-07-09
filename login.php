
<?php
include 'connection.php'; // Ensure this file includes MySQL connection code
session_start(); // Start the session

$userName = $Password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userName = $_POST['userName'];
  $Password = $_POST['Password'];

  // Create a prepared statement for checking admin
  $stmtAdmin = $conn->prepare("SELECT customer_id, userName, Password FROM customers WHERE userName = ? AND is_admin = 1");
  $stmtAdmin->bind_param("s", $userName);
  $stmtAdmin->execute();
  $resultAdmin = $stmtAdmin->get_result();

  if ($resultAdmin->num_rows > 0) {
    $rowAdmin = $resultAdmin->fetch_assoc();
    if ($Password == $rowAdmin['Password']) { // Compare plain passwords directly
      // Redirect admin to addPackages.php
      $_SESSION["id"] = $rowAdmin["customer_id"];
      $_SESSION["is_admin"] = true;
      header('Location: addPackages.php');
      exit;
    } else {
      $password_err = "Invalid password for admin";
      echo "<script>alert('Invalid username or password.');</script>";
    }
  } else {
    // Create a prepared statement for checking regular users
    $stmtCustomer = $conn->prepare("SELECT customer_id, userName, Password FROM customers WHERE userName = ? AND (is_admin IS NULL OR is_admin = 0)");
    $stmtCustomer->bind_param("s", $userName);
    $stmtCustomer->execute();
    $resultCustomer = $stmtCustomer->get_result();

    if ($resultCustomer->num_rows > 0) {
      $rowCustomer = $resultCustomer->fetch_assoc();
      if ($Password == $rowCustomer['Password']) { // Compare plain passwords directly
        // Redirect regular user to package.php
        $_SESSION["id"] = $rowCustomer["customer_id"];
        $_SESSION["is_admin"] = false;
        header('Location: package.php');
        exit;
      } else {
        $password_err = "Invalid password";
        echo "<script>alert('Invalid username or password.');</script>";
     }
    } else {
      $username_err = "User not found";
      echo "<script>alert('Invalid username or password.');</script>";
    }
  }

  $stmtAdmin->close();
  $stmtCustomer->close();
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style2.css">
    <style>

.header .icons a{
    font-size: 1.7rem;
    color: #fff;
    cursor: pointer;
    margin-right: 1.5rem;
}
.header .icons a:hover{
    color: var(--main-color);
}  
 
.login-container{
    height: 100vh;
    width: 100%;
    background-image: linear-gradient(rgba(141, 141, 237, 0.8), rgba(143, 143, 241, 0.8)), url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
    background-size:cover;
    background-position: center;
}

.form-box{
    border-radius: 24px;
    width: 90%;
    max-width: 450px;
    position: absolute;
    top:50%;
    left:50%;
    transform: translate(-50%,-40%);
     background: white;
    padding: 50px 60px 70px; 
    text-align:center;
}

.form-box h1{
    font-size: 2.2rem;
    margin-bottom:20px;
    color:#3c00a0;
    position: relative;
}

.form-box h1::after{
    content: '';
    width: 50px;
    height: 4px;
    border-radius: 3px;
    background:rgb(128, 79, 128) ;
    position:absolute;
    bottom:-12px;
    left:50%;
    transform: translateX(-50%);

}

.input-field{
    background: #eaeaea;
    margin:15px 0px;
    border-radius: 3px;
    display: flex;
    align-items: center;
    max-height: 65px;
    transition: max-height 0.5s;
    overflow: hidden;
}
.input-field i {
    margin-left: 15px;
}
input{
    width:100%;
    background: transparent;
    border: 0;
    outline: 0;
    padding: 19px 20px;
}
form p{
    text-align:left;
    font-size: 15px;
}
form p a {
    text-decoration: none;
    color: #3c00a0;
}
.btn-field{
    width: 100%;
    margin-top: 10px;
    padding: 10px 0px;
    display: grid;
    text-align: center;
    
}
.btn-field button{
    text-align: center;
    height: 4rem;
    width: 10rem;
    flex-basis: 60%;
    background: #3c00a0;
    color: #fff;
    border-radius: 25px;
    cursor: pointer;
    
}
.case{
    text-transform: lowercase;
}
    </style>
</head>
<body >
    
<section class="header">
    <a href="home.php" class="logo"><h3>TOURMANDU</h3> </a>
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="about.php">About</a>
        <a href="package.php">Package</a>
        <a href="book.php">Book</a>
    </nav>
    <div class="icons">
        <a href="login.php"><i class="fas fa-user-circle"></i>Login</a>
        <!-- <a href="admin.php"><i class="fas fa-user-alt"></i>Admin</a> -->
        
        
    </div>

    <div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="login-container">
<div class="form-box">
            <h1 id="title">
                Login
            </h1>
        <form action="login.php" method="POST"  id="myForm">

                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="case" name="userName" id="userName" placeholder="username" required>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="Password" id="Password" placeholder="password" required>
                    </div>
                </div>
                
                <div class="btn-field">
                   <button type="submit" id="login">Login</button> 
                </div>
                 <h3><a href="#">Forget Password?</a></h3>
                <h3>don't have account?<a href="register.php"> Create account.</a></h3>
            </form>
        <p id="error-message" class="error-message" style="color: red;"></p>
    </div>
    </div>



 
<section class="footer">
    <div class="box-container">
    <div class="box">
        <h3>quick links</h3>
        <a href="home.php"><i class="fas fa-angle-right"></i> Home</a>
        <a href="about.php"><i class="fas fa-angle-right"></i> About</a>
        <a href="package.php"><i class="fas fa-angle-right"></i> Package</a>
        <a href="book.php"><i class="fas fa-angle-right"></i> Book</a>
    </div>
    <div class="box">
        <h3>extra links</h3>
        <a href="#"><i class="fas fa-angle-right"></i> ask questtions</a>
        <a href="#"><i class="fas fa-angle-right"></i> about us</a>
        <a href="#"><i class="fas fa-angle-right"></i> privacy policy</a>
        <a href="#"><i class="fas fa-angle-right"></i> terms of use</a>
    </div>
    <div class="box">
        <h3>contact info</h3>
        <a href="#"><i class="fas fa-phone"></i> +977 9849426293</a>
        <a href="#"><i class="fas fa-envelope"></i> stharajesh662@gmail.com</a>
        <a href="#"><i class="fas fa-map"></i> Bagmati Province, Kathmandu, Nepal</a>
    </div>

    <div class="box">
        <h3>follow us</h3>
        <a href="#"><i class="fab fa-facebook-f"></i> facebook</a>
        <a href="#"><i class="fab fa-twitter"></i> twitter</a>
        <a href="#"><i class="fab fa-instagram"></i> instagram</a>
        <a href="#"><i class="fab fa-linkedin"></i> linkedin</a>
    </div>

    </div>

    <div class="credit">created by <span>mr. amir shrestha</span> | all right reserved!</div>
</section>  


    
</body>
</html>

