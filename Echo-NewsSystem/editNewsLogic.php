<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php"; 

if(isset($_POST['editNews'])){
    $news_id = intval($_POST['news_id']);
    $title = htmlspecialchars(trim($_POST['title']));
    $category = intval($_POST['category']);
    $details = htmlspecialchars(trim($_POST['details']));
    $user_id = $_SESSION['user_id'];
    $image_name = null;

    // Handle new image if uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $target_dir = "uploads/";
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }
        $image_name = time() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        $sql = "UPDATE news 
                SET title='$title', category_id=$category, details='$details', image='$image_name'
                WHERE id=$news_id";
    } else {
        $sql = "UPDATE news 
                SET title='$title', category_id=$category, details='$details'
                WHERE id=$news_id";
    }

    if($conn->query($sql) === true){
        header("Location: viewNews.php?updated=true");
        exit();
    } else {
        echo "Failed to update news: " . $conn->error;
    }
}
?>
