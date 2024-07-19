<?php
session_start(); // Start the session

// Ensure $package_id is set and retrieved correctly
$package_id = $_GET['id'];


// Your HTML and PHP code for booking form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
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
            color:white;
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
        .booking .book-form {
            padding:2rem;
            background: var(--light-bg);
        }
        .booking .book-form .flex {
            display: flex;
            flex-wrap: wrap;
            gap:3rem;
        }
        .booking .book-form .flex .inputBox input {
            width: 100%;
            padding:0.5rem 10rem;
            font-size: 2.5rem;
            color: var(--black);
            text-transform: none;
            margin-top:1rem;
            border: var(--border);
        }
        .booking .book-form .flex .inputBox input:focus::placeholder {
            color: var(--light-black);
        }
        .booking .book-form .flex .inputBox span {
            font-size: 2rem;
            color: black;
        }
        .booking .book-form .btn {
             margin-top: 2rem;
             display: center;
        }
    </style>
</head>
<body>
<section class="header">
    <a href="home.php" class="logo"><h3>TOURMANDU</h3> </a>
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

<div class="heading" style="background:url(https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg?crop=1xw:0.84375xh;center,top)">
   <h1>book now</h1>
</div>
<section class="booking">
    <h1 class="heading-title">book your trip!</h1>
    <form action="book_form.php?package_id=<?php echo $package_id; ?>" method="post" class="book-form">
    <div class="flex">
            <div class="inputBox">
                <span>name:</span>
                <input type="text" placeholder="enter your name" name="name" required>
            </div>
            <div class="inputBox" id="email">
                <span>email:</span>
                <input type="email" placeholder="enter your email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$" required>
            </div>
            <div class="inputBox">
                <span>phone:</span>
                <input type="tel" placeholder="enter your number" name="phone" pattern="[9][7-8][0-9]{8}" required>
            </div>
            <div class="inputBox">
                <span>address:</span>
                <input type="text" placeholder="enter your address" name="address" required>
            </div>
        
            <div class="inputBox">
                <span>how many:</span>
                <input type="number" placeholder="number of guests" name="guests" min="1" required>
            </div>
            <div class="inputBox">
                <span>arrivals:</span>
                <input type="date" id="date-input" name="arrivals" required>
            </div>
            <div class="inputBox">
                <span>leaving:</span>
                <input type="date" id="leaving-date" name="leaving" required>
            </div>
        </div>
        <input type="submit" value="submit" class="btn" name="send">
    </form>
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
    <div class="credit">created by <span>mr. amir shrestha</span> | all rights reserved!</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('date-input').setAttribute('min', today);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('leaving-date').setAttribute('min', today);
    });
</script>
</body>
</html>
