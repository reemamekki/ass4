<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php"; 

// Fetch all deleted news
$sql = "SELECT news.*, categories.name AS category_name 
        FROM news 
        JOIN categories ON news.category_id = categories.id 
        WHERE news.deleted = 1
        ORDER BY news.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Echo News - Deleted News</title>
<style>
body { font-family: Arial, sans-serif; background:#f9f9f9; padding:2rem; }
table { width:90%; margin:auto; border-collapse: collapse; background:#fff; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
th, td { padding:1rem; border:1px solid #ccc; text-align:left; }
th { background:#0077cc; color:#fff; }
img { max-width:100px; border-radius:4px; }
a.button {
    padding: 0.5rem 1rem; background: #0077cc; color: #fff; text-decoration: none; border-radius: 4px; margin-right: 0.3rem; display: inline-block; }
a.button:hover { background:#005fa3; }
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


<h2 style="text-align:center;">Deleted News</h2>

<?php
if(isset($_GET['deleted']) && $_GET['deleted'] === "true") {
    echo "<p style='color:red; text-align:center;'>News deleted successfully!</p>";
}
if(isset($_GET['restored']) && $_GET['restored'] === "true") {
    echo "<p style='color:green; text-align:center;'>News restored successfully!</p>";
}
?>

<table>
    <tr>
        <th><center>Title</center></th>
        <th><center>Category</center></th>
        <th><center>Details</center></th>
        <th><center>Image</center></th>
        <th><center>Added By (User ID)</center></th>
        <th style="width:180px;"><center>Actions</center></th>
    </tr>
    <?php
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".htmlspecialchars($row['title'])."</td>";
            echo "<td>".htmlspecialchars($row['category_name'])."</td>";
            echo "<td>".htmlspecialchars($row['details'])."</td>";
            echo "<td>".($row['image'] ? "<img src='uploads/".$row['image']."' alt='news'>" : "No Image")."</td>";
            echo "<td>".$row['user_id']."</td>";
            echo "<td>
                <center><a class='button' href='restoreNews.php?id=".$row['id']."'>Restore</a></center>
                 </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No deleted news found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
