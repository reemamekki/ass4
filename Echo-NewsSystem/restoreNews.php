<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $sql = "UPDATE news SET deleted = 0 WHERE id = $id";
    if($conn->query($sql) === true){
        header("Location: deletedNewsUi.php?restored=true");
        exit();
    } else {
        echo "Failed to restore news: " . $conn->error;
    }
}
?>
