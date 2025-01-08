<?php
include 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // ตรวจสอบชื่อผู้ใช้ในระบบ
    $stmt = $conn->prepare("SELECT id, username, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $fetched_username, $hashed_password);
        $stmt->fetch();

        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: blogs.php");
            exit;
        } else {
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง!";
        }
    } else {
        $_SESSION['error'] = "ชื่อผู้ใช้ไม่พบในระบบ!";
    }
    $stmt->close();
}

// แสดงข้อความแจ้งเตือนในหน้า login.php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
$conn->close();
?>