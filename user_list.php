<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user list</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   
    <style>
        .information {
    font-size: 25px;
}
.information{
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
    
    outline: none; 
    text-decoration: none;
    text-transform: none;
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
<div class="information">
<center><h1>User Information</h1></center>

<?php
include "connection.php";
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}


$sql= "SELECT * FROM customers";
$query = $conn->query($sql);

if($query->num_rows >0){
    echo "<table border= '1'>";
    echo "<tr>";
   
    echo "<th>ID </th>";
    echo "<th>Name</th>";
    echo "<th>Address</th>";
    echo "<th>Email</th>";  
    echo "<th>Phone Number</th>";
    echo "<th>Username</th>";
    echo "<th>Is Admin";
    echo "</tr>";


    while($row = $query->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['customer_id']."</td>";
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['Address']."</td>";
        echo "<td>".$row['Email']."</td>";
        echo "<td>".$row['phoneNumber']."</td>";
        echo "<td>".$row['userName']."</td>";
        
        echo "<td>".$row['is_admin']."</td>";
         
        
        echo "<td>
    
        <a href= ' user_update.php? customer_id=".$row['customer_id']."'>Update</a>
        <a href= ' user_delete.php? customer_id=".$row['customer_id']."'>Delete</a>
        </td>";
        echo "</tr>";
    }
    echo "</table>";

}else{
    echo " no connection.";
}
mysqli_close($conn);

?>
</div>


</body>
</html>