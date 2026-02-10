-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2023 at 02:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE `tbl_brands` (
  `id` int(30) NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `img_url` varchar(150) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brands`
--

INSERT INTO `tbl_brands` (`id`, `creation_time`, `update_time`, `id_user`, `name`, `img_url`, `description`) VALUES
(1, '2023-07-27 09:34:02', '2023-09-14 07:50:25', 2, 'Batik saranjana', '../../ims/assets/img/brand/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit. desu'),
(2, '2023-08-11 09:56:39', '2023-08-15 10:10:36', 2, 'batik alleria', '../../ims/assets/img/brand/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.s'),
(3, '2023-08-11 09:56:39', '2023-08-21 07:48:36', 2, 'batik kalongan', '../../ims/assets/img/brand/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.'),
(4, '2023-08-11 10:18:15', '2023-08-21 07:48:36', 2, 'batik bateeq', '../../ims/assets/img/brand/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.'),
(50, '2023-09-26 21:02:47', '2023-09-26 21:02:47', 1, 'batik semar', '../../ims/assets/img/brand/adidas.png', '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` int(11) NOT NULL,
  `code` varchar(150) NOT NULL,
  `img_url` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `creation_time`, `update_time`, `id_user`, `code`, `img_url`, `name`, `description`) VALUES
(1, '2023-07-27 09:35:08', '2023-09-11 08:33:42', 2, 'C-001', '../../ims/assets/img/product/adidas.png', 'Baju panjangg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.'),
(2, '2023-08-09 09:19:36', '2023-08-15 10:10:14', 2, 'C-002', '../../ims/assets/img/product/adidas.png', 'Tas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.'),
(3, '2023-08-09 09:22:25', '2023-08-15 10:10:14', 2, 'C-003', '../../ims/assets/img/product/adidas.png', 'Accessories', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.'),
(4, '2023-08-09 09:24:45', '2023-08-15 10:10:14', 2, 'C-004', '../../ims/assets/img/product/adidas.png', 'Make-up', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img_url` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_sub_category` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `unit` int(10) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `min_qty` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_tax` int(11) NOT NULL,
  `discount_type` varchar(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `creation_time`, `update_time`, `id_user`, `name`, `img_url`, `description`, `id_category`, `id_sub_category`, `id_brand`, `unit`, `sku`, `min_qty`, `qty`, `id_tax`, `discount_type`, `price`, `status`) VALUES
(0, '2023-08-11 09:39:47', '2023-08-15 09:45:10', 2, 'blush on', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 4, 10, 1, 1, 'SRJN-BB-PTH-017', 2, 10, 1, '2', 10, 1),
(1, '2023-07-27 09:55:29', '2023-09-26 21:45:36', 2, 'batik', '../../ims/assets/img/product/unisoviet.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida dictum fusce ut placerat orci.', 1, 1, 1, 1, 'SRJN-BB-X-XL-XXL-HTMPTH-001', 2, 10, 1, '2', 50, 1),
(2, '2023-08-11 08:49:40', '2023-08-15 09:44:53', 2, 'long dress batik', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida dictum fusce ut placerat orci.', 1, 4, 1, 1, 'SRJN-BB-X-XL-XXL-HTMPTH-001', 2, 10, 1, '1', 60, 1),
(3, '2023-08-11 08:56:36', '2023-08-15 09:44:53', 2, 'baju batik lengan panjang', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida dictum fusce ut placerat orci.', 1, 2, 1, 1, 'SRJN-BB-X-XL-XXL-HTMPTH-003', 2, 20, 1, '2', 65, 1),
(4, '2023-08-11 09:01:55', '2023-08-15 09:44:53', 2, 'baju batik lengan pendek', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida dictum fusce ut placerat orci.', 1, 1, 1, 1, 'SRJN-BB-X-XL-XXL-HTMPTH-004', 2, 20, 1, '2', 55, 1),
(5, '2023-08-11 09:01:55', '2023-08-15 09:44:53', 2, 'dress batik evercloth', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida dictum fusce ut placerat orci.', 1, 3, 1, 1, 'SRJN-BB-X-XL-XXL-HTMPTH-005', 2, 10, 1, '2', 70, 1),
(10, '2023-08-11 09:20:08', '2023-08-15 09:44:53', 2, 'tas totebag kanvas', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida dictum fusce ut placerat orci.', 2, 5, 1, 1, 'SRJN-BB-HTMPTH-010', 2, 10, 2, '2', 20, 1),
(11, '2023-08-11 09:25:16', '2023-08-15 09:44:53', 2, 'tas goodie bag', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida dictum fusce ut placerat orci.', 2, 5, 1, 1, 'SRJN-BB-HTMPTH-011', 2, 10, 2, '1', 18, 1),
(12, '2023-08-11 09:27:57', '2023-08-15 09:44:53', 2, 'tas shoulder bag', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida dictum fusce ut placerat orci.', 2, 6, 1, 1, 'SRJN-BB-HTMPTH-012', 2, 10, 2, '1', 15, 1),
(13, '2023-08-11 09:32:31', '2023-08-15 09:44:53', 2, 'accessories gelang', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 3, 7, 1, 1, 'SRJN-BB-EMAS-013', 2, 10, 2, '2', 350, 1),
(14, '2023-08-11 09:32:31', '2023-08-29 20:37:19', 2, 'accessories kalung', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 3, 8, 1, 1, 'SRJN-BB-EMAS-014', 2, 10, 1, '90', 355, 1),
(15, '2023-08-11 09:36:33', '2023-08-15 09:44:53', 2, 'accessories cincin', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 3, 7, 1, 1, 'SRJN-BB-EMAS-015', 2, 10, 1, '2', 350, 1),
(16, '2023-08-11 09:36:33', '2023-08-15 09:44:53', 2, 'accessories anting', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 3, 8, 1, 1, 'SRJN-BB-EMAS-016', 2, 10, 1, '2', 70, 1),
(18, '2023-08-11 09:39:47', '2023-08-15 09:45:58', 2, 'primer', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 4, 9, 1, 1, 'SRJN-BB-HTMPTH-018', 2, 10, 2, '1', 12, 1),
(19, '2023-08-11 09:45:18', '2023-08-15 09:45:58', 2, 'foundation', '../../ims/assets/img/product/adidas.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 4, 9, 1, 1, 'SRJN-BB-PTH-019', 2, 20, 2, '1', 80, 1),
(46, '2023-09-14 07:28:18', '2023-09-26 20:56:02', 1, 'saasasa', '../../ims/assets/img/product/adidas.png', 'sdfsdf', 1, 1, 1, 0, '0317', 242234, 32434, 1, '2342', 23423, 0),
(52, '2023-09-26 20:52:26', '2023-09-26 20:52:26', 1, 'knksad', '../../ims/assets/img/product/adidas.png', 'dsada', 1, 1, 1, 2147483647, '31321123213-X-XL-XXL-HTMPTH', 12321, 13, 1, '1', 1231, 0),
(54, '2023-09-26 20:53:43', '2023-09-26 20:56:21', 1, 'Saranjana', '../../ims/assets/img/product/adidas.png', 'kimakk', 1, 1, 1, 317, '0317-X-XL-XXL-HTMPTH', 317, 317, 1, '1', 350, 0),
(56, '2023-09-26 20:55:16', '2023-09-26 20:55:16', 1, 'bkjasda', '../../ims/assets/img/product/adidas.png', 'anjeng', 1, 1, 1, 123, '1213-X-XL-XXL-HTMPTH', 21, 12, 1, '1', 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_categories`
--

CREATE TABLE `tbl_sub_categories` (
  `id` int(11) NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sub_categories`
--

INSERT INTO `tbl_sub_categories` (`id`, `creation_time`, `update_time`, `id_category`, `id_user`, `name`, `description`, `code`) VALUES
(1, '2023-07-27 09:37:46', '2023-08-14 10:00:11', 2, 2, 'Baju lengan pendek', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit. s', 'SC-001'),
(2, '2023-07-27 09:39:31', '2023-09-13 14:09:22', 1, 2, 'Baju Lengan Panjang', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-002'),
(3, '2023-08-09 09:29:29', '2023-08-14 08:02:35', 1, 2, 'Dress batik evercloth', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-003'),
(4, '2023-08-09 09:33:58', '2023-08-14 08:02:50', 1, 2, 'Long dress', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-004'),
(5, '2023-08-09 09:40:38', '2023-08-14 08:03:03', 2, 2, 'Totebag', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-005'),
(6, '2023-08-09 10:19:48', '2023-08-14 08:03:19', 2, 2, 'Shoulderbag', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-006'),
(7, '2023-08-09 10:25:37', '2023-08-14 08:03:37', 3, 2, 'Perhiasan gelang', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-007'),
(8, '2023-08-09 10:26:55', '2023-08-14 08:03:54', 3, 2, 'Perhiasan kalung', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-008'),
(9, '2023-08-09 10:29:56', '2023-08-14 08:04:33', 4, 2, 'Primer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-009'),
(10, '2023-08-09 10:31:48', '2023-08-14 08:04:51', 4, 2, 'Blush on', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-010'),
(11, '2023-08-12 08:18:22', '2023-09-01 09:18:02', 1, 1, 'Baju', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo viverra maecenas accumsan lacus vel facilisis. Proin libero nunc consequat interdum. Elementum curabitur vitae nunc sed velit.', 'SC-011');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taxes`
--

CREATE TABLE `tbl_taxes` (
  `id` int(11) NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `rate` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_taxes`
--

INSERT INTO `tbl_taxes` (`id`, `creation_time`, `update_time`, `id_user`, `name`, `rate`, `status`) VALUES
(1, '2023-07-27 09:51:18', '2023-08-12 09:21:21', 1, 'Pajak aktif', 5.5, 1),
(2, '2023-07-27 09:53:15', '2023-08-12 09:31:16', 1, 'Pajak Nonaktif', 10.1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pasword` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img_url` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `role` int(3) NOT NULL,
  `status` int(3) NOT NULL,
  `token_ganti_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `creation_time`, `update_time`, `last_login_time`, `username`, `email`, `pasword`, `name`, `img_url`, `phone`, `role`, `status`, `token_ganti_password`) VALUES
(1, '2023-07-27 09:21:48', '2023-09-13 08:11:43', '2023-09-13 08:11:43', 'Dareean', 'superadmin@gmail.com', '13e6b47309e5443f810320856b0b9fe9', 'Super Admin', '../../ims/assets/img/profiles/skamtech.png', '082222222222', 0, 1, ''),
(2, '2023-07-27 09:32:42', '2023-09-26 22:23:50', '2023-09-26 22:23:50', 'Penjual', 'penjual@gmail.com', 'ea69c42607389020b9b590d091088a55', 'Penjual', '../../ims/assets/img/profiles/minecraft.jpeg', '0821111111112', 0, 1, ''),
(12, '2023-08-08 12:52:09', '2023-09-26 22:21:00', '2023-09-26 22:21:00', 'Dareean', 'dmardin@gmail.com', 'dc5d6249e4134cc68d3b2437e0a53b7d', 'Dareean Ahmad Raffi Mardin', '../../ims/assets/img/profiles/minecraft.jpeg', '085340725481', 0, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_category`,`id_sub_category`,`id_brand`,`id_tax`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_sub_category` (`id_sub_category`),
  ADD KEY `id_tax` (`id_tax`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indexes for table `tbl_sub_categories`
--
ALTER TABLE `tbl_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_taxes`
--
ALTER TABLE `tbl_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`,`username`,`email`) USING BTREE,
  ADD UNIQUE KEY `username` (`pasword`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_sub_categories`
--
ALTER TABLE `tbl_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_taxes`
--
ALTER TABLE `tbl_taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD CONSTRAINT `tbl_brands_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD CONSTRAINT `tbl_categories_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_products_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `tbl_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_products_ibfk_3` FOREIGN KEY (`id_sub_category`) REFERENCES `tbl_sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_products_ibfk_4` FOREIGN KEY (`id_tax`) REFERENCES `tbl_taxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_products_ibfk_5` FOREIGN KEY (`id_brand`) REFERENCES `tbl_brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sub_categories`
--
ALTER TABLE `tbl_sub_categories`
  ADD CONSTRAINT `tbl_sub_categories_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sub_categories_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `tbl_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_taxes`
--
ALTER TABLE `tbl_taxes`
  ADD CONSTRAINT `tbl_taxes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
