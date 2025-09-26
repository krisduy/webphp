-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 26, 2025 lúc 06:08 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `foodexploria`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `mobile`, `subject`, `message`, `created_at`) VALUES
(1, '13-Nguyễn Trung Đức', 'nguyentrungduclt2310@gmail.com', '0876858550', 'baibaiai', 'baibaiii', '2025-09-24 19:56:00'),
(2, 'Nguyễn Văn A', 'nguyenvanduclt2310@gmail.com', '0876858550', 'baibaiai', 'đây là đức', '2025-09-24 21:06:07'),
(3, 'Nguyễn Văn A', 'nguyenvanduclt2310@gmail.com', '0876858550', 'baibaiai', 'đây là đức', '2025-09-25 04:31:29'),
(4, 'Nguyễn Văn Đức', 'nguyenvanduclt2310@gmail.com', '0876858550', 'baibaiai', 'alo duy anh alo nhóm 5', '2025-09-25 15:03:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `username` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`username`, `fullname`, `email`, `contact`, `address`, `password`) VALUES
('Ducbaby', 'Nguyễn Văn A', 'nguyenvanduclt2310@gmail.com', '0876858550', 'hanoi', '123456'),
('Đức', 'Nguyễn Trung Đức', 'nguyentrungduclt2310@gmail.com', '0876858550', 'số 8 ngõ 282 lạc long quân', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `food`
--

CREATE TABLE `food` (
  `F_ID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `R_ID` int(30) NOT NULL,
  `images_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `food`
--

INSERT INTO `food` (`F_ID`, `name`, `price`, `description`, `R_ID`, `images_path`) VALUES
(68, 'Phở Ngon Hà Thành', 45000, 'Món ăn truyền thống Việt Nam với bánh phở mềm, nước dùng thơm ngọt từ xương bò hầm nhiều giờ, kèm thịt bò tươi, rau thơm và chanh ớt.', 1, 'images/phơga.jpeg'),
(69, 'Mì Cay Hải Sản', 65000, 'Mì cay với sợi mì vàng dai ngon, hòa quyện trong nước dùng đậm đà từ xương hầm và sốt ớt đặc trưng.', 1, 'images/micay.jpeg'),
(70, 'Cơm Tấm Sườn', 45000, 'Cơm tấm dẻo thơm, ăn kèm sườn nướng vàng óng, thấm vị đậm đà. Kết hợp cùng dưa chua, mỡ hành và nước mắm chua ngọt, tạo nên hương vị đặc trưng chuẩn Sài Gòn.', 1, 'images/comtamsuon.jpeg'),
(72, 'Bún Trộn Nam Bộ', 50000, 'Sợi bún mềm dai, ăn kèm rau tươi, thịt và nước mắm chua ngọt đậm đà, hòa quyện tạo nên hương vị ngon miệng và thanh mát.', 1, 'images/buntron.jpeg'),
(73, 'Chả Giò Ngon', 45000, 'Vỏ bánh vàng giòn rụm, nhân thịt và rau củ đậm đà, chiên nóng hổi thơm ngon khó cưỡng.', 1, 'images/chagio.jpeg'),
(74, 'Tobokki Hàn Quốc', 85000, 'Bánh gạo mềm dẻo truyền thống Hàn Quốc, hòa quyện cùng sốt gochujang cay ngọt đậm đà, thêm chả cá và trứng cho hương vị hấp dẫn khó quên.', 1, 'images/tobboki.jpeg'),
(75, ' Cánh Gà Rang Chua Ngọt', 45000, 'Cánh gà chiên mắm – Món ăn đậm đà hương vị Việt, thơm nức mũi với lớp da gà vàng giòn rụm quyện cùng nước mắm tỏi ớt sệt sánh. Thịt gà bên trong mềm ngọt, bên ngoài giòn tan, thấm đều gia vị mặn ngọt ', 1, 'images/gaxaochuangọt cánh.jpeg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manager`
--

CREATE TABLE `manager` (
  `username` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manager`
--

INSERT INTO `manager` (`username`, `fullname`, `email`, `contact`, `address`, `password`) VALUES
('Ducbaby', 'Nguyen Van C', 'NguyenvanC123@gmail.com', '0876858550', 'số 8 ngõ 282 lạc long quân', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(30) NOT NULL,
  `F_ID` int(30) NOT NULL,
  `foodname` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `order_date` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `R_ID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_ID`, `F_ID`, `foodname`, `price`, `quantity`, `order_date`, `username`, `R_ID`) VALUES
(38, 68, 'Phở Ngon Hà Thành', 45, 4, '2025-09-24', 'Ducbaby', 1),
(39, 74, 'Tobokki Hàn Quốc', 85, 1, '2025-09-24', 'Ducbaby', 1),
(40, 74, 'Tobokki Hàn Quốc', 85, 1, '2025-09-24', 'Ducbaby', 1),
(41, 69, 'Mì Cay Hải Sản', 65, 1, '2025-09-24', 'Ducbaby', 1),
(42, 69, 'Mì Cay Hải Sản', 65, 1, '2025-09-24', 'Ducbaby', 1),
(43, 69, 'Mì Cay Hải Sản', 65, 1, '2025-09-24', 'Ducbaby', 1),
(44, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(45, 73, 'Chả Giò Ngon', 45, 1, '2025-09-24', 'Ducbaby', 1),
(46, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(47, 73, 'Chả Giò Ngon', 45, 1, '2025-09-24', 'Ducbaby', 1),
(48, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(49, 73, 'Chả Giò Ngon', 45, 1, '2025-09-24', 'Ducbaby', 1),
(50, 73, 'Chả Giò Ngon', 45, 1, '2025-09-24', 'Ducbaby', 1),
(51, 69, 'Mì Cay Hải Sản', 65, 1, '2025-09-24', 'Ducbaby', 1),
(52, 69, 'Mì Cay Hải Sản', 65, 1, '2025-09-24', 'Ducbaby', 1),
(53, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(54, 74, 'Tobokki Hàn Quốc', 85, 1, '2025-09-24', 'Ducbaby', 1),
(55, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(56, 69, 'Mì Cay Hải Sản', 65, 5, '2025-09-24', 'Ducbaby', 1),
(57, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(58, 69, 'Mì Cay Hải Sản', 65, 5, '2025-09-24', 'Ducbaby', 1),
(59, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(60, 69, 'Mì Cay Hải Sản', 65, 1, '2025-09-24', 'Ducbaby', 1),
(61, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(62, 69, 'Mì Cay Hải Sản', 65, 1, '2025-09-24', 'Ducbaby', 1),
(63, 68, 'Phở Ngon Hà Thành', 45, 1, '2025-09-24', 'Ducbaby', 1),
(64, 69, 'Mì Cay Hải Sản', 65, 1, '2025-09-24', 'Ducbaby', 1),
(65, 74, 'Tobokki Hàn Quốc', 85, 18, '2025-09-24', 'Ducbaby', 1),
(66, 74, 'Tobokki Hàn Quốc', 85, 18, '2025-09-24', 'Ducbaby', 1),
(67, 74, 'Tobokki Hàn Quốc', 85, 18, '2025-09-24', 'Ducbaby', 1),
(68, 74, 'Tobokki Hàn Quốc', 85, 18, '2025-09-24', 'Ducbaby', 1),
(69, 74, 'Tobokki Hàn Quốc', 85, 18, '2025-09-24', 'Ducbaby', 1),
(70, 74, 'Tobokki Hàn Quốc', 85, 18, '2025-09-24', 'Ducbaby', 1),
(71, 74, 'Tobokki Hàn Quốc', 85, 18, '2025-09-24', 'Ducbaby', 1),
(72, 73, 'Chả Giò Ngon', 45, 1, '2025-09-24', 'Ducbaby', 1),
(73, 75, ' Cánh Gà Rang Chua Ngọt', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(74, 70, 'Cơm Tấm Sườn', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(75, 75, ' Cánh Gà Rang Chua Ngọt', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(76, 70, 'Cơm Tấm Sườn', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(77, 75, ' Cánh Gà Rang Chua Ngọt', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(78, 70, 'Cơm Tấm Sườn', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(79, 74, 'Tobokki Hàn Quốc', 85000, 1, '2025-09-24', 'Ducbaby', 1),
(80, 73, 'Chả Giò Ngon', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(81, 69, 'Mì Cay Hải Sản', 65000, 1, '2025-09-24', 'Ducbaby', 1),
(82, 74, 'Tobokki Hàn Quốc', 85000, 1, '2025-09-24', 'Ducbaby', 1),
(83, 68, 'Phở Ngon Hà Thành', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(84, 72, 'Bún Trộn Nam Bộ', 50000, 1, '2025-09-24', 'Ducbaby', 1),
(85, 70, 'Cơm Tấm Sườn', 45000, 1, '2025-09-24', 'Ducbaby', 1),
(86, 70, 'Cơm Tấm Sườn', 45000, 1, '2025-09-25', 'Đức', 1),
(87, 69, 'Mì Cay Hải Sản', 65000, 1, '2025-09-25', 'Đức', 1),
(88, 68, 'Phở Ngon Hà Thành', 45000, 1, '2025-09-25', 'Ducbaby', 1),
(89, 72, 'Bún Trộn Nam Bộ', 50000, 1, '2025-09-25', 'Ducbaby', 1),
(90, 69, 'Mì Cay Hải Sản', 65000, 1, '2025-09-25', 'Ducbaby', 1),
(91, 68, 'Phở Ngon Hà Thành', 45000, 1, '2025-09-26', 'Ducbaby', 1),
(92, 69, 'Mì Cay Hải Sản', 65000, 1, '2025-09-26', 'Ducbaby', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`F_ID`,`R_ID`),
  ADD KEY `R_ID` (`R_ID`);

--
-- Chỉ mục cho bảng `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `F_ID` (`F_ID`),
  ADD KEY `username` (`username`),
  ADD KEY `R_ID` (`R_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `food`
--
ALTER TABLE `food`
  MODIFY `F_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
