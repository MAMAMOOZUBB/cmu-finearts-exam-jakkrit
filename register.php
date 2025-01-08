<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // ตรวจสอบว่าชื่อผู้ใช้มีอยู่แล้วหรือไม่
    $stmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "ชื่อผู้ใช้นี้มีอยู่ในระบบแล้ว!";
        $stmt->close();
        exit;
    }
    $stmt->close();

    // แฮชรหัสผ่านก่อนบันทึก
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // บันทึกผู้ใช้ใหม่
    $stmt = $conn->prepare("INSERT INTO user (id, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $username, $hashed_password);
    $stmt->execute();

    if ($stmt->error) {
        echo "Error: " . $stmt->error;
    } else {
        echo "User registered successfully";
    }

    $stmt->close();
}
$conn->close();
