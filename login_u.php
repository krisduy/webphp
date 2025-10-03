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
        $query = "SELECT customer_id, username, password, fullname, email, Telephone, address 
                  FROM customer WHERE username=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result(); // cần store_result để check num_rows
        $stmt->bind_result($customer_id, $db_username, $db_password, $fullname, $email, $mobile, $address);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            // So sánh mật khẩu hash
            if (password_verify($password, $db_password)) {
                $_SESSION['login_user2'] = $db_username;
                $_SESSION['login_user2_id'] = (int)$customer_id;

                // Lấy toàn bộ thông tin user
                $userInfo = [
                    'customer_id' => (int)$customer_id,
                    'username'    => $db_username,
                    'fullname'    => $fullname,
                    'email'       => $email,
                    'mobile'      => $mobile,
                    'address'     => $address
                ];

                // Hiển thị thông tin
                echo "<h3>Thông tin User</h3>";
                echo "<table border='1'>";
                echo "<tr><th>Trường</th><th>Giá trị</th></tr>";
                foreach ($userInfo as $k => $v) {
                    echo "<tr><td>$k</td><td>" . ($v !== NULL ? htmlspecialchars($v) : "Chưa có") . "</td></tr>";
                }
                echo "</table>";

                header("location: index.php");
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu sai.";
            }
        } else {
            // Nếu user chưa tồn tại, tự tạo mới (chỉ username + password)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO customer (username, password) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($insert);
            $stmt_insert->bind_param("ss", $username, $hashed_password);
            if ($stmt_insert->execute()) {
                $newId = (int)$conn->insert_id;
                $_SESSION['login_user2'] = $username;
                $_SESSION['login_user2_id'] = $newId;

                // Lấy thông tin user vừa tạo
                $selectQ = "SELECT customer_id, username, fullname, email, mobile, address 
                            FROM customer WHERE customer_id = ?";
                $stmt2 = $conn->prepare($selectQ);
                $stmt2->bind_param("i", $newId);
                $stmt2->execute();
                $result = $stmt2->get_result();
                $userInfo = $result->fetch_assoc();
                $userInfo['customer_id'] = (int)$userInfo['customer_id'];

                // Hiển thị
                echo "<h3>Thông tin User vừa tạo</h3>";
                echo "<table border='1'>";
                echo "<tr><th>Trường</th><th>Giá trị</th></tr>";
                foreach ($userInfo as $k => $v) {
                    echo "<tr><td>$k</td><td>" . ($v !== NULL ? htmlspecialchars($v) : "Chưa có") . "</td></tr>";
                }
                echo "</table>";

                header("location: index.php");
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
