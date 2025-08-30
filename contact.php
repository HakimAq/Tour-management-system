<?php
session_start();
// development helpers (remove on production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php'; // must create a MySQLi $conn in this file

$success = '';
$error = '';

// handle form POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // match the form input names: name, email, message (lowercase)
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // validation
    if ($name === '' || $email === '' || $message === '') {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $query = "INSERT INTO contactUs (Name, Email, Message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            $error = "Prepare failed: " . $conn->error;
        } else {
            $stmt->bind_param("sss", $name, $email, $message);
            if ($stmt->execute()) {
                // redirect to avoid duplicate submission on refresh
                $stmt->close();
                $conn->close();
                header("Location: contact.php?success=1");
                exit;
            } else {
                $error = "Execute failed: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// show success if redirected
if (isset($_GET['success']) && $_GET['success'] == '1') {
    $success = "Message sent successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Contact Us</title>
<!-- styles / fonts (kept your CSS) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="style2.css">
<style>
/* keep your inline styles (copied from your file) */
.header .icons a{ font-size:1.7rem; color:#fff; cursor:pointer; margin-right:1.5rem; }
.header .icons a:hover{ color:var(--main-color); }
.login-container{ height:100vh; width:100%; background-image: linear-gradient(rgba(141,141,237,0.8), rgba(143,143,241,0.8)), url(https://assets.thehansindia.com/h-upload/2019/12/27/248830-worldtour.jpg); background-size:cover; background-position:center; }
.form-box{ border-radius:24px; width:90%; max-width:450px; position:absolute; top:50%; left:50%; transform:translate(-50%,-40%); background:white; padding:50px 60px 70px; text-align:center; }
.form-box h1{ font-size:2.2rem; margin-bottom:20px; color:#3c00a0; position:relative; }
.form-box h1::after{ content:''; width:50px; height:4px; border-radius:3px; background:rgb(128,79,128); position:absolute; bottom:-12px; left:50%; transform:translateX(-50%); }
.input-field{ background:#eaeaea; margin:15px 0px; border-radius:3px; display:flex; align-items:center; max-height:120px; transition:max-height 0.5s; overflow:hidden;}
.input-field i{ margin-left:15px; }
input, textarea{ width:100%; background:transparent; border:0; outline:0; padding:19px 20px; resize:none; }
.btn-field{ width:100%; margin-top:10px; padding:10px 0px; display:grid; text-align:center; }
.btn-field button{ text-align:center; height:4rem; width:10rem; background:#3c00a0; color:#fff; border-radius:25px; cursor:pointer; }
.message{ color:green; margin-bottom:10px; }
.error{ color:red; margin-bottom:10px; }
</style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="login-container">
  <div class="form-box">
    <h1 id="title">Contact Us</h1>

    <?php if ($success) echo "<p class='message'>".htmlspecialchars($success)."</p>"; ?>
    <?php if ($error)   echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>

    <form action="contact.php" method="POST">
      <div class="input-group">
        <div class="input-field">
          <i class="fa-solid fa-user"></i>
          <!-- name attributes are lowercase to match PHP -->
          <input type="text" name="name" placeholder="Full Name" required>
        </div>

        <div class="input-field">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-field" style="align-items:flex-start;">
          <i class="fa-solid fa-message" style="margin-top:20px;"></i>
          <textarea name="message" placeholder="Write your message..." rows="4" required></textarea>
        </div>
      </div>

      <div class="btn-field">
        <button type="submit">Send</button>
      </div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
