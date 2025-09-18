<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginUi.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Echo News - Add Category</title>
<style>
    body { font-family: Arial, sans-serif; margin:0; padding:1rem; background:#f9f9f9; }
    form { background:#fff; padding:2rem; border-radius:8px; max-width:400px; margin:auto; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
    input[type=text], input[type=submit] { width:100%; padding:0.7rem; margin-bottom:1rem; border-radius:6px; border:1px solid #ccc; }
    input[type=submit] { background:#0077cc; color:#fff; border:none; cursor:pointer; }
    input[type=submit]:hover { background:#005fa3; }
</style>
</head>
<body>
<div style="text-align:left; margin:20px;">
    <a href="dashboardUi.php" 
       style="padding:10px 20px; background:#0077cc; color:#fff; text-decoration:none; 
              border-radius:6px; font-weight:bold; display:inline-block;">
        ⬅ Back to Dashboard
    </a>
</div>


<h2 style="text-align:center;">Add New Category</h2>

<form action="addCategoryLogic.php" method="post">
    <input type="text" name="categoryName" placeholder="Category Name" required>
    <input type="submit" name="addCategory" value="Add Category">
</form>

</body>
</html>