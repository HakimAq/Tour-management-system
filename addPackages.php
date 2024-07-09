<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Create the uploads directory if it doesn't exist
  $upload_dir = 'uploads/';
  if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
  }

  // Handle the uploaded file
  $target_file = $upload_dir . basename($_FILES["image"]["name"]);
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // File successfully uploaded
    $image = $target_file;
  } else {
    echo "Error uploading file.";
    exit;
  }

  // Get the other form values
  $location = $_POST["location"];
  $duration = $_POST["duration"];
  $price = $_POST["price"];

  // Prepare the SQL query
  $query = "INSERT INTO package(image, location, duration, price) VALUES (?, ?, ?, ?)";

  // Prepare the statement
  if ($stmt = $conn->prepare($query)) {
    // Bind parameters
    $stmt->bind_param("ssss", $image, $location, $duration, $price);

    // Execute the statement
    if ($stmt->execute()) {
      include('package_list.php');
      exit;
    } else {
      // Display an error message if the query fails
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
    <title>Add Packages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style2.css">
    <style>
        .container {
            height: 100vh;
            width: 100%;
            background-image: linear-gradient(rgba(100, 100, 237, 0.8), rgba(300, 143, 241, 0.8)), url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
            background-size: cover;
            background-position: center;
        }
        .header .icons a {
            font-size: 1.7rem;
            color: #fff;
            cursor: pointer;
            margin-right: 1.5rem;
        }
        .header .icons a:hover {
            color: var(--main-color);
        }
        .form {
            border-radius: 24px;
            width: 90%;
            max-width: 450px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -40%);
            background: lightblue;
            padding: 50px 60px 70px;
            text-align: center;
            font-size: 15px;
        }
        .form-box {
            width: 100%;
            background: transparent;
            border: 0;
            outline: 0;
            padding: 19px 20px;
        }
        .btn {
            background-color: var(--main-color);
        }
        .image-preview {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<section class="header">
    <a href="home.php" class="logo"><h3>TOURMANDU</h3></a>
    <nav class="navbar">
        <a href="addPackages.php">Add Package</a>
        <a href="package_list.php">Package Information</a>
        <a href="user_list.php">User Information</a>
        <a href="booked.php">package booked</a>
    </nav>
    <div class="icons">
        <a href="login.php"><i class="fas fa-sign-out"></i>Logout</a>
    </div>
    <div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="container">
    <div class="form">
        <h1>Add Packages</h1>
        <form class="form-box" method="post" enctype="multipart/form-data">
            <label for="image">Image*:</label>
            <input type="file" id="image" name="image" required><br><br>
            <div class="image-preview" id="imagePreview">
                <img src="" alt="Image Preview" class="image-preview__image" style="display: none; width: 100%; height: auto;"/>
                <span class="image-preview__default-text">Image Preview</span>
            </div><br><br>

            <label for="location">Location*:</label>
            <input type="text" id="location" name="location" required><br><br>

            <label for="duration">Time Duration*:</label>
            <input type="text" name="duration"  required><br><br>


            <label for="price">Price*:</label>
            <input type="number" id="price" name="price" required><br><br>

            <button type="submit" src='package_list.php'  class="btn">Add</button><br><br>
        </form>
    </div>
</div>

<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick Links</h3>
            <a href="home.php"><i class="fas fa-angle-right"></i> Home</a>
            <a href="about.php"><i class="fas fa-angle-right"></i> About</a>
            <a href="package.php"><i class="fas fa-angle-right"></i> Package</a>
            <a href="book.php"><i class="fas fa-angle-right"></i> Book</a>
        </div>
        <div class="box">
            <h3>Extra Links</h3>
            <a href="#"><i class="fas fa-angle-right"></i> Ask Questions</a>
            <a href="#"><i class="fas fa-angle-right"></i> About Us</a>
            <a href="#"><i class="fas fa-angle-right"></i> Privacy Policy</a>
            <a href="#"><i class="fas fa-angle-right"></i> Terms of Use</a>
        </div>
        <div class="box">
            <h3>Contact Info</h3>
            <a href="#"><i class="fas fa-phone"></i> +977 9849426293</a>
            <a href="#"><i class="fas fa-envelope"></i> stharajesh662@gmail.com</a>
            <a href="#"><i class="fas fa-map"></i> Bagmati Province, Kathmandu, Nepal</a>
        </div>
        <div class="box">
            <h3>Follow Us</h3>
            <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>
    </div>
    <div class="credit">Created by <span>Mr. Amir Shrestha</span> | All rights reserved!</div>
</section>

<script>
document.getElementById("image").addEventListener("change", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        const preview = document.querySelector(".image-preview__image");
        const previewDefaultText = document.querySelector(".image-preview__default-text");

        reader.addEventListener("load", function() {
            preview.setAttribute("src", this.result);
            preview.style.display = "block";
            previewDefaultText.style.display = "none";
        });

        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>
