<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php"; 

if (!$conn->connect_error) {
    if (isset($_POST['addCategory'])) {
        $categoryName = htmlspecialchars(trim($_POST['categoryName']));

        if (!empty($categoryName)) {
            $sql = "INSERT INTO categories (name) VALUES ('$categoryName')";
            if ($conn->query($sql) === true) {
                header("Location:viewCategories.php?added=true");
                exit();
            } else {
                echo "Failed to add category: " . $conn->error;
            }
        } else {
            echo "Category name cannot be empty!";
        }
    }
} else {
    die("Database connection failed: " . $conn->connect_error);
}
?>
