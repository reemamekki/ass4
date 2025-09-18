<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php";

// Fetch categories
$categories = [];
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $categories[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Echo News - Add News</title>
<style>
body { font-family: Arial, sans-serif; background:#f9f9f9; padding:2rem; }
form { background:#fff; padding:2rem; border-radius:8px; max-width:500px; margin:auto; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
input[type=text], textarea, select, input[type=file], input[type=submit] {
    width:100%; padding:0.7rem; margin-bottom:1rem; border-radius:6px; border:1px solid #ccc;
}
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


<h2 style="text-align:center;">Add News</h2>

<form action="addNewsLogic.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="News Title" required>
    
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php foreach($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <textarea name="details" placeholder="News Details" rows="5" required></textarea>
    
    <input type="file" name="image" accept="image/*">
    
    <input type="submit" name="addNews" value="Add News">
</form>

</body>
</html>
