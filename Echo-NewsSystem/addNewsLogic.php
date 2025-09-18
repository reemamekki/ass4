<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php"; 

if(!$conn->connect_error){
    if(isset($_POST['addNews'])){
        $title = htmlspecialchars(trim($_POST['title']));
        $category_id = intval($_POST['category_id']);
        $details = htmlspecialchars(trim($_POST['details']));
        $user_id = $_SESSION['user_id'];
        $image_name = null;

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $target_dir = "uploads/";
            if(!is_dir($target_dir)){
                mkdir($target_dir, 0777, true);
            }
            $image_name = time().'_'.basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir.$image_name);
        }

        $sql = "INSERT INTO news (title, category_id, details, image, user_id) 
                VALUES ('$title', $category_id, '$details', '$image_name', $user_id)";

        if($conn->query($sql) === TRUE){
            header("Location: viewNews.php?added=true");
            exit();
        } else {
            echo "Failed to add news: ".$conn->error;
        }
    }
} else {
    die("Database connection failed: ".$conn->connect_error);
}
?>
