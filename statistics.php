<?php
include("session_m.php"); // Kiểm tra admin đăng nhập
include("connection.php"); // Kết nối CSDL

// ================== THỐNG KÊ TỔNG QUAN ==================
$total_food = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM food"))['total'];
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders"))['total'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM customer"))['total'];

$result_revenue = mysqli_query($conn, "SELECT SUM(price * quantity) AS total, SUM(quantity) AS total_qty FROM orders");
$revenue_data = mysqli_fetch_assoc($result_revenue);
$total_revenue = $revenue_data['total'] ?? 0;
$total_quantity = $revenue_data['total_qty'] ?? 0;

// ================== DOANH THU THEO THÁNG ==================
$year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
$sql = "SELECT MONTH(order_date) AS month, SUM(price * quantity) AS revenue 
        FROM orders 
        WHERE YEAR(order_date) = $year 
        GROUP BY MONTH(order_date) 
        ORDER BY month";
$result = mysqli_query($conn, $sql);

$months = [];
$revenues = [];

while ($row = mysqli_fetch_assoc($result)) {
    $months[] = "Tháng " . $row['month'];
    $revenues[] = (int)$row['revenue'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê doanh thu - Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
        }
        /* Sidebar */
        .sidebar {
            width: 230px;
            background: #343a40;
            padding-top: 20px;
            min-height: 100vh;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #adb5bd;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #007bff;
            color: #fff;
            border-radius: 5px;
        }
        /* Content */
        .content {
            flex-grow: 1;
            padding: 30px 40px;
        }
        h2 {
            font-weight: bold;
            margin-bottom: 25px;
            color: #333;
        }
        /* Stats Card */
        .stats-card {
            border-radius: 15px;
            padding: 25px 20px;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 2rem;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            transition: 0.3s;
        }
        .stats-card:hover { transform: translateY(-5px); }
        .stats-card p { margin-top: 10px; font-size: 1rem; font-weight: 500; }
        .bg-food { background: #17a2b8; }
        .bg-orders { background: #28a745; }
        .bg-users { background: #ffc107; color: #212529; }
        .bg-revenue { background: #dc3545; }
        .bg-quantity { background: #6610f2; }
        /* Chart Container */
        .chart-container {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .sidebar-header {
    text-align: center;
    padding: 20px 10px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    margin-bottom: 15px;
}

.sidebar-header i {
    font-size: 40px;
    color: #ffc107;
    margin-bottom: 10px;
}

.sidebar-header h5 {
    color: #fff;
    margin: 0;
    font-size: 18px;
    font-weight: bold;
}
.sidebar-header p {
    color: #adb5bd;
    margin: 0;
    font-size: 14px;
}

    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">

    <div class="sidebar-header">
        <i class="bi bi-person-circle"></i>
        <h5>Xin chào, Admin</h5>
        <p>Quản trị viên</p>
    </div>
        <a href="view_food_items.php">Xem món ăn</a>
        <a href="add_food_items.php">Thêm món ăn</a>
        <a href="edit_food_items.php">Chỉnh sửa món ăn</a>
        <a href="delete_food_items.php">Xóa món ăn</a>
        <a href="view_order_details.php">Xem chi tiết đơn hàng</a>
        <a href="statistics.php" class="active">📊 Thống kê</a>
    </nav>

    <!-- Content -->
    <div class="content">
        <h2>📈 Thống kê Doanh Thu Theo Năm</h2>

        <!-- Stats Overview -->
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="stats-card bg-food">
                    <?= $total_food ?>
                    <p>Món Ăn</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stats-card bg-orders">
                    <?= $total_orders ?>
                    <p>Đơn Hàng</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stats-card bg-users">
                    <?= $total_users ?>
                    <p>Người Dùng</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stats-card bg-revenue">
                    <?= number_format($total_revenue, 0, ',', '.') ?> đ
                    <p>Doanh Thu</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stats-card bg-quantity">
                    <?= $total_quantity ?>
                    <p>Số lượng bán</p>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="chart-container">
            <h4 class="text-center mb-3">Biểu đồ doanh thu theo tháng - Năm <?= $year ?></h4>
            
            <!-- Select year -->
            <form method="GET" class="text-center mb-3">
                <label><b>Chọn năm:</b></label>
                <select name="year" onchange="this.form.submit()">
                    <?php for ($y = date("Y"); $y >= 2020; $y--) {
                        $sel = ($y == $year) ? "selected" : "";
                        echo "<option value='$y' $sel>$y</option>";
                    } ?>
                </select>
            </form>

            <canvas id="revenueChart" height="100"></canvas>
        </div>
    </div>

    <!-- ChartJS Script -->
    <script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($months) ?>,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: <?= json_encode($revenues) ?>,
                backgroundColor: 'rgba(255, 159, 64, 0.8)',
                borderColor: 'rgba(255, 99, 32, 1)',
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.formattedValue.toLocaleString("vi-VN") + " đ";
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: { display: true, text: 'Tháng' }
                },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Doanh thu (VNĐ)' },
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString("vi-VN") + " đ";
                        }
                    }
                }
            }
        }
    });
    </script>
</body>
</html>
