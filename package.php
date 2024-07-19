<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style2.css">
    <style>
        .heading {
            background-size: cover !important;
            background-position: cover !important;
            padding-top: 7rem;
            padding-bottom: 5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }   
        .heading h1 {
            font-size: 6rem;
            text-transform: uppercase;
            color: white;
            text-shadow: var(--text-shadow);
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
        .packages .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6rem;
        }
        .packages .box-container .box {
            height: auto;
            width: 40rem;
            /* flex: 1 1 30rem; */
            border-radius: 5rem;
            overflow: hidden;
            box-shadow: 0 1 rem 2 rem rgb(0, 0, 0,.1);
        }
        .packages .box-container .box img {
            height:30rem;
            width: 40rem;
            object-fit: cover;
        }
        .packages .box-container .box .content {
            padding: 2rem;
            background: var(--light-bg);
        }
        .packages .box-container .box .content h3 {
            font-size: 2rem;
        }
        .packages .box-container .box .content h3 i {
            color: var(--orange);
        }
        .packages .box-container .box .content p {
            font-size: 1.5rem;
            color: #666;
            padding: 1rem 0;
        }
        .packages .box-container .box .content .stars i {
            font-size: 1.7rem;
            color: var(--orange);
        }
        .packages .box-container .box .content .price {
            font-size: 2rem;
            color: #333;
            padding-top: 1rem;
        }
        .packages .box-container .box .content .price span {
            color: #666;
            font-size: 1.5rem;
            text-decoration: line-through;
        }
        .packages .box-container .box .content h4 {
            font-size: 1.5rem;
        }
        .packages .box-container .box:hover .image img {
            transform: scale(1.2);
            transition: 0.75s ease-in-out;
        }
    </style>
</head>
<body>
<section class="header">
    <a href="home.php" class="logo"><h3>TOURMANDU</h3></a>
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="about.php">About</a>
        <a href="package.php">Package</a>
        
    </nav>
    <div class="icons">
        <?php if (!isset($_SESSION['id'])): ?>
            <a href="login.php"><i class="fas fa-user-circle"></i> Login</a>
        <?php else: ?>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php endif; ?>
    </div>
    <div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="heading" style="background:url('https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg?crop=1xw:0.84375xh;center,top') no-repeat">
   <h1>Packages</h1>
</div>

<section class="packages">
    <h1 class="heading-title">Top Destinations</h1>
    <div class="box-container">
        <?php
        include 'connection.php';

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
                    echo "<div class='box'>";
                    echo "<div class='image'><img src='uploads/" . htmlspecialchars($photo) . "' alt='Place Photo'></div>";
                    echo "<div class='content'>";
                    echo "<h3><i class='fa fa-map-marker-alt' style='font-size:18px;color:darkred'></i> " . htmlspecialchars($location) . "</h3>";
                    echo "<div class='price'>Rs." . htmlspecialchars($price) . " (per person)</div>";
                    echo "<h4>" . htmlspecialchars($duration) . "</h4>";
                    echo "<a href='book.php?id=" . $id . "' class='btn'>Book Now</a>";
                    
                    echo "</div></div>";
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
</section>

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
        <a href="#"><i class="fas fa-angle-right"></i> ask questions</a>
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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
    
</body>
</html>
