<?php
require_once '../admin/function.php';
require_once '../admin/koneksi.php'; 
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author_id = $_SESSION['userid'];

    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target = "../image/" . basename($image);
        
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $error = "Failed to upload image. Error: " . $_FILES['image']['error'];
        } else {
            $sql = "INSERT INTO news (title, image, description, author_id) VALUES ('$title', '$image', '$description', '$author_id')";
            if ($conn->query($sql) === TRUE) {
                header("Location: Home.php");
                exit();
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        $error = "No image uploaded or upload error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create News</title>
    <link rel="stylesheet" href="../asset/create_news.css">
</head>
<body>
    <div class="form-container">
        <form method="post" action="create_news.php" enctype="multipart/form-data">
            <h2>Buat Berita</h2>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description" required></textarea>
            </div>
            <button type="submit">Submit</button>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        </form>
    </div>
</body>
</html>

