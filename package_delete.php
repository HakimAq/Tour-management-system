<?php
include 'connection.php';

if(isset($_GET['id'])){
    $id= $_GET['id'];

    $query = "DELETE FROM package WHERE id='$id'";
    $result= mysqli_query($conn, $query);

    if($result){
        echo "record deleted succesfully.";
    }else{
        echo "error deleting record:".mysqli_error($conn);
    }
    } else{
        echo "Invalid.";
        exit;
    }
    mysqli_close($conn);
    header('location:package_list.php')

?>