<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginUi.php");
    exit();
}

include "connectionOnDatabase.php";

$userName = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Echo News - Dashboard</title>
<style>
    body { margin:0; font-family: Arial, sans-serif; background:#fff; color:#000; }
    .dark-mode { background:#121212; color:#fff; }
    header { background:#0077cc; color:#fff; padding:1rem; display:flex; justify-content:space-between; align-items:center; }
    header h1 { margin:0; font-size:1.8rem; }
    .logout { color:#fff; text-decoration:none; font-weight:bold; background:#ff4444; padding:0.5rem 1rem; border-radius:6px; }
    .logout:hover { background:#cc0000; }

    nav { display:flex; justify-content:center; background:#f0f0f0; padding:0.5rem; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
    .dark-mode nav { background:#1e1e1e; }
    nav a { text-decoration:none; color:#0077cc; margin:0 1rem; padding:0.5rem 1rem; border-radius:6px; font-weight:bold; transition: all 0.3s; }
    .dark-mode nav a { color:#66b0ff; }
    nav a:hover { background:#0077cc; color:#fff; transform:translateY(-2px); box-shadow:0 4px 10px rgba(0,0,0,0.2); }

    .container { display:grid; grid-template-columns:2fr 1fr; gap:1rem; padding:1rem; }
    .news-section { display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:1rem; }
    .news-card { background:#f9f9f9; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1); transition: transform 0.2s, box-shadow 0.2s; }
    .dark-mode .news-card { background:#1e1e1e; }
    .news-card:hover { transform:translateY(-5px); box-shadow:0 6px 15px rgba(0,0,0,0.2); }
    .news-card img { width:100%; height:150px; object-fit:cover; }
    .news-card .content { padding:0.8rem; }
    .news-card h3 { margin:0 0 0.5rem 0; }
    .news-card p { margin:0; font-size:0.9rem; line-height:1.3; }
    .sidebar { background:#f0f0f0; padding:1rem; border-radius:8px; }
    .dark-mode .sidebar { background:#222; }
    .sidebar h2 { margin-top:0; }
    .categories { list-style:none; padding:0; }
    .categories li { padding:0.5rem 1rem; margin-bottom:0.5rem; border-radius:6px; color:white; font-weight:bold; cursor:pointer; transition: transform 0.2s, box-shadow 0.2s; }
    .categories li:hover { transform: scale(1.05); box-shadow:0 4px 12px rgba(0,0,0,0.2); }
    .categories li.politics { background:#ff6b6b; }
    .categories li.sports { background:#4ecdc4; }
    .categories li.technology { background:#ffa500; }
    .categories li.health { background:#6a4c93; }
    .categories li.beauty { background:#f67280; }
    .categories li.entertainment { background:#1fab89; }
    .categories li.travel { background:#ff9f1c; }

    .toggle-mode { margin:1rem; text-align:center; cursor:pointer; color:#0077cc; font-weight:bold; transition: all 0.3s; }
    .toggle-mode:hover { color:#005fa3; transform: scale(1.05);}
    .button { padding:0.3rem 0.6rem; color:#fff; text-decoration:none; border-radius:4px; margin-right:0.3rem; font-size:0.85rem; }
    .edit { background:#4caf50; }
    .delete { background:#ff4444; }
</style>
</head>
<body>
<header>
    <h1>Echo News</h1>
    <div>
        Welcome, <?php echo htmlspecialchars($userName); ?> |
        <a href="loginUi.php" class="logout">Logout</a>
    </div>
</header>

<nav>
    <a href="addCategoryUi.php">Add Category</a>
    <a href="viewCategories.php">View Categories</a>
    <a href="addNewsUi.php">Add News</a>
    <a href="viewNews.php">View News</a>
    <a href="deletedNewsUi.php">View Deleted News</a>
</nav>

<div class="container">
    <div class="news-section">
        <?php
        $sql = "SELECT news.*, categories.name AS category_name 
                FROM news 
                JOIN categories ON news.category_id = categories.id 
                WHERE news.deleted = 0
                ORDER BY news.created_at DESC";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '<div class="news-card">';
                echo '<img src="'.($row['image'] ? 'uploads/'.$row['image'] : 'images/default.jpg').'" alt="News">';
                echo '<div class="content">';
                echo '<h3>'.htmlspecialchars($row['title']).'</h3>';
                echo '<p>'.htmlspecialchars($row['details']).'</p>';
                echo '<p style="font-size:0.8rem; color:#555;">
                Category: '.htmlspecialchars($row['category_name']).' | Added By (User ID): '.htmlspecialchars($row['user_id']).'
              </p>';

                echo '<div style="margin-top:0.5rem;">
                        <a href="editNewsUi.php?id='.$row['id'].'" class="button edit">Edit</a>
                        <a href="deletedNews.php?id='.$row['id'].'" class="button delete">Delete</a>
                      </div>';
                echo '</div></div>';
            }
        } else {
            echo '<p style="text-align:center; color:#555;">No news found.</p>';
        }
        ?>
    </div>

    <div class="sidebar">
        <h2>Categories</h2>
        <ul class="categories">
            <li class="politics">Politics</li>
            <li class="sports">Sports</li>
            <li class="technology">Technology</li>
            <li class="health">Health</li>
            <li class="beauty">Beauty</li>
            <li class="entertainment">Entertainment</li>
            <li class="travel">Travel</li>
        </ul>
    </div>
</div>

<div class="toggle-mode" onclick="toggleDarkMode()">Switch Mode</div>

<script>
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
    const toggle = document.querySelector(".toggle-mode");
    if(document.body.classList.contains("dark-mode")){
        toggle.textContent = "Switch to Light Mode";
    } else {
        toggle.textContent = "Switch to Dark Mode";
    }
}
</script>
</body>
</html>
