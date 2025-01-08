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
    $sql = "DELETE FROM article WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: blogs.php");
        exit;
    } else {
        echo "ข้อผิดพลาด: " . $conn->error;
    }
}
?>
