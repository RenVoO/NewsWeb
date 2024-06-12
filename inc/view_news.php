<?php
require_once '../admin/function.php';
checkLogin();

$news = getNews($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $news['title']; ?></title>
    <link rel="stylesheet" href="../asset/view_news.css"">
</head>
<body>
    <div class="container">
        <h2><?php echo $news['title']; ?></h2>
        <img src="../image/<?= $news['image']; ?>" alt="<?php echo $news['title']; ?>"> 
        <p><?php echo $news['description']; ?></p>
        <p>Author: <?php echo getUser($news['author_id'])['username']; ?></p>
        <p>Date: <?php echo $news['created_at']; ?></p>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
