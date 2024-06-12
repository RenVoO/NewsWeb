<?php
require_once '../admin/function.php';
checkLogin();

$news = getNews($_GET['id']);

if ($news['author_id'] == $_SESSION['userid']) {
    $sql = "DELETE FROM news WHERE id=" . $news['id'];
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
