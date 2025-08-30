<?php
session_start();

// Get and validate package_id
$package_id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($package_id) || !ctype_digit($package_id)) {
    header("Location: packages.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="style2.css" />
  
    <style>
        /* Booking Section Styles */
        .booking {
            padding: 9rem 10%;
            background: #f9f9f9;
        }

        .heading-title {
            text-align: center;
            font-size: 5rem;
            color: #3c00a0;
            margin-bottom: 5rem;
            position: relative;
        }

        .heading-title::after {
            content: '';
            width: 100px;
            height: 4px;
            border-radius: 3px;
            background: rgb(128, 79, 128);
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
        }

        .book-form {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 3rem 4rem;
            border-radius: 24px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .book-form .flex {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: space-between;
        }

        .book-form .inputBox {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }

        .book-form .inputBox span {
            font-weight: 600;
            color: #3c00a0;
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }

        /* Bigger input fields */
        .book-form input[type="text"],
        .book-form input[type="email"],
        .book-form input[type="tel"],
        .book-form input[type="number"],
        .book-form input[type="date"] {
            background: #eaeaea;
            border-radius: 8px;
            border: none;
            padding: 20px 25px;
            font-size: 1.2rem;
            outline: none;
            transition: box-shadow 0.3s ease;
            height: 50px;
        }

        .book-form input[type="text"]:focus,
        .book-form input[type="email"]:focus,
        .book-form input[type="tel"]:focus,
        .book-form input[type="number"]:focus,
        .book-form input[type="date"]:focus {
            box-shadow: 0 0 8px 3px rgba(142, 68, 173, 0.6);
        }

        .book-form input[type="submit"].btn {
            display: block;
            width: 220px;
            margin: 3rem auto 0;
            background: #3c00a0;
            color: white;
            border-radius: 30px;
            cursor: pointer;
            height: 55px;
            font-size: 1.4rem;
            transition: background-color 0.3s ease;
            border: none;
            font-weight: 600;
        }

        .book-form input[type="submit"].btn:hover {
            background: #5a1dbb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .book-form .inputBox {
                flex: 1 1 100%;
            }
            .book-form {
                padding: 2rem;
            }
            .book-form input[type="submit"].btn {
                width: 100%;
                height: 50px;
                font-size: 1.2rem;
            }
        }

        /* Heading background */
        .heading {
            background: url('https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg?crop=1xw:0.84375xh;center,top') no-repeat center/cover;
            padding: 6rem 0;
            text-align: center;
            color: white;
            font-size: 3rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 4px;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="heading">
   <h1>book now</h1>
</div>

<section class="booking">
    <h1 class="heading-title">book your trip!</h1>
    <form action="book_form.php?package_id=<?php echo htmlspecialchars($package_id); ?>" method="post" class="book-form">
        <div class="flex">
            <div class="inputBox">
                <span>Name:</span>
                <input type="text" placeholder="Enter your name" name="name" required>
            </div>
            <div class="inputBox">
                <span>Email:</span>
                <input type="email" placeholder="Enter your email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$" required>
            </div>
            <div class="inputBox">
                <span>Phone:</span>
                <input type="tel" placeholder="Enter your number" name="phone" pattern="[9][7-8][0-9]{8}" required>
            </div>
            <div class="inputBox">
                <span>Address:</span>
                <input type="text" placeholder="Enter your address" name="address" required>
            </div>
            <div class="inputBox">
                <span>How many guests:</span>
                <input type="number" placeholder="Number of guests" name="guests" min="1" required>
            </div>
            <div class="inputBox">
                <span>Arrivals:</span>
                <input type="date" id="date-input" name="arrivals" required>
            </div>
            <div class="inputBox">
                <span>Leaving:</span>
                <input type="date" id="leaving-date" name="leaving" required>
            </div>
        </div>
        <input type="submit" value="Submit" class="btn" name="send">
    </form>

</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('date-input').setAttribute('min', today);
        document.getElementById('leaving-date').setAttribute('min', today);
    });
</script>
</body>
</html>
