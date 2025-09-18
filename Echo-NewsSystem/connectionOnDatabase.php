<?php
$conn = new mysqli("localhost", "root", "", "news_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
