<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cmu_test";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
    }

    $title   = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO article (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        header("Location: blogs.php");
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: blogs.php");
    exit;
}
?>
