<?php
// Kiểm tra session, nếu chưa có thì khởi động session
if(session_id() == '' || !isset($_SESSION)){session_start();}

// Kết nối đến database
include 'config.php';

// Kiểm tra xem giỏ hàng có tồn tại không
if(isset($_SESSION['cart'])) {

  $total = 0; // Biến tính tổng tiền đơn hàng

  // Duyệt qua từng sản phẩm trong giỏ hàng
  foreach($_SESSION['cart'] as $F_ID => $quantity) {

    // Lấy thông tin sản phẩm từ DB theo id
    $result = $mysqli->query("SELECT * FROM FOOD WHERE id = ".$F_ID);

    if($result){

      // Nếu tìm thấy sản phẩm
      if($obj = $result->fetch_object()) {

        // Tính thành tiền cho sản phẩm (giá * số lượng)
        $cost = $obj->price * $quantity;

        // Lấy tên user từ session (email/username)
        $user = $_SESSION["username"];

        // Thêm sản phẩm vào bảng orders (đơn hàng)
        $query = $mysqli->query("INSERT INTO orders (product_code, product_name, product_desc, price, units, total, email) 
                                 VALUES('$obj->product_code', '$obj->product_name', '$obj->product_desc', $obj->price, $quantity, $cost, '$user')");

        if($query){
          // Giảm số lượng sản phẩm trong kho
          $newqty = $obj->qty - $quantity;

          // Cập nhật lại số lượng còn lại trong bảng products
          if($mysqli->query("UPDATE products SET qty = ".$newqty." WHERE id = ".$F_ID)){
            // Nếu update thành công thì không làm gì thêm
          }
        }

      }

    }
  }
}

// Sau khi xử lý xong thì chuyển hướng sang trang bill.php để xem hóa đơn
header("location:COD.php");

?>
