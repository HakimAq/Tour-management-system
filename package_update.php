<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM package WHERE ID = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $image = $row['image'];
        $location = $row['location'];
        $duration = $row['duration'];
        $price = $row['price'];
    } else {
        echo "<script>alert 'Package record not found.'</script>";
        exit;
    }
}

if (isset($_POST['submit'])) {
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // Check if a new image was uploaded
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        // Ensure the uploads directory exists
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Update the package with the new image
            $query = "UPDATE package SET image='$image', location='$location', duration='$duration', price='$price' WHERE ID='$id'";
        } else {
            echo "Error uploading the image.";
            exit;
        }
    } else {
        // Update the package without changing the image
        $query = "UPDATE package SET location='$location', duration='$duration', price='$price' WHERE ID='$id'";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        // include('package_list.php');
    } else {
        echo "Error updating package: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Packages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style2.css">
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
</section>
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
</style>

<div class="container">
    <div class="form">
        <h1>Update Packages</h1>
        <form class="form-box" method="post" enctype="multipart/form-data">
            <label for="image">Current Image:</label><br>
            <img src="uploads/<?php echo htmlspecialchars($image); ?>" alt="Current Image" width="60%" height="50%"><br><br>

            <label for="image">New Image:</label>
            <input type="file" id="image" name="image"><br><br>
            <div class="image-preview" id="imagePreview">
                <img src="" alt="Image Preview" class="image-preview__image" style="display: none; width: 65%; height: 60%;"/>
                <span class="image-preview__default-text">Image Preview</span>
            </div><br><br>
            <label for="location">Location:</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($location); ?>" required><br><br>

            <label for="duration">Time Duration:</label>
            <input type="text" name="duration" value="<?php echo htmlspecialchars($duration); ?>" required><br><br>

            <label for="price">Price:</label>
            <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>" required><br><br>

            <button type="submit"  class="btn" name="submit">Update</button>
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
