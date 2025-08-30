<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connection.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Information</title>
    <style>
.button2 {
  background-color: lawngreen;
  font-size: 18px;
  height: 1.5rem;
  width: 5rem;
  text-align: center;
}
.button1 {
    background-color: red;
    font-size: 18px;
    height: 1.5rem;
    width: 5rem;
    text-align: center;
}
.package-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 5px;
}
.package {
  width: calc(25% - 20px);
  margin: 10px;
  background-color: rgba(255, 255, 255, 0.8);
  padding: 10px;
  border-radius: 5px;
}
@media (max-width: 1200px) {
  .package {
    width: calc(25% - 20px);
  }
}
.package-container {
  width: 100%;
  max-width: 1800px;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  align-items: stretch;
}
.main-content {
  width: 100%;
  margin: 30px auto;
  flex-wrap: wrap;
  justify-content: space-around;
}
.main-content1 {
    height: 100%;
    width: 100%;
    background-image: linear-gradient(rgba(141, 141, 237, 0.8), rgba(143, 143, 241, 0.8)), 
                      url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg);
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
    <a href="home.php" class="logo"><h3>TOURMANDU</h3></a>
    <nav class="navbar">
        <a href="addPackages.php">Add Package</a>
        <a href="package_list.php">Package Information</a>
        <a href="user_list.php">User Information</a>
        <a href="booked.php">Package Booked</a>
    </nav>
    <div class="icons">
        <a href="login.php"><i class="fas fa-sign-out"></i>Logout</a>
    </div>
    <div id="menu-btn" class="fas fa-bars"></div>
</section> 

<div class="main-content1">
<div class="main-content">
 <center>  <h1>Package Information</h1><br><br></center> 

    <div class="package-container">
<?php
try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $userName, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve package records
    $sql = "SELECT package_id, location, duration, price, image FROM package";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $package_id = $row["package_id"];
            $location = $row["location"];
            $duration = $row["duration"];
            $price = $row["price"];
            $photo = $row["image"];

            echo "<div class='package'>";
            echo "<p>ID: " . htmlspecialchars($package_id) . "</p>";
            echo "<p>Location: " . htmlspecialchars($location) . "</p>";
            echo "<p>Duration: " . htmlspecialchars($duration) . " </p>";
            echo "<p>Price: RS " . htmlspecialchars($price) . "</p>";
            echo "<img class='package-image' src='uploads/" . htmlspecialchars($photo) . "' alt='Place Photo'>";
            echo "<div class='button2'><a href='package_update.php?id=" . urlencode($package_id) . "'>Update</a></div>";
            echo "<div class='button1'><a href='package_delete.php?id=" . urlencode($package_id) . "'>Delete</a></div>";
            echo "</div>";
        }
    } else {
        echo "No package records found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;
?>
    </div>
</div>
</div>

</body>
</html>
