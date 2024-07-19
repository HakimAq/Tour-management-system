<?php
session_start();

// Database connection
$connection = new mysqli('localhost', 'root', '', 'tourmandu_db');

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    Header("Location: login.php");
}

// Retrieve the customer ID from the session
$customer_id = $_SESSION['id'];

// Check if a package is selected
if (!isset($_GET['package_id'])) {
    die("Error: No package selected.");
}

// Retrieve the package ID
$package_id = $_GET['package_id'];

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $guests = $_POST['guests'];
    $arrivals = $_POST['arrivals'];
    $leaving = $_POST['leaving'];

    // Insert into book_form table using prepared statements
    $insert_query = $connection->prepare("INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving, id, customer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert_query->bind_param("sssssisiii", $name, $email, $phone, $address, $location, $guests, $arrivals, $leaving, $package_id, $customer_id);

    if ($insert_query->execute()) {
        header('Location: book.php');
    } else {
        echo "Error: " . $insert_query->error;
    }

    // Close connections
    $insert_query->close();
    $connection->close();
} else {
    echo 'Something went wrong, try again!';
}
?>
