-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 15, 2022 lúc 03:46 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lkaudio`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`account_id`, `email`, `password`, `name`, `role`, `created_at`, `token`) VALUES
(1, 'admin@gmail.com', '4eaa3d1aa83a16f49383289c59157ff1', 'Administrator', 'admin', '2022-06-15 13:41:52', '75d23af433e0cea4c0e45a56dba18b30'),
(2, 'amber@gmail.com', '4eaa3d1aa83a16f49383289c59157ff1', 'Amber Heard', 'user', '2022-06-15 13:45:40', NULL),
(22, 'johny@gmail.com', '4eaa3d1aa83a16f49383289c59157ff1', 'Johny Depp', 'admin', '2022-06-15 13:45:15', 'c15d20b8f736a6849922392a3d962dda'),
(24, 'linh@gmail.com', '4eaa3d1aa83a16f49383289c59157ff1', 'Linh đẹp trai', 'user', '2022-06-14 03:49:42', NULL),
(25, 'phongtran@gmail.com', '4eaa3d1aa83a16f49383289c59157ff1', 'Phong', 'user', '2022-06-14 05:05:13', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`cate_id`, `name`, `parent_id`) VALUES
(1, 'Tai nghe', NULL),
(2, 'Tai nghe có dây', 1),
(3, 'Tai nghe không dây', 1),
(4, 'Máy nghe nhạc', NULL),
(5, 'Dây dẫn thay thế', NULL),
(6, 'Phụ kiện', NULL),
(7, 'Spinfit tip', 6),
(8, 'Jack cắm tai nghe', 6),
(9, 'Case|Túi đựng', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `title`, `price`, `image`, `quantity`, `description`, `created_at`, `updated_at`, `account_id`, `category_id`) VALUES
(1, 'Tai nghe Moondrop Aria Special Edition Limited', 2205000, '4347_5.jpg', 11, 'Vừa qua, thương hiệu “Trăng Rơi” đã vui mừng giới thiệu mẫu tai nghe phiên bản mới, Aria Special Edition Limited (hay còn gọi là Elven Maiden) - sở hữu thiết kế \"Wings & Harp\" độc lạ, trang bị trình điều khiển động từ tính khoang kép 10mm và màng ngăn tinh thể lỏng LCD để tạo ra âm thanh chi tiết với độ phân giải cực cao.   ', '2022-06-08 09:02:59', '2022-06-14 03:43:53', 25, 2),
(2, 'Tai nghe True Wireless Moondrop Nekocake', 1160000, '3967____________05.jpg', 24, 'Moondrop là thương hiệu có tên tuổi và rất uy tín trong ngành công nghiệp âm thanh HiFi, chuyên sản xuất các mẫu tai nghe có dây và không dây chất lượng. Nekocake cung cấp hiệu suất âm thanh tuyệt vời, khả năng khử tiếng ồn chủ động và có mức giá vô cùng hấp dẫn.', '2022-06-08 09:08:43', '2022-06-12 03:59:58', 1, 3),
(3, 'Máy nghe nhạc iBasso DX220', 16840000, '2290_dscf1115.jpg', 3, '<p>iBasso DX200 l&agrave; một trong những sản phẩm m&aacute;y nghe nhạc rất th&agrave;nh c&ocirc;ng của h&atilde;ng &acirc;m thanh tới từ Trung Quốc. Sở hữu cho m&igrave;nh một cấu h&igrave;nh &acirc;m thanh mạnh mẽ cũng như khả năng thay thế v&agrave; biến đổi &acirc;m thanh một c&aacute;ch linh hoạt, DX200 đ&atilde; nhanh ch&oacute;ng chiếm được cảm t&igrave;nh của rất nhiều người d&ugrave;ng. V&agrave; mới đ&acirc;y, để tiếp bước sự th&agrave;nh c&ocirc;ng của người đ&agrave;n anh, iBasso đ&atilde; giới thiệu ra mẫu m&aacute;y nghe nhạc cao cấp mới nhất của m&igrave;nh mang t&ecirc;n DX220 thừa hưởng những g&igrave; nổi bật v&agrave; tinh t&uacute;y nhất của người đ&agrave;n anh cũng như được cải tiến chất lượng gi&uacute;p cho người d&ugrave;ng c&oacute; được những trải nghiệm tốt nhất.</p>\r\n', '2022-06-08 09:08:43', '2022-06-12 07:00:14', 2, 1),
(4, 'Tripowin Altea Cable', 750000, '4376_tripowin_altea_cable_xuan_vu.jpg', 9, 'Lõi Đồng mạ Bạc OCC Litz kết hợp Đồng OCC Litz\r\nĐộ tinh khiết 7N (99.99999%) đem lại chất lượng truyền dẫn tốt nhất\r\nLớp vỏ SA Insulation mới bền bỉ, không bị cứng lại.\r\nThiếc hàn Audio pha bạc Oyaide Made in Japan\r\nSản xuất thủ công tại Việt Nam\r\n', '2022-06-08 09:12:17', '2022-06-15 13:43:26', 22, 5),
(7, 'Eartip SpinFit CP220 M2', 300000, '4452_eartip_spinfit_cp220_m2_xuan_vu_1_min.jpg', 50, 'CP220 M2 là mẫu Double-Flange Eartip bằng silicon đã được cấp bằng sáng chế về khả năng xoay 360 độ để sử dụng linh hoạt cho nhiều loại tai nghe khác nhau, vừa vặn với tất cả các ống tai để đảm bảo sự thoải mái và đồng thời cải thiện chất lượng âm thanh một cách đáng kể.', '2022-06-08 09:14:51', '2022-06-12 04:00:36', 1, 7),
(8, 'Ultra Premium Multi Plug', 1750000, '2604_dd_dj35a_dj44a_n_m_2_5_4_4_c_n_b_ng_adapter_p_d_q50__1_.jpg', 14, 'Với sự phát triển nhanh chóng của các thiết bị âm thanh, những chuẩn kết nối mới như 4.4mm và 2.5mm đang ngày càng phổ biến, bên cạnh đó cổng 3.5mm cũng đang được sử dụng rất rộng rãi.\r\n\r\nNhưng không phải bất kì một chiếc tai nghe hay điện thoại, máy nghe nhạc nào cũng được trang bị sẵn cả 3 chuẩn kết nối như vậy. Nếu bạn muốn sử dụng bất cứ sợi cáp nào với bất kì chuẩn kết nối nào mà bạn muốn. DDHifi đã làm cho nhu cầu đó trở nên dễ dàng hơn nhiều. DDHifi đã cho ra mắt 2 mẫu Adapter cao cấp có lên là DDHiFi DJ35A và DJ44A:', '2022-06-08 09:14:51', '2022-06-12 04:00:54', 2, 8),
(9, 'iFi GO blu Case', 700000, '4686_ifi_go_blue_case_xuan_vu_1.jpg', 20, 'Đặc điểm nổi bật của iFi GO blu Case\r\nGo blu case là một phụ kiện quan trọng, được thiết kế đặc biệt để bảo vệ cho chiếc DAC/AMP wireless portable của bạn trong những hoạt động thường ngày như đi làm, đi học, tập thể dục, tham gia các hoạt động ngoài trời á,..', '2022-06-08 09:16:10', '2022-06-12 04:01:23', 24, 9),
(10, 'Tai nghe Moondrop Chu không mic', 490000, '4455_tai_nghe_moondrop_chu_khong_mic.jpg', 21, 'Nếu bạn là fan hâm mộ cuồng nhiệt của Moondrop thì đừng nên bỏ lỡ “Chu” – mẫu tai nghe thế hệ tiếp theo của Spaceship: sở hữu thiết kế siêu xịn xò, tích hợp trình điều khiển động màng composite phủ tinh thể nano 10mm và đặc biệt là được hiệu chỉnh theo VDSF Taget Response để mang tới âm thanh trong trẻo, độ phân giải cao trên suốt cả dải tần.', '2022-06-10 04:07:41', '2022-06-12 04:01:36', 22, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image`
--

CREATE TABLE `product_image` (
  `product_img_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_image`
--

INSERT INTO `product_image` (`product_img_id`, `product_id`, `image_name`) VALUES
(60, 9, '4686_ifi_go_blue_case_xuan_vu_2.png'),
(61, 9, '4686_ifi_go_blue_case_xuan_vu.png'),
(62, 8, '2603_dd_dj35a_dj44a_n_m_2_5_4_4_c_n_b_ng_adapter_p_d_q50__2_.jpg'),
(63, 8, '2603_dd_dj35a_dj44a_n_m_2_5_4_4_c_n_b_ng_adapter_p_d_q50.jpg'),
(64, 7, '4452_eartip_spinfit_cp220_m2_xuan_vu_3.jpg'),
(65, 7, '4452_eartip_spinfit_cp220_m2_xuan_vu_2.jpg'),
(66, 7, '4452_eartip_spinfit_cp220_m2_xuan_vu.jpg'),
(67, 4, '4376_tripowin_altea_cable_xuan_vu_6.jpg'),
(68, 4, '4376_tripowin_altea_cable_xuan_vu_4.jpg'),
(69, 4, '4376_tripowin_altea_cable_xuan_vu_1.jpg'),
(70, 4, '4376_tripowin_altea_cable_xuan_vu_2.jpg'),
(71, 4, '4376_tripowin_altea_cable_xuan_vu_5.jpg'),
(72, 3, '2290_fgnhftrhdtrhtrnjtnbfefr_dfgbdf_g_shrstgse_dfgb.jpg'),
(73, 3, '2290_3_46f8b8eb_b23b_449a_8419_850928c8bc48_grande.png'),
(74, 3, '2290_dscf1109.jpg'),
(75, 3, '2290_gr_gdfbgdsfgdsh_dsgdfshdsfgdfsgdfh_dfhds_gdgd.jpg'),
(76, 2, '3967_375a4c32_181c_46c3_93b9_67601f2789be.jpg'),
(77, 2, '3967_ed5d0d7d_6484_4ec8_a92d_485319919cc0.jpg'),
(78, 2, '3967_fr7_yfnse9y_udlhldxa__k.jpg'),
(79, 2, '3967_095bb56282674a391376.jpg'),
(80, 2, '3967_111f56266123a97df032.jpg'),
(81, 2, '3967_51658f5cb85970072948.jpg'),
(82, 2, '3967_d641307f077acf24966b.jpg'),
(83, 1, '4347_1.jpg'),
(84, 1, '4347_2.jpg'),
(85, 1, '4347_3.jpg'),
(86, 1, '4347_4.jpg'),
(87, 10, '4455_tai_nghe_moondrop_chu_khong_mic_1.jpg'),
(88, 10, '4455_tai_nghe_moondrop_chu_khong_mic_2.jpg'),
(89, 10, '4455_tai_nghe_moondrop_chu_khong_mic_7.jpg'),
(90, 10, '4455_tai_nghe_moondrop_chu_khong_mic_3.jpg'),
(91, 10, '4455_tai_nghe_moondrop_chu_khong_mic_4.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_img_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`cate_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`cate_id`);

--
-- Các ràng buộc cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
