<?php
session_start();
include("connectionOnDatabase.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboardUi.php");
            exit();
        } else {
            header("Location: loginUi.php?error=Invalid%20password");
            exit();
        }
    } else {
        header("Location: loginUi.php?error=Email%20not%20found");
        exit();
    }
}
?>
