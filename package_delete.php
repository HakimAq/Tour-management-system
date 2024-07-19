<?php
include 'connection.php';

if(isset($_GET['id'])){
    $id= $_GET['id'];

    // Delete related rows in book_form table first
    $deleteBookFormQuery = "DELETE FROM book_form WHERE id='$id'";
    mysqli_query($conn, $deleteBookFormQuery);

    // Now delete the package
    $query = "DELETE FROM package WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid.";
    exit;
}

mysqli_close($conn);
header('Location: package_list.php');
?>
