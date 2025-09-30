<?php
session_start();
$error = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username hoặc mật khẩu không được để trống.";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        require 'connection.php';
        $conn = Connect();

        $query = "SELECT customer_id, username, password FROM customers WHERE username=? AND password=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->bind_result($customer_id, $db_username, $db_password);

        if ($stmt->fetch()) {
            // ✅ Đây là chỗ quan trọng: lưu session
            $_SESSION['login_user2'] = $db_username;
            $_SESSION['login_user2_id'] = $customer_id; // <-- chèn vào đây

            header("location: foodlist.php");
            exit();
        } else {
            $error = "Tên đăng nhập hoặc mật khẩu sai.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>


