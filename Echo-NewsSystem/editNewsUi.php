<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php"; // $conn

if(!isset($_GET['id'])){
    die("News ID not provided.");
}

$id = intval($_GET['id']);

// Fetch news data
$sql = "SELECT * FROM news WHERE id = $id";
$result = $conn->query($sql);

if($result->num_rows == 0){
    die("News not found.");
}

$news = $result->fetch_assoc();

// Fetch categories
$categories = [];
$sqlCat = "SELECT * FROM categories";
$resCat = $conn->query($sqlCat);
if($resCat->num_rows > 0){
    while($row = $resCat->fetch_assoc()){
        $categories[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Echo News - Edit News</title>
<style>
body { font-family: Arial, sans-serif; background:#f9f9f9; padding:2rem; }
form { background:#fff; padding:2rem; border-radius:8px; max-width:500px; margin:auto; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
input[type=text], textarea, select, input[type=file], input[type=submit] {
    width:100%; padding:0.7rem; margin-bottom:1rem; border-radius:6px; border:1px solid #ccc;
}
input[type=submit] { background:#0077cc; color:#fff; border:none; cursor:pointer; }
input[type=submit]:hover { background:#005fa3; }
img { max-width:150px; display:block; margin-bottom:1rem; }
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



<h2 style="text-align:center;">Edit News</h2>

<form action="editNewsLogic.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">
    
    <input type="text" name="title" placeholder="News Title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
    
    <select name="category" required>
        <option value="">Select Category</option>
        <?php foreach($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $news['category_id']) ? "selected" : ""; ?>>
                <?php echo htmlspecialchars($cat['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <textarea name="details" placeholder="News Details" rows="5" required><?php echo htmlspecialchars($news['details']); ?></textarea>
    
    <?php if($news['image']): ?>
        <img src="uploads/<?php echo $news['image']; ?>" alt="Current Image">
    <?php endif; ?>

    <input type="file" name="image" accept="image/*">
    
    <input type="submit" name="editNews" value="Update News">
</form>

</body>
</html>
