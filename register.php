<?php
include 'connection.php'; // Ensure this file includes MySQL connection code

// Define variables and initialize with empty values
$Name = $Address = $phoneNumber = $Email = $userName = $Password = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Name = $_POST['Name'];
  $Address = $_POST['Address'];
  $phoneNumber = $_POST['phoneNumber'];
  $Email = $_POST['Email'];
  $userName = $_POST['userName'];
  $Password = $_POST['Password'];

  // Validate and prepare the SQL query
  $query = "INSERT INTO customers (Name, Address, phoneNumber, Email, userName, Password) 
              VALUES (?, ?, ?, ?, ?, ?)";

  // Prepare the statement
  if ($stmt = $conn->prepare($query)) {
    // Bind parameters
    $stmt->bind_param("ssssss", $Name, $Address, $phoneNumber, $Email, $userName, $Password);

    // Execute the statement
    if ($stmt->execute()) {
      echo "Data stored successfully"; // Add this for debugging

      // Registration successful, redirect to login page
      header("location: login.php");
      exit;
    } else {
      echo "Error executing statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
  } else {
    echo "Error preparing statement: " . $conn->error;
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="script1.js">
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
                Register
            </h1>
        <form action="register.php" method="POST"  id="myForm">

                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text"  name="Name" placeholder="Full Name" pattern="[A-Za-z]+\s[A-Za-z]+" title="Please enter at least two words (name and surname)" required>
                    </div>
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-map-marker-alt"></i>
                        <input type="text"  name="Address" placeholder="Address"  required>
                    </div>
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email"  name="Email" placeholder="Email" pattern="[a-zA-Z._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"  required>
                    </div>
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-phone"></i>
                        <input type="text"  name="phoneNumber" placeholder="Phone Number" pattern="[9][7-8][0-9]{8}" title="Please enter a 10-digit number" required>
                    </div>
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user-circle"></i>
                        <input type="text"  name="userName" placeholder="Username"  pattern="[A-Za-z][A-Za-z0-9]*" title="Username must start with a letter and can contain letters and numbers" required>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="Password" placeholder="Password" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()]).{8,}" title="" required>
">
                    </div>
                </div>

                <div>
                <label for="check">i agree to all<a href="#"> term & condition. </a></label>
                    <input type="checkbox" name="check" id="check">
                    
                </div>
                
                <div class="btn-field">
                <button type="submit" id="login">Signup</button>
                </div>
                <h3>already have a account? <a href="login.php">Login</a></h3>
            </form>
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
