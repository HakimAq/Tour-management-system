<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tourmandu</title>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f8f8f8;
    }

    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #fff;
      padding: 12px 40px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header .logo h3 {
      margin: 0;
      font-size: 22px;
      font-weight: bold;
      color: #f4f2f7ff;
      letter-spacing: 1px;
    }

    .navbar {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .navbar a {
      text-decoration: none;
      color: #333;
      font-size: 16px;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .navbar a:hover {
      color: #b22222;
    }

    
    .search-form {
      display: flex;
      align-items: center;
      margin-left: 20px;
      border-radius: 50px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      border: 1px solid #eee;
    }

    .search-form__input {
      padding: 8px 14px;
      border: none;
      outline: none;
      font-size: 15px;
      background: #f8f8f8;
      transition: all 0.3s ease;
      width: 180px;
    }

    .search-form__input:focus {
      background: #fff;
      width: 220px;
    }

    .search-form__button {
      padding: 8px 16px;
      border: none;
      background: linear-gradient(135deg, #b22222, #ff4d4d);
      color: #fff;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .search-form__button:hover {
      background: linear-gradient(135deg, #7a1414, #b22222);
    }

    .icons a {
      margin-left: 20px;
      text-decoration: none;
      color: #fefbfbff;
      font-size: 16px;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: color 0.3s ease;
    }

    .icons a:hover {
      color: #b22222;
    }

 
    @media (max-width: 768px) {
      .header {
        flex-wrap: wrap;
        padding: 10px 20px;
      }
      .navbar {
        width: 100%;
        justify-content: center;
        margin: 10px 0;
        flex-wrap: wrap;
        gap: 15px;
      }
      .search-form {
        margin: 10px auto;
        width: 100%;
        max-width: 350px;
      }
      .search-form__input {
        width: 100%;
      }
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
    <a href="contact.php">Contact</a>

    <!-- ✅ Search Bar -->
    <form action="binary.php" method="get" class="search-form">
      <input type="text" name="query" class="search-form__input" placeholder="Search..." required>
      <button type="submit" class="search-form__button">
        <i class="fa fa-search"></i>
      </button>
    </form>
  </nav>

 <div class="icons">
  <?php if (isset($_SESSION['customer_id'])): ?>
      <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
  <?php else: ?>
      <a href="login.php"><i class="fa fa-user"></i> Login</a>
  <?php endif; ?>
</div>

</section>

</body>
</html>
