<?php
require_once '../admin/function.php';
checkLogin();

$userid = $_SESSION['userid'];
$user = getUser($userid);

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM news WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM news";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../asset/dashboard.css">
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
            <a class="icon-btn" href="logout.php"><i class='bx bxs-user-circle'></i></a>
        </div>
    </div>
    <div class="container">
        <h3 >Berita Terkini</h3>
        <ul class="news-list">
            <?php while ($news = $result->fetch_assoc()) { ?>
                <li class="news-item">
                    <?php if ($news['image']) { ?>
                        <img src="../image/<?= $news['image'] ?>" alt="<?php echo $news['title']; ?>">
                    <?php } ?>

                    <div class="news-content">
                        <a style="color:#c0392b;" href="view_news.php?id=<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a>
                        <p><?php echo $news['description']; ?></p>
                    </div>
                    
                    <div class="news-actions">
                        <?php if ($news['author_id'] == $userid) { ?>
                            <a  class="btn-edit" href="edit_news.php?id=<?php echo $news['id']; ?>">Edit</a>
                            <a  class="btn-delete"  href="delete_news.php?id=<?php echo $news['id']; ?>">Delete</a>
                        <?php } ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <footer>
    <section class="footer">
    <div class="footer-container">
                            
            <div class="message">
                <h1>Kami ingin mengucapkan terima kasih yang sebesar-besarnya atas kunjungan Anda ke situs 
                    berita kami. Kami sangat menghargai waktu dan perhatian Anda dalam mengikuti berita dan informasi yang kami sajikan. Dukungan Anda sangat berarti 
                    bagi kami, dan kami berkomitmen untuk terus memberikan berita terkini, terpercaya, dan berkualitas.</h1>
            </div>

            <div class="box">
                <div class="box-text">
                    <p><i class='bx bx-at' style="font-size: 25px;"></i>Follow Drap On Social Media  </p>
                </div>
                <div class="sm">
                    <a href="#" target="_blank"><i class='bx bxl-instagram-alt'></i></a>
                    <a href="#" target="_blank"><i class='bx bxl-reddit' ></i></i></a>
                    <a href="#"><i class='bx bxl-facebook-circle' ></i></a>
                    <a href="#" target="_blank"><i class='bx bxl-twitter' ></i></i></a>
                </div>
            </div>
        </div>

        <h1 class="credit" style="font-size: 25px;">Thanks for visit <i class="fa-solid fa-user-secret"></i></h1>
    </footer>
    </section>
</body>
</html>
