<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Package</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
<link rel="stylesheet" href="style2.css" />
<style>
    .heading {
        background-size: cover !important;
        background-position: center !important;
        padding: 5rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }   
    .heading h1 {
        font-size: 6rem;
        text-transform: uppercase;
        color: black;
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
        width: 40rem;
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: 0 1rem 2rem rgba(0,0,0,0.1);
        background: #fff;
    }
    .packages .box-container .box img {
        width: 100%;
        height: 30rem;
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
    .packages .box-container .box .content .price {
        font-size: 2rem;
        color: #333;
        padding-top: 1rem;
    }
    .packages .box-container .box .content h4 {
        font-size: 1.5rem;
    }
    .packages .box-container .box:hover img {
        transform: scale(1.1);
        transition: 0.6s ease-in-out;
    }
</style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="heading" style="background:url('https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg?crop=1xw:0.84375xh;center,top') no-repeat">
   <h1>Packages</h1>
</div>

<section class="packages">
    <h1 class="heading-title">Top Destinations</h1>
    <div class="box-container">
        <?php
        include 'connection.php';

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $userName, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT package_id, location, duration, price, image FROM package";
            $stmt = $pdo->query($sql);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='box'>";
                echo "<div class='image'><img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Place Photo'></div>";
                echo "<div class='content'>";
                echo "<h3><i class='fa fa-map-marker-alt' style='color:darkred'></i> " . htmlspecialchars($row['location']) . "</h3>";
                echo "<div class='price'>Rs." . htmlspecialchars($row['price']) . " (per person)</div>";
                echo "<h4>" . htmlspecialchars($row['duration']) . "</h4>";

                // ✅ Book Now button with login redirect
                if (isset($_SESSION['customer_id'])) {
                    echo "<a href='book.php?id=" . intval($row['package_id']) . "' class='btn'>Book Now</a>";
                } else {
                    echo "<a href='login.php?redirect=book.php?id=" . intval($row['package_id']) . "' class='btn'>Book Now</a>";
                }

                echo "</div></div>";
            }
        } catch (PDOException $e) {
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
        ?>
    </div>
</section>

<?php
// ✅ Popular Packages by most booked
try {
    $sql = "SELECT p.package_id, p.location, p.duration, p.price, p.image, COUNT(b.book_id) AS total_bookings
            FROM package p
            LEFT JOIN book_form b ON p.package_id = b.package_id
            GROUP BY p.package_id
            ORDER BY total_bookings DESC
            LIMIT 3";
    $stmt = $pdo->query($sql);
    $popularPackages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($popularPackages) {
        echo "<section class='packages'>";
        echo "<h1 class='heading-title'>🔥 Popular Packages</h1>";
        echo "<div class='box-container'>";
        foreach ($popularPackages as $package) {
            echo "<div class='box'>";
            echo "<div class='image'><img src='uploads/" . htmlspecialchars($package['image']) . "' alt='Place Photo'></div>";
            echo "<div class='content'>";
            echo "<h3><i class='fa fa-map-marker-alt' style='color:darkred'></i> " . htmlspecialchars($package['location']) . "</h3>";
            echo "<div class='price'>Rs." . htmlspecialchars($package['price']) . " (per person)</div>";
            echo "<h4>" . htmlspecialchars($package['duration']) . "</h4>";
            echo "<p>📌 Booked: " . intval($package['total_bookings']) . " times</p>";

            if (isset($_SESSION['customer_id'])) {
                echo "<a href='book.php?id=" . intval($package['package_id']) . "' class='btn'>Book Now</a>";
            } else {
                echo "<a href='login.php?redirect=book.php?id=" . intval($package['package_id']) . "' class='btn'>Book Now</a>";
            }

            echo "</div></div>";
        }
        echo "</div></section>";
    }
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
