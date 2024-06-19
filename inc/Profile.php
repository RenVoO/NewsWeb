<?php
require_once '../admin/function.php';
checkLogin();

$userid = $_SESSION['userid'];
$user = getUser($userid);

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM news WHERE (author_id = '$userid') AND (title LIKE '%$search%' OR description LIKE '%$search%')";
} else {
    $sql = "SELECT * FROM news WHERE author_id = '$userid'";
}
$result = $conn->query($sql);

$news_count = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../asset/Profile.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="../image/Logo.png" width="150">
        </div>
        <div>
            <form method="GET" action="dashboard.php" class="search-form">
                <input type="text" name="search" placeholder="Search news..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit"><i class='bx bx-search'></i></button>
            </form>
            <a class="icon-btn" href="create_news.php"><i class='bx bx-news'></i></a>
            <a class="icon-btn" href="logout.php"><i class='bx bx-log-out' ></i></a>
            <a class="icon-btn" href="Home.php"><i class='bx bx-caret-left-circle'></i></a>
        </div>
    </div>
    <div class="container">
        <h3>Info User</h3>
        <div class="user-info">
            <h4>Welcome, <?php echo htmlspecialchars($user['username']); ?></h4>
            <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
            <p>Password: <span id="password"><?php echo htmlspecialchars($user['password']); ?></span></p>
            <button onclick="togglePassword()">Show/Hide Password</button>
        </div>
        <h3>Data Berita</h3>
        <?php if ($news_count > 0) { ?>
        <ul class="news-list">
            <?php while ($news = $result->fetch_assoc()) { ?>
                <li class="news-item">
                    <?php if ($news['image']) { ?>
                        <img src="../image/<?= $news['image'] ?>" alt="<?php echo $news['title']; ?>">
                    <?php } ?>

                    <div class="news-content">
                        <a style="color:#c0392b;" href="view_news.php?id=<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a>
                      
                    </div>
                    
                    <div class="news-actions">
                        <a class="btn-edit" href="edit_news.php?id=<?php echo $news['id']; ?>">Edit</a>
                        <a class="btn-delete" href="delete_news.php?id=<?php echo $news['id']; ?>">Delete</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <?php } else { ?>
        <p>Belum ada berita yang dibuat.</p>
        <?php } ?>
    </div>
    
    <script>
        function togglePassword() {
            var password = document.getElementById('password');
            if (password.style.display === 'none') {
                password.style.display = 'inline';
            } else {
                password.style.display = 'none';
            }
        }
    </script>
</body>
</html>
