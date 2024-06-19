<?php
require_once '../admin/function.php';
checkLogin();

$news = getNews($_GET['id']);

if ($news['author_id'] != $_SESSION['userid']) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "../image/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE news SET title='$title', image='$image', description='$description' WHERE id=".$news['id'];
    } else {
        $sql = "UPDATE news SET title='$title', description='$description' WHERE id=".$news['id'];
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: Home.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
    <link rel="stylesheet" href="../asset/edit_news.css">
</head>
<body>
    <form method="post" action="edit_news.php?id=<?php echo $news['id']; ?>" enctype="multipart/form-data">
        <h2>Edit Berita</h2>
        <input type="text" name="title" value="<?php echo $news['title']; ?>" required>
        <input type="file" name="image">
        <textarea name="description" required><?php echo $news['description']; ?></textarea>
        <button type="submit">Update</button>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    </form>
</body>
</html>
