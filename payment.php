<?php
session_start();
include 'connection.php';

$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if ($booking_id <= 0) {
    header("Location: packages.php");
    exit;
}

// Use correct column names from package table
$stmt = $conn->prepare("SELECT b.*,p.image, p.location, p.duration, p.price 
                        FROM book_form b 
                        JOIN package p ON b.package_id = p.package_id 
                        WHERE b.book_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    echo "Invalid booking!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        .payment-container {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 { color: #3c00a0; margin-bottom: 1rem; }
        .details { margin-bottom: 1.5rem; }
        .details p { margin: 0.3rem 0; font-size: 1.1rem; }
        .pay-options {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        .pay-options a {
            display: block;
            padding: 12px 25px;
            border-radius: 8px;
            background: #efeef0ff;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }
        .pay-options a:hover {
            background: #5a1dbb;
        }
        .pay-options img { width: 120px; height: auto; display: block; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="payment-container">
    <h2>Confirm Your Payment</h2>
    <div class="details">
        <p><strong>Booking ID:</strong> <?php echo $booking['book_id']; ?></p>
        <p><strong>Package:</strong></p>
<img src="uploads/<?php echo htmlspecialchars($booking['image']); ?>" 
     alt="Package Image" 
     style="width:300px; height:auto; border-radius:10px;">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
        <p><strong>Guests:</strong> <?php echo $booking['guests']; ?></p>
        <p><strong>Price:</strong> Rs. <?php echo $booking['price']; ?></p>
    </div>
    <div class="pay-options">
        <a href="esewa_pay.php?booking_id=<?php echo $booking_id; ?>">
            <img src="https://www.gamblerspick.com/uploads/monthly_2024_08/eSewa.png.1f178e450f95d3060bed1c224a8ecf2e.png" alt="Esewa">
        </a>
        <a href="khalti_pay.php?booking_id=<?php echo $booking_id; ?>">
            <img src="https://dao578ztqooau.cloudfront.net/static/img/logo1.png" alt="Khalti">
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
