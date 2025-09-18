<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php";
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Echo News - View Categories</title>
<style>
    body { font-family: Arial, sans-serif; margin:1rem; background:#f9f9f9; }
    table { width:80%; margin:auto; border-collapse: collapse; background:#fff; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
    th, td { padding:1rem; border:1px solid #ccc; text-align:left; }
    th { background:#0077cc; color:#fff; }
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

<h2 style="text-align:center;">All Categories</h2>

<?php
if(isset($_GET['added']) && $_GET['added'] === "true") {
    echo "<p style='color:green; text-align:center;'>Category added successfully!</p>";
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
    <?php
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No categories found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
