<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cmu_test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM article WHERE id = $id";
    $result = $conn->query($sql);
    $article = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE article SET title = '$title', content = '$content' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: blogs.php");
        exit;
    } else {
        echo "ข้อผิดพลาด: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขบทความ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">แก้ไขบทความ</h1>
        <form method="POST" class="mt-4">
            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">หัวข้อ</label>
                <input type="text" name="title" class="form-control" value="<?php echo $article['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">เนื้อหา</label>
                <textarea name="content" class="form-control" rows="5" required><?php echo $article['content']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>
</body>
</html>
