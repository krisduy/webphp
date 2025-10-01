<?php
session_start();
$error = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username hoặc mật khẩu không được để trống.";
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        require 'connection.php';
        $conn = Connect();

        // Kiểm tra xem user đã tồn tại chưa
        $query = "SELECT customer_id, username, password FROM customer WHERE username=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result(); // cần store_result để check num_rows
        $stmt->bind_result($customer_id, $db_username, $db_password);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            // So sánh mật khẩu
            if (password_verify($password, $db_password)) {
                // Đăng nhập thành công
                $_SESSION['login_user2'] = $db_username;
                $_SESSION['login_user2_id'] = $customer_id;
                header("location: foodlist.php");
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu sai.";
            }
        } else {
            // Nếu user chưa tồn tại, có thể đăng ký luôn và lưu mật khẩu hash
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO customer (username, password) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($insert);
            $stmt_insert->bind_param("ss", $username, $hashed_password);
            if ($stmt_insert->execute()) {
                $_SESSION['login_user2'] = $username;
                $_SESSION['login_user2_id'] = $conn->insert_id;
                header("location: foodlist.php");
                exit();
            } else {
                $error = "Đăng ký tự động thất bại. Vui lòng thử lại.";
            }
            $stmt_insert->close();
        }

        $stmt->close();
        $conn->close();
    }
}
?>
