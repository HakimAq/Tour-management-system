<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Information</title>
    
    <style>
.button2 {
  background-color: lawngreen;
  font-size: 18px;
  height: 1.5rem;
  width: 5rem;
}
.button1 {
    background-color: red;
    font-size: 18px;
    height: 1.5rem;
    width: 5rem;
}

.package-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 5px;
}

.package {
  width: calc(25% - 20px); /* For three images per row */
  margin: 10px;
  background-color: rgba(255, 255, 255, 0.8);
  padding: 10px;
  border-radius: 5px;
}
@media (max-width: 1200px) {
  .package {
    width: calc(25% - 20px); /* For four images per row */
  }
}
.package-container {
  width: 100%;
  max-width: 1800px;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  align-items: stretch; /* Align items to the start of the flex container */
}
.main-content {
  width: 100%;
  margin: 30px auto;
 
  flex-wrap: wrap; /* Allow items to wrap to the next line */
  justify-content: space-around; /* Distribute items evenly with space around them */
}
.main-content1 {
    height: 100%;
    width: 100%;
    background-image: linear-gradient(rgba(141, 141, 237, 0.8), rgba(143, 143, 241, 0.8)), url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
    
}

.header {
    position: sticky;
    top:0; left:0; right: 0;
    z-index: 1000;
    background-color: rgba(0, 0, 128, 0.696);
    display: flex;
    padding-top: 2rem;
    padding-bottom: 2rem;
    box-shadow: var(--box-shadow);
    align-items: center;
    justify-content: space-between;
}
.header .logo {
    font-size: 2.5rem;
    color: white;
}
.header .navbar a {
    font-size: 1.5rem;
    margin-left: 2rem;
    color: white;
    text-transform: capitalize;
}
.header .navbar a:hover {
    color: var(--main-color);
}
.header .icons a{
    font-size: 1.7rem;
    color: #fff;
    cursor: pointer;
    margin-right: 1.5rem;
}
.header .icons a:hover{
    color: var(--main-color);
}  
 

* {
    font-family: "Poppins", sans-serif;
    margin:0; padding:0;
    box-sizing: border-box;
    outline: none; border: none;
    text-decoration: none;
    text-transform: capitalize;
}
    </style>
</head>
<body>
    
<section class="header">
    <a href="home.php" class="logo"><h3>TOURMANDU</h3> </a>
    <nav class="navbar">
        <a href="addPackages.php">addPackage</a>
        <a href="package_list.php">package information</a>
        <a href="user_list.php">user information</a>
        <a href="booked.php">package booked</a>
    </nav>
    <div class="icons">
        <a href="login.php"><i class="fas fa-sign-out"></i>Logout</a>
    </div>
</section>
<div class="main-content1">
<div class="main-content">
 <center>  <h1>Package Information</h1><br><br></center> 

    <div class="package-container">
<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}


try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $userName, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the package records from the database
    $sql = "SELECT id, location, duration, price, image FROM package";
    $stmt = $pdo->query($sql);

    // Check if there are any package records
    if ($stmt->rowCount() > 0) {
        // Loop through each package record
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $location = $row["location"];
            $duration = $row["duration"];
            $price = $row["price"];
            $photo = $row["image"];

            // Display the package record
            echo "<div class='package'>";
            // echo "<p>ID: " . $id . "</p>";
            echo "<p>Location: " . $location . "</p>";
            echo "<p>Duration: " . $duration . " </p>";
            echo "<p>Price: RS " . $price . "</p>";
            echo "<img class='package-image' src='uploads/" . htmlspecialchars($photo) . "' alt='Place Photo'>";
            echo "<div class='button2'>";
            echo "<a href='package_update.php?id=" . $id . "'>Update</a>";
            echo "</div>";
            echo "<div class='button1'>";
            echo "<a href='package_delete.php?id=" . $id . "'>Delete</a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        // Display a message if there are no package records
        echo "No package records found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>
    </div>
</div>
</div>
</body>
</html>
