<?php
session_start(); 
$error = ''; // Biến lưu thông báo lỗi

if (isset($_POST['submit'])) { // Kiểm tra nếu form được submit
    if (empty($_POST['username']) || empty($_POST['password'])) {
        // Nếu bỏ trống username hoặc password
        $error = "Username hoặc mật khẩu không được để trống.";
    } else {
        // Lấy dữ liệu nhập vào, loại bỏ khoảng trắng thừa
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Kết nối tới database
        require 'connection.php';
        $conn = Connect();

        // Truy vấn kiểm tra user có tồn tại không
        $query = "SELECT customer_id, username, password, fullname, email, Telephone, address 
                  FROM customer WHERE username=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // store_result để có thể dùng num_rows
        $stmt->store_result(); 
        $stmt->bind_result($customer_id, $db_username, $db_password, $fullname, $email, $mobile, $address);

        if ($stmt->num_rows > 0) {
            // Nếu tìm thấy user
            $stmt->fetch();

            // Kiểm tra password nhập vào có khớp với password hash trong DB không
            if (password_verify($password, $db_password)) {
                // Nếu đúng -> tạo session cho user
                $_SESSION['login_user2'] = $db_username;
                $_SESSION['login_user2_id'] = (int)$customer_id;

                // Lấy thông tin user đầy đủ để hiển thị
                $userInfo = [
                    'customer_id' => (int)$customer_id,
                    'username'    => $db_username,
                    'fullname'    => $fullname,
                    'email'       => $email,
                    'mobile'      => $mobile,
                    'address'     => $address
                ];

                // Debug: hiển thị thông tin user (bảng HTML)
                echo "<h3>Thông tin User</h3>";
                echo "<table border='1'>";
                echo "<tr><th>Trường</th><th>Giá trị</th></tr>";
                foreach ($userInfo as $k => $v) {
                    echo "<tr><td>$k</td><td>" . ($v !== NULL ? htmlspecialchars($v) : "Chưa có") . "</td></tr>";
                }
                echo "</table>";

                // Sau khi login thành công, điều hướng về index
                header("location: index.php");
                exit();
            } else {
                // Sai password
                $error = "Tên đăng nhập hoặc mật khẩu sai.";
            }
        } else {
            // Nếu không tìm thấy user trong DB
            $error = "Tài khoản chưa tồn tại. Vui lòng đăng ký trước khi đăng nhập.";

            /*
            // === CODE AUTO ĐĂNG KÝ (CHỈ DÙNG NẾU MUỐN TỰ TẠO USER KHI CHƯA CÓ) ===
            // Đã comment để tránh tạo user ngoài ý muốn

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO customer (username, password) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($insert);
            $stmt_insert->bind_param("ss", $username, $hashed_password);
            if ($stmt_insert->execute()) {
                $newId = (int)$conn->insert_id;
                $_SESSION['login_user2'] = $username;
                $_SESSION['login_user2_id'] = $newId;

                // Lấy lại thông tin user vừa tạo
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
            */
        }

        // Đóng statement và kết nối
        $stmt->close();
        $conn->close();
    }
}
?>
