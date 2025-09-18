<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echo News - Register</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dark-mode {
            background-color: #121212;
            color: #fff;
        }
        .container {
            width: 400px;
            padding: 2rem;
            border-radius: 12px;
            background: #f9f9f9;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .dark-mode .container {
            background: #1e1e1e;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            padding: 0.8rem;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            padding: 0.8rem;
            margin-top: 1rem;
            border: none;
            border-radius: 6px;
            background-color: #0077cc;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #005fa3;
        }
        .toggle-mode {
            margin-top: 1rem;
            text-align: center;
            cursor: pointer;
            color: #0077cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Account</h2>
        <form action="registerLogic.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <div class="toggle-mode" onclick="toggleDarkMode()">Switch Mode</div>
    </div>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle("dark-mode");
        }
    </script>
</body>
</html>
