-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 01, 2019 lúc 05:45 AM
-- Phiên bản máy phục vụ: 10.3.15-MariaDB
-- Phiên bản PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `baseapp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linked` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `info`, `details`, `images`, `author`, `linked`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Hello, i\'m Long', 'hello-im-long', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquam corporis dicta dolor, dolore dolorem eveniet ex facilis magnam molestiae officiis placeat quas quod sapiente sit temporibus velit voluptatibus.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquam corporis dicta dolor, dolore dolorem eveniet ex facilis magnam molestiae officiis placeat quas quod sapiente sit temporibus velit voluptatibus.</p>\r\n\r\n<p>orem ipsum dolor sit amet consectetur adipisicing elit. Laborum ipsa repellat accusamus nemo fuga, neque asperiores consectetur tempora necessitatibus minima rem aspernatur. Beatae eius aliquam maxime distinctio id reprehenderit repudiandae.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus nemo ea maiores saepe quo minima, culpa sint incidunt perspiciatis omnis dolore accusamus adipisci quam architecto pariatur natus! Necessitatibus, quibusdam exercitatio</p>', 'Article_etYn430712465_389750054824952_8989623461325661181_n.jpg', 'ThaiLong', 'https://www.facebook.com/profile.php?id=100013698812957', 0, '2018-10-21 08:24:37', '2018-10-21 08:24:37'),
(3, 'Test Articles', 'test-articles', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquam corporis dicta dolor, dolore dolorem eveniet ex facilis magnam molestiae officiis placeat quas quod sapiente sit temporibus velit voluptatibus.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquam corporis dicta dolor, dolore dolorem eveniet ex facilis magnam molestiae officiis placeat quas quod sapiente sit temporibus velit voluptatibus.</p>', '2kX_1.jpg', 'NguyenLongIT95', 'https://www.facebook.com/profile.php?id=100013698812957', 1, '2019-04-07 08:08:25', '2019-04-07 08:17:48'),
(4, 'Là một lập trình viên thì phải biết nhẫn lại', 'la-mot-lap-trinh-vien-thi-phai-biet-nhan-lai', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquam corporis dicta dolor, dolore dolorem eveniet ex facilis magnam molestiae officiis placeat quas quod sapiente sit temporibus velit voluptatibus.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquam corporis dicta dolor, dolore dolorem eveniet ex facilis magnam molestiae officiis placeat quas quod sapiente sit temporibus velit voluptatibus.</p>', 'duBVH18056787_244661169333842_472524775331721873_n.jpg', 'NguyenLongIT95', 'https://www.facebook.com/profile.php?id=100013698812957', 1, '2019-04-27 19:48:30', '2019-04-27 19:48:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute`
--

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL,
  `attribute` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute`
--

INSERT INTO `attribute` (`id`, `attribute`, `parent_id`, `created_at`, `updated_at`) VALUES
(3, 'Capacity', 0, '2019-03-10 01:55:23', '2019-03-10 01:55:23'),
(4, 'Electricity supply', 0, '2019-03-10 02:21:58', '2019-03-10 02:21:58'),
(5, 'Producer', 0, '2019-04-13 01:19:21', '2019-04-13 01:19:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(11) NOT NULL,
  `idAttribute` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `idAttribute`, `value`, `created_at`, `updated_at`) VALUES
(2, 3, '500W', '2019-03-10 01:55:23', '2019-03-10 01:55:23'),
(3, 4, '220V', '2019-03-10 02:21:58', '2019-04-13 01:19:36'),
(4, 5, 'Thống Nhất', '2019-04-13 01:19:21', '2019-04-13 01:19:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idCategoryBlog` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `info`, `description`, `author`, `tags`, `image`, `idCategoryBlog`, `created_at`, `updated_at`) VALUES
(1, 'Im a new coder', 'im-a-new-coder', '<p>An my email: nguyenlongit95@gmail.com</p>', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>\r\n\r\n<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo, et enim fugit expedita ullam laudantium minus quam.</p>\r\n\r\n<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo.</p>', 'LongNguyen', 'Coder', 'Ei0mhfirstBlog.jpg', 3, NULL, '2019-04-17 07:33:03'),
(3, 'Xây dựng một website chuẩn SEO', 'xay-dung-mot-website-chuan-seo', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur corporis, dignissimos dolorum eaque enim expedita facere, hic magnam necessitatibus numquam odit quidem similique sint, tempore. Deleniti itaque perspiciatis vero.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur corporis, dignissimos dolorum eaque enim expedita facere, hic magnam necessitatibus numquam odit quidem similique sint, tempore. Deleniti itaque perspiciatis vero.</p>\r\n\r\n<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo, et enim fugit expedita ullam laudantium minus quam.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo, et enim fugit expedita ullam laudantium minus quam.</p>', 'CoderLongNguyen', 'Chuẩn SEO', 'eI9lztest1.jpg', 3, '2019-02-28 03:00:58', '2019-02-28 03:06:22'),
(4, 'Dự án đầu tiên của tôi', 'du-an-dau-tien-cua-toi', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur corporis, dignissimos dolorum eaque enim expedita facere, hic magnam necessitatibus numquam odit quidem similique sint, tempore. Deleniti itaque perspiciatis vero.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur corporis, dignissimos dolorum eaque enim expedita facere, hic magnam necessitatibus numquam odit quidem similique sint, tempore. Deleniti itaque perspiciatis vero.</p>\r\n\r\n<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo.</p>', 'NguyenLongIT95', 'Coder', 'ay0Pklogo.png', 3, '2019-04-17 07:39:25', '2019-04-17 07:55:21'),
(5, 'abcabc', 'abcabc', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur corporis, dignissimos dolorum eaque enim expedita facere, hic magnam necessitatibus numquam odit quidem similique sint, tempore. Deleniti itaque perspiciatis vero.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur corporis, dignissimos dolorum eaque enim expedita facere, hic magnam necessitatibus numquam odit quidem similique sint, tempore. Deleniti itaque perspiciatis vero.</p>', 'NguyenLongIT95', 'Coder', '1V2t9logo.png', 2, '2019-04-17 07:41:25', '2019-04-17 07:41:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_blogs`
--

CREATE TABLE `categories_blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nameCategory` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories_blogs`
--

INSERT INTO `categories_blogs` (`id`, `nameCategory`, `info`, `parent_id`, `created_at`, `updated_at`) VALUES
(2, 'Society', 'Sharing about social issues and social issues', 0, '2018-09-09 07:58:34', '2018-09-09 07:58:34'),
(3, 'programming', ' Share your experiences in computer programming and related technology', 0, '2018-09-09 08:00:30', '2018-09-09 08:00:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_products`
--

CREATE TABLE `categories_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `nameCategory` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories_products`
--

INSERT INTO `categories_products` (`id`, `nameCategory`, `info`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'HouseHold', 'Here you will find support products for your beloved home', 0, NULL, '2018-09-08 08:38:35'),
(2, 'Technology', 'iste nulla quia similique veritatis voluptate. Accusantium animi minus recusandae vero. Iste, magnam voluptas.', 0, '2018-09-04 07:37:54', '2018-09-04 07:37:54'),
(3, 'Computer', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, ', 2, NULL, NULL),
(4, 'Television', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, ', 2, NULL, NULL),
(5, 'new Laptop', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam commodi consequatur culpa dolorem eligendi, excepturi fugiat illum itaque minima minus nemo quas qui repellat reprehenderit sint suscipit ut vel!</p>', 3, '2019-04-07 08:31:13', '2019-04-07 08:31:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `idBlog` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `idBlog`, `idUser`, `comment`, `author`, `parent_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'NguyenLongIT95', 0, 1, NULL, '2018-09-29 08:35:02'),
(2, 1, 2, 'Bài viết này hay quá ad ơi, cố gắng cho ra nhiều bài hay hơn nhé', 'LongNguyen', 0, 0, NULL, NULL),
(3, 1, 2, '<p>Thế n&agrave;y th&igrave; th&agrave;nh Java rồi c&ograve;n g&igrave;! Đ&acirc;u phải l&agrave; PHP nữa!!!!!</p>', 'ThanhNhan', 1, 1, '2018-09-10 17:00:00', '2019-04-27 20:33:45'),
(4, 1, 1, 'Bài viết cũng hay nhưng cần thêm nhiều nội dung hơn', 'LongNguyen', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `address`, `message`, `state`, `created_at`, `updated_at`) VALUES
(1, 'nguyenlongit95', 'nguyenlongit1308@gmail.com', 'Ha Noi', 'Im want build a website!', '1', NULL, '2018-10-07 01:49:04'),
(2, 'nguyenlongit95', 'nguyenlongit1308@gmail.com', 'Ha Noi', 'Im want build a website!', '0', NULL, '2018-10-07 01:48:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mã tiền tệ',
  `value` decimal(16,8) NOT NULL COMMENT '1 USD bằng bao nhiêu tiền này',
  `symbol_left` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_right` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seperator` enum('space','comma','dot') COLLATE utf8mb4_unicode_ci NOT NULL,
  `decimal` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `fiat` tinyint(1) NOT NULL DEFAULT 1,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `homepage` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Có cho hiện trên trang chủ hay ko',
  `sort` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `value`, `symbol_left`, `symbol_right`, `seperator`, `decimal`, `status`, `fiat`, `default`, `homepage`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Dollars', 'USD', '1.00000000', '$', NULL, 'comma', 2, 1, 1, 1, 1, 1, '2018-07-26 01:32:10', '2018-07-26 02:02:17'),
(2, 'Đồng', 'VND', '1.00000000', '$', NULL, 'comma', 0, 1, 1, 0, 1, 1, '2018-07-26 21:54:56', '2018-08-28 08:41:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `currencies_code`
--

CREATE TABLE `currencies_code` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Các mã code của tiền tệ trên thế giới';

--
-- Đang đổ dữ liệu cho bảng `currencies_code`
--

INSERT INTO `currencies_code` (`id`, `code`, `name`, `vname`, `icon`, `symbol`, `created_at`, `updated_at`) VALUES
(1, 'AED', 'United Arab Emirates Dirham', 'Các tiểu vương quốc Ả Rập thống nhất', '/storage/currency/UAEMoney.jpg', 'Dh', '2019-03-05 07:08:09', '2019-03-05 07:10:40'),
(2, 'AFN', 'Afghanistan Afghani', 'Cộng hòa hồi giáo Afganistan', '/storage/currency/afghanistan-currency-vector-icon-isolated-on-transparent-background-afghanistan-currency-logo-concept-P2D484.jpg', 'AVE', '2019-03-05 07:08:09', '2019-03-05 07:14:42'),
(3, 'ALL', 'Albania Lek', 'Cộng hòa Albania', '/storage/currency/Lek.png', '&#8356;', '2019-03-05 07:08:09', '2019-03-05 07:44:16'),
(4, 'AMD', 'Armenia Dram', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(5, 'ANG', 'Netherlands Antilles Guilder', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(6, 'AOA', 'Angola Kwanza', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(7, 'ARS', 'Argentina Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(8, 'AUD', 'Australia Dollar', 'Đô la Úc', '/storage/currency/australia-flag-icon-32.png', '&dollar;', '2019-03-05 07:08:09', '2019-03-06 09:07:53'),
(9, 'AWG', 'Aruba Guilder', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(10, 'AZN', 'Azerbaijan New Manat', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(11, 'BBD', 'Barbados Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(12, 'BDT', 'Bangladesh Taka', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(13, 'BGN', 'Bulgaria Lev', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(14, 'BHD', 'Bahrain Dinar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(15, 'BIF', 'Burundi Franc', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(16, 'BMD', 'Bermuda Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(17, 'BND', 'Brunei Darussalam Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(18, 'BOB', 'Bolivia Bolíviano', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(19, 'BRL', 'Brazil Real', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(20, 'BSD', 'Bahamas Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(21, 'BTC', 'Bitcoin', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(22, 'BTN', 'Bhutan Ngultrum', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(23, 'BWP', 'Botswana Pula', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(24, 'BYN', 'Belarus Ruble', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(25, 'BZD', 'Belize Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(26, 'CAD', 'Canada Dollar', 'Đô la Canada', '/storage/currency/canada-flag-icon-32.png', '&dollar;', '2019-03-05 07:08:09', '2019-03-06 09:08:26'),
(27, 'CDF', 'Congo/Kinshasa Franc', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(28, 'CHF', 'Switzerland Franc', 'France Thụy Sỹ', '/storage/currency/switzerland-flag-icon-32.png', '&#8381;', '2019-03-05 07:08:09', '2019-03-06 09:05:57'),
(29, 'CLP', 'Chile Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(30, 'CNY', 'China Yuan Renminbi', 'Nhân dân Tệ', '/storage/currency/china-flag-icon-32.png', '¥', '2019-03-05 07:08:09', '2019-03-06 09:13:53'),
(31, 'COP', 'Colombia Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(32, 'CRC', 'Costa Rica Colon', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(33, 'CUC', 'Cuba Convertible Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(34, 'CUP', 'Cuba Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(35, 'CVE', 'Cape Verde Escudo', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(36, 'CZK', 'Czech Republic Koruna', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(37, 'DJF', 'Djibouti Franc', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(38, 'DKK', 'Denmark Krone', 'Đồng Krone Đan Mạch', '/storage/currency/denmark-flag-icon-32.png', '&#8365;', '2019-03-05 07:08:09', '2019-03-06 09:11:34'),
(39, 'DOP', 'Dominican Republic Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(40, 'DZD', 'Algeria Dinar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(41, 'EGP', 'Egypt Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(42, 'ERN', 'Eritrea Nakfa', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(43, 'ETB', 'Ethiopia Birr', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(44, 'ETH', 'Ethereum', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(45, 'EUR', 'Euro Member Countries', 'Euro', '/storage/currency/eu.png', '&#128;', '2019-03-05 07:08:09', '2019-03-08 09:17:19'),
(46, 'FJD', 'Fiji Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(47, 'GBP', 'United Kingdom Pound', 'Bảng Anh', '/storage/currency/united-kingdom-flag-icon-32.png', '£', '2019-03-05 07:08:09', '2019-03-06 09:52:38'),
(48, 'GEL', 'Georgia Lari', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(49, 'GGP', 'Guernsey Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(50, 'GHS', 'Ghana Cedi', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(51, 'GIP', 'Gibraltar Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(52, 'GMD', 'Gambia Dalasi', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(53, 'GNF', 'Guinea Franc', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(54, 'GTQ', 'Guatemala Quetzal', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(55, 'GYD', 'Guyana Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(56, 'HKD', 'Hong Kong Dollar', 'Đô la Hồng Kông', '/storage/currency/china-flag-icon-32.png', '&#8365;', '2019-03-05 07:08:09', '2019-03-06 08:29:47'),
(57, 'HNL', 'Honduras Lempira', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(58, 'HRK', 'Croatia Kuna', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(59, 'HTG', 'Haiti Gourde', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(60, 'HUF', 'Hungary Forint', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(61, 'IDR', 'Indonesia Rupiah', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(62, 'ILS', 'Israel Shekel', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(63, 'IMP', 'Isle of Man Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(64, 'INR', 'India Rupee', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(65, 'IQD', 'Iraq Dinar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(66, 'IRR', 'Iran Rial', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(67, 'ISK', 'Iceland Krona', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(68, 'JEP', 'Jersey Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(69, 'JMD', 'Jamaica Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(70, 'JOD', 'Jordan Dinar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(71, 'JPY', 'Japan Yen', 'Yên Nhật', '/storage/currency/japan-flag-icon-32.png', '&#165;', '2019-03-05 07:08:09', '2019-03-06 09:52:52'),
(72, 'KES', 'Kenya Shilling', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(73, 'KGS', 'Kyrgyzstan Som', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(74, 'KHR', 'Cambodia Riel', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(75, 'KMF', 'Comoros Franc', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(76, 'KPW', 'Korea (North) Won', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(77, 'KRW', 'Korea (South) Won', 'Won Hàn Quốc', '/storage/currency/Korea-Flag-icon.png', '&#8361;', '2019-03-05 07:08:09', '2019-03-06 09:53:20'),
(78, 'KWD', 'Kuwait Dinar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(79, 'KYD', 'Cayman Islands Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(80, 'KZT', 'Kazakhstan Tenge', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(81, 'LAK', 'Laos Kip', 'Kíp Lào', '/storage/app/public/currency/laos-flag-icon-32.png', '&#8365;', '2019-03-05 07:08:09', '2019-03-06 09:10:50'),
(82, 'LBP', 'Lebanon Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(83, 'LKR', 'Sri Lanka Rupee', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(84, 'LRD', 'Liberia Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(85, 'LSL', 'Lesotho Loti', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(86, 'LTC', 'Litecoin', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(87, 'LYD', 'Libya Dinar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(88, 'MAD', 'Morocco Dirham', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(89, 'MDL', 'Moldova Leu', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(90, 'MGA', 'Madagascar Ariary', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(91, 'MKD', 'Macedonia Denar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(92, 'MMK', 'Myanmar (Burma) Kyat', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(93, 'MNT', 'Mongolia Tughrik', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(94, 'MOP', 'Macau Pataca', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(95, 'MRO', 'Mauritania Ouguiya', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(96, 'MUR', 'Mauritius Rupee', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(97, 'MWK', 'Malawi Kwacha', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(98, 'MXN', 'Mexico Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(99, 'MYR', 'Malaysia Ringgit', 'Renggit Malaysia', '/storage/currency/myanmar-flag-icon-32.png', '&#8360;', '2019-03-05 07:08:09', '2019-03-06 09:18:03'),
(100, 'MZN', 'Mozambique Metical', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(101, 'NAD', 'Namibia Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(102, 'NGN', 'Nigeria Naira', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(103, 'NIO', 'Nicaragua Cordoba', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(104, 'NOK', 'Norway Krone', 'Krone Phần Lan', '/storage/currency/norway-flag-icon-32.png', '&#8365;', '2019-03-05 07:08:09', '2019-03-06 09:12:58'),
(105, 'NPR', 'Nepal Rupee', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(106, 'NZD', 'New Zealand Dollar', 'Dollar New Zealand', '/storage/currency/new-zealand-flag-icon-32.png', '&dollar;', '2019-03-05 07:08:09', '2019-03-06 09:15:53'),
(107, 'OMR', 'Oman Rial', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(108, 'PAB', 'Panama Balboa', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(109, 'PEN', 'Peru Sol', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(110, 'PGK', 'Papua New Guinea Kina', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(111, 'PHP', 'Philippines Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(112, 'PKR', 'Pakistan Rupee', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(113, 'PLN', 'Poland Zloty', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(114, 'PYG', 'Paraguay Guarani', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(115, 'QAR', 'Qatar Riyal', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(116, 'RON', 'Romania New Leu', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(117, 'RSD', 'Serbia Dinar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(118, 'RUB', 'Russia Ruble', 'Ruble liên bang Nga', '/storage/currency/russia-flag-icon-32.png', '&#8360;', '2019-03-05 07:08:09', '2019-03-06 09:15:02'),
(119, 'RWF', 'Rwanda Franc', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(120, 'SAR', 'Saudi Arabia Riyal', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(121, 'SCR', 'Seychelles Rupee', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(122, 'SDG', 'Sudan Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(123, 'SEK', 'Sweden Krona', 'Krona Thụy Điển', '/storage/sweden-flag-icon-32.png', '&cent;', '2019-03-05 07:08:09', '2019-03-06 09:09:57'),
(124, 'SGD', 'Singapore Dollar', 'Đô la Singapore', '/storage/currency/singapore-flag-icon-32.png', '&dollar;', '2019-03-05 07:08:09', '2019-03-06 09:09:19'),
(125, 'SHP', 'Saint Helena Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(126, 'SLL', 'Sierra Leone Leone', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(127, 'SOS', 'Somalia Shilling', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(128, 'SPL', 'Seborga Luigino', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(129, 'SRD', 'Suriname Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(130, 'SVC', 'El Salvador Colon', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(131, 'SYP', 'Syria Pound', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(132, 'SZL', 'Swaziland Lilangeni', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(133, 'THB', 'Thailand Baht', 'Bạt Thái Lan', '/storage/currency/thailand-flag-icon-32.png', '&#3647;', '2019-03-05 07:08:09', '2019-03-06 09:06:20'),
(134, 'TJS', 'Tajikistan Somoni', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(135, 'TMT', 'Turkmenistan Manat', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(136, 'TND', 'Tunisia Dinar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(137, 'TOP', 'Tonga Pa\'anga', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(138, 'TRY', 'Turkey Lira', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(139, 'TVD', 'Tuvalu Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(140, 'TWD', 'Taiwan New Dollar', 'Đô la Đài Loan', '/storage/currency/Taiwan-512.png', '角', '2019-03-05 07:08:09', '2019-03-06 09:21:16'),
(141, 'TZS', 'Tanzania Shilling', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(142, 'UAH', 'Ukraine Hryvnia', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(143, 'UGX', 'Uganda Shilling', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(144, 'USD', 'United States Dollar', 'Đô La Mỹ', '', '$', '2019-03-05 07:08:09', '2019-03-06 09:51:52'),
(145, 'UYU', 'Uruguay Peso', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(146, 'UZS', 'Uzbekistan Som', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(147, 'VEF', 'Venezuela Bolivar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(148, 'VND', 'Viet Nam Dong', 'Việt Nam Đồng', '/storage/currency/vn.png', '&#8363;', '2019-03-05 07:08:09', '2019-03-08 09:21:25'),
(149, 'VUV', 'Vanuatu Vatu', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(150, 'WST', 'Samoa Tala', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(151, 'YER', 'Yemen Rial', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(152, 'ZAR', 'South Africa Rand', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(153, 'ZMW', 'Zambia Kwacha', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09'),
(154, 'ZWD', 'Zimbabwe Dollar', '', NULL, '', '2019-03-05 07:08:09', '2019-03-05 07:08:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `custom_properties`
--

CREATE TABLE `custom_properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `idProduct` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `custom_properties`
--

INSERT INTO `custom_properties` (`id`, `idProduct`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(14, 1, 3, '2019-03-10 03:09:17', '2019-03-10 03:09:17'),
(15, 1, 4, '2019-04-13 01:19:21', '2019-04-13 01:19:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_products`
--

CREATE TABLE `image_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `imageproduct` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idProduct` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `image_products`
--

INSERT INTO `image_products` (`id`, `imageproduct`, `idProduct`, `created_at`, `updated_at`) VALUES
(1, 'of1.png', 1, NULL, NULL),
(2, 'of2.png', 2, NULL, NULL),
(3, 'of3.png', 3, NULL, NULL),
(4, 'of4.png', 4, NULL, NULL),
(5, 'nPDof56.png', 1, '2018-12-09 20:28:28', '2018-12-09 20:28:28'),
(6, 'uBZof34.png', 1, '2018-12-09 20:28:38', '2018-12-09 20:28:38'),
(7, 'Ec71.jpg', 1, '2019-04-13 01:12:54', '2019-04-13 01:12:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `info_of_pages`
--

CREATE TABLE `info_of_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `pagename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `info_of_pages`
--

INSERT INTO `info_of_pages` (`id`, `pagename`, `info`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Abouts', 'Lorem', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,', NULL, NULL),
(2, 'Contact', 'Lorem', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `linkeds`
--

CREATE TABLE `linkeds` (
  `id` int(10) UNSIGNED NOT NULL,
  `linked` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `linkeds`
--

INSERT INTO `linkeds` (`id`, `linked`, `value`, `created_at`, `updated_at`) VALUES
(1, 'FaceBook', 'https://www.facebook.com/profile.php?id=100013698812957', NULL, NULL),
(2, 'Google', 'https://www.facebook.com/profile.php?id=100013698812957', NULL, NULL),
(3, 'Linked', 'linked.com', NULL, NULL),
(4, 'Courses', 'Courses.com.vn', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `mails`
--

INSERT INTO `mails` (`id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(2, '', 'nguyenlongit95@gmail.com', 'thanhnhan96', 0, '2019-06-24 02:27:22', '2019-06-24 02:33:40'),
(3, '', 'nguyenlongit1308@gmail.com', 'thanhnhan96', 1, '2019-06-24 02:32:23', '2019-06-24 02:33:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL COMMENT 'Quy định xem menu này thuộc menu cha nào',
  `level` int(11) NOT NULL COMMENT 'Menu sẽ có chung level, nếu chung 1 Level thì thuộc chung 1 menu',
  `count_child` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `info` varchar(500) COLLATE ucs2_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL COMMENT 'Quy định thứ tự của menu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `parent_id`, `level`, `count_child`, `status`, `info`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Socients', 'socients', 0, 1, 0, 1, 'Menu hạng nhất', 0, '2019-06-27 06:52:03', '2019-06-26 23:52:03'),
(2, 'Programming', 'programming', 0, 1, 0, 1, '', 0, '2019-06-27 03:59:57', '2018-12-29 20:48:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_30_095434_create_products_table', 1),
(4, '2018_08_30_095446_create_custom_properties_table', 1),
(5, '2018_08_30_095502_create_image_products_table', 1),
(6, '2018_08_30_095512_create_rattings_table', 1),
(7, '2018_08_30_095533_create_categories_blogs_table', 1),
(8, '2018_08_30_095540_create_blogs_table', 1),
(9, '2018_08_30_095550_create_categories_products_table', 1),
(10, '2018_08_30_095620_create_contacts_table', 1),
(11, '2018_08_30_095626_create_sliders_table', 1),
(12, '2018_08_30_095635_create_linkeds_table', 1),
(13, '2018_08_30_095645_create_info_of_pages_table', 1),
(14, '2018_08_30_095655_create_orders_table', 1),
(15, '2018_08_30_095710_create_order_details_table', 1),
(16, '2018_08_30_095726_create_state_orders_table', 1),
(17, '2018_08_30_100921_create_comments_table', 1),
(18, '2018_08_30_103646_create_token_a_p_is_table', 2),
(19, '2018_09_02_021823_create_articles_table', 3),
(20, '2018_12_30_104051_create_permission_tables', 4),
(21, '2018_12_30_133519_create_permission_tables', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUser` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `idUser`, `name`, `address`, `phone`, `total`, `code_order`, `created_at`, `updated_at`) VALUES
(1, '1', 'Nguyen Cong Thai Long', '<p>Ngoc Truc market, Dai Mo, Nam Tu Liem, Ha Noi</p>', '+84693803548', '300', 'abc123123', NULL, '2019-04-27 19:56:22'),
(2, '1', 'Nguyen Cong Thai Long', 'Ha Noi', '+84693803548', '2', 'abc123123', NULL, NULL),
(3, '1', 'Nguyen Cong Thai Long', 'Ha Noi', '+84693803548', '2', 'abc123123', NULL, NULL),
(4, '1', 'Nguyen Cong Thai Long', 'Ha Noi', '+84693803548', '2', 'abc123123', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `idProduct`, `idOrder`, `product_name`, `quantity`, `price`, `code_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Fan Electric A960', '1', '100', 'abc123123', NULL, NULL),
(2, 1, 1, 'Fan Electric A960', '1', '100', 'abc123123', NULL, NULL),
(3, 1, 1, 'Fan Electric A960', '1', '100', 'abc123123', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paygates`
--

CREATE TABLE `paygates` (
  `id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `withdraw` tinyint(4) NOT NULL DEFAULT 0,
  `withdrawField` text DEFAULT NULL,
  `deposit` tinyint(4) NOT NULL DEFAULT 0,
  `payment` tinyint(4) NOT NULL DEFAULT 0,
  `instant` tinyint(4) DEFAULT 0,
  `verify` tinyint(4) DEFAULT 0,
  `convert` tinyint(4) DEFAULT 0,
  `description` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `configs` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `w_fixed_fees` decimal(16,4) DEFAULT 0.0000,
  `w_percent_fees` decimal(16,4) DEFAULT 0.0000,
  `w_daily_limit` decimal(16,4) DEFAULT NULL,
  `w_country_block` varchar(255) DEFAULT NULL,
  `w_min` decimal(16,4) DEFAULT NULL,
  `w_max` decimal(16,4) DEFAULT NULL,
  `w_nofees` decimal(16,4) DEFAULT NULL,
  `d_fixed_fees` decimal(16,4) DEFAULT 0.0000,
  `d_percent_fees` decimal(16,4) DEFAULT 0.0000,
  `d_daily_limit` decimal(16,4) DEFAULT NULL,
  `d_country_block` varchar(255) DEFAULT NULL,
  `d_min` decimal(16,4) DEFAULT NULL,
  `d_max` decimal(16,4) DEFAULT NULL,
  `d_nofees` decimal(16,4) DEFAULT NULL,
  `p_fixed_fees` decimal(16,4) DEFAULT 0.0000,
  `p_percent_fees` decimal(16,4) DEFAULT 0.0000,
  `p_daily_limit` decimal(16,4) DEFAULT NULL,
  `p_country_block` varchar(255) DEFAULT NULL,
  `p_min` decimal(16,4) DEFAULT NULL,
  `p_max` decimal(16,4) DEFAULT NULL,
  `p_nofees` decimal(16,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `paygates`
--

INSERT INTO `paygates` (`id`, `currency_id`, `currency_code`, `code`, `name`, `withdraw`, `withdrawField`, `deposit`, `payment`, `instant`, `verify`, `convert`, `description`, `avatar`, `url`, `configs`, `status`, `w_fixed_fees`, `w_percent_fees`, `w_daily_limit`, `w_country_block`, `w_min`, `w_max`, `w_nofees`, `d_fixed_fees`, `d_percent_fees`, `d_daily_limit`, `d_country_block`, `d_min`, `d_max`, `d_nofees`, `p_fixed_fees`, `p_percent_fees`, `p_daily_limit`, `p_country_block`, `p_min`, `p_max`, `p_nofees`, `created_at`, `updated_at`) VALUES
(32, 1, 'USD', 'Paypal', 'Cổng thanh toán Paypal', 0, '[]', 1, 1, 1, 0, 0, NULL, '', 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=', '{\"Username\":\"hotronet-facilitator_api1.gmail.com\",\"Password\":\"H87VKTFX25KNEVRQ\",\"Signature\":\"AGDCcKtP7R4eJmVDXJXTC83ZHtDKANy30svKSQ.QreY.6AEclT6iM-6C\",\"CurrencyCode\":\"USD\"}', 1, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, '2019-06-18 10:44:41', '2019-06-18 09:24:13'),
(33, 1, 'USD', 'Nganluong', 'Ví Ngân Lượng', 0, '[]', 1, 1, 1, 0, 0, '', '', 'https://www.nganluong.vn/checkout.php', '{\"receiver\":\"demo@nganluong.vn\",\"merchant_id\":\"36680\",\"merchant_pass\":\"matkhauketnoi\",\"affiliate_code\":\"\"}', 1, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 1, 'USD', 'OnepayND', 'Onepay Nội địa', 0, '[]', 1, 1, 1, 0, 0, '', '', 'http://mtf.onepay.vn/onecomm-pay/vpc.op', '{\"merchant_id\":\"\",\"access_code\":\"\",\"secure_secret\":\"\"}', 1, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, '2019-06-30 20:30:58', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paygates_logs`
--

CREATE TABLE `paygates_logs` (
  `id` int(11) NOT NULL,
  `order_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) DEFAULT NULL,
  `pay_amount` decimal(16,5) NOT NULL,
  `currency_id` tinyint(4) DEFAULT NULL,
  `currency_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_logs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_logs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `callback_logs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `paygates_logs`
--

INSERT INTO `paygates_logs` (`id`, `order_code`, `user`, `pay_amount`, `currency_id`, `currency_code`, `provider`, `bank_code`, `post_logs`, `payment_logs`, `callback_logs`, `ip`, `country`, `user_agent`, `created_at`, `updated_at`) VALUES
(19, 'D155627804775921', 25, '5000.00000', NULL, NULL, 'Vietcombank', NULL, 'username=2182635A59&password=Xuanhk2011@&stk=0031000495366&noidung=D155627804775921++CAN_THAN_LUA_DAO++>>>GOI:0943793984&sotien=5000', '{\n  \"errorCode\": 1,\n  \"message\": \"khong co giao dich\"\n}', NULL, NULL, NULL, NULL, '2019-04-26 14:15:07', '2019-04-26 14:15:07'),
(20, 'D155629360337653', 25, '6000.00000', NULL, NULL, 'Vietcombank', NULL, 'username=2182635A59&password=Xuanhk2011@&stk=0031000495366&noidung=D155629360337653++CAN_THAN_LUA_DAO++GOI:0943793984&sotien=6000', '{\n  \"errorCode\": 1,\n  \"message\": \"khong co giao dich\"\n}', NULL, NULL, NULL, NULL, '2019-04-26 15:51:42', '2019-04-26 15:51:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'all', 'web', '2019-01-01 06:25:06', '2019-01-01 06:25:06'),
(2, 'user', 'web', '2019-01-01 20:50:02', '2019-01-01 20:50:02'),
(3, 'list-blog', 'web', '2019-01-01 20:50:15', '2019-01-01 20:50:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCategories` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `sales` int(11) NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_name`, `idCategories`, `quantity`, `price`, `sales`, `info`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fan Electric A970', 1, 22, 100, 5, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 46 BC, making it over 2000 years old. Richard McClintock,</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 46 BC, making it over 2000 years old. Richard McClintock,Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 46 BC, making it over 2000 years old. Richard McClintock,</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 46 BC, making it over 2000 years old. Richard McClintock,</p>', NULL, '2019-04-13 01:20:30'),
(2, 'Nature 2210', 1, 15, 110, 6, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>', NULL, '2018-09-13 19:51:17'),
(3, 'Pizza Nutrela', 2, 7, 120, 10, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>', NULL, '2018-09-13 19:51:08'),
(4, 'Tomato Lays', 2, 15, 101, 15, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>', NULL, '2018-09-13 19:50:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rattings`
--

CREATE TABLE `rattings` (
  `id` int(10) UNSIGNED NOT NULL,
  `idProduct` int(11) NOT NULL,
  `ratting` int(11) NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rattings`
--

INSERT INTO `rattings` (`id`, `idProduct`, `ratting`, `info`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '<p>Sản phẩm này không ổn đâu shop ơi!</p>', NULL, '2018-09-18 06:08:33'),
(2, 1, 4, '<p>Sản phẩm dùng cũng được đó shop</p>', NULL, '2018-09-28 00:52:37'),
(3, 1, 3, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>', NULL, NULL),
(4, 2, 1, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'BACKEND', 'web', '2019-01-01 06:24:05', '2019-01-01 20:55:25'),
(2, 'SUPER_ADMIN', 'web', '2019-01-01 20:41:05', '2019-01-01 20:55:15'),
(3, 'USER', 'web', '2019-01-01 20:41:41', '2019-01-01 20:41:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `checksum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `h1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noindex` int(2) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `seo`
--

INSERT INTO `seo` (`id`, `link`, `checksum`, `title`, `keywords`, `description`, `h1`, `noindex`, `avatar`, `language`, `created_at`, `updated_at`) VALUES
(1, '/', '6666cd76f96956469e7be39d750cc7d9', 'The home page', 'Base App the home page', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque dignissimos, facere fuga fugiat id impedit, laboriosam maiores neque quibusdam quisquam recusandae, saepe sit voluptas. Eius illum minima obcaecati tenetur voluptates!</p>', 'BaseAppThePage', 1, 'UYXJw_18056787_244661169333842_472524775331721873_n.jpg', 'vi', '2019-04-29 15:37:52', '2019-04-29 08:37:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(250) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'favicon', '/storage/userfiles/images/nencer-fav.png', NULL, '2019-01-25 09:56:44'),
(2, 'backendlogo', '/storage/userfiles/images/nencer-logo.png', NULL, '2019-01-25 09:56:44'),
(3, 'name', 'Long Nguyen', NULL, '2019-01-25 09:56:44'),
(4, 'title', 'Upload lưu trữ file không giới hạn, miễn phí và an toàn', NULL, '2019-01-25 09:56:44'),
(5, 'description', 'Ứng dụng lõi của mọi phần mềm và hệ thống', NULL, '2019-01-25 09:56:44'),
(6, 'language', 'N/A', NULL, '2019-01-25 09:56:44'),
(7, 'phone', '943793984', NULL, '2019-01-25 09:56:44'),
(8, 'twitter', 'fb.com/admin', NULL, '2019-01-25 09:56:44'),
(9, 'email', 'nguyenlongit95@gmail.com', NULL, '2019-01-25 09:56:44'),
(10, 'facebook', '35/45 Tran Thai Tong, Cau Giay, Ha Noi', NULL, '2019-01-25 09:56:44'),
(11, 'logo', '/storage/userfiles/images/nencer.png', NULL, '2019-01-25 09:56:44'),
(12, 'hotline', '0123456789', NULL, '2019-01-25 09:56:44'),
(13, 'backendname', 'AdminLTE', NULL, '2019-01-25 09:56:44'),
(14, 'backendlang', 'N/A', NULL, '2019-01-25 09:56:44'),
(15, 'copyright', 'Website đang chờ xin giấy phép của bộ TTTT.', NULL, '2019-01-25 09:56:44'),
(16, 'timezone', 'Asia/Ho_Chi_Minh', NULL, '2019-01-25 09:56:44'),
(17, 'googleplus', 'fb.com/admin', NULL, '2019-01-25 09:56:44'),
(18, 'websitestatus', 'ONLINE', NULL, '2019-01-25 09:56:44'),
(19, 'address', '35/45 Tran Thai Tong, Cau Giay, Ha Noi', '2018-08-21 03:53:44', '2019-01-25 09:56:44'),
(21, 'default_user_group', '2', '2018-08-21 04:06:25', '2019-01-25 09:56:44'),
(22, 'twofactor', 'none', '2018-09-05 14:17:56', '2019-01-25 09:56:44'),
(23, 'fronttemplate', 'default', '2018-09-25 06:29:14', '2019-01-25 09:56:44'),
(24, 'offline_mes', 'Website đang bảo trì!', NULL, '2019-01-25 09:56:44'),
(25, 'smsprovider', 'none', '2018-10-09 10:17:08', '2019-01-25 09:56:44'),
(26, 'youtube', 'https://www.youtube.com/watch?v=neCmEbI2VWg', NULL, '2019-01-25 09:56:44'),
(27, 'globalpopup', '0', NULL, '2019-01-25 09:56:44'),
(28, 'globalpopup_mes', '<p>Chưa c&oacute; nội dung g&igrave;</p>', NULL, '2019-01-25 09:56:44'),
(29, 'social_login', '0', NULL, '2019-01-25 09:56:44'),
(30, 'google_analytic_id', '30', NULL, '2019-01-25 09:56:44'),
(31, 'header_js', 'N/A', NULL, '2019-01-25 09:56:44'),
(32, 'footer_js', 'N/A', NULL, '2019-01-25 09:56:44'),
(33, 'home_tab_active', 'Softcard', NULL, '2019-01-25 09:56:44'),
(34, 'fileSecretkey', '12345678', NULL, NULL),
(35, 'affiliate', 'http://localhost/core/public/user/register/', NULL, '2019-01-14 08:33:48'),
(36, 'top_bg', 'N/A', '2019-01-23 06:42:05', '2019-01-25 09:56:44'),
(37, 'slide_bg', 'N/A', '2019-01-23 06:42:05', '2019-01-25 09:56:44'),
(38, 'footer_bg', 'N/A', '2019-01-23 06:42:05', '2019-01-25 09:56:44'),
(39, 'top_color', 'N/A', '2019-01-23 06:42:05', '2019-01-25 09:56:44'),
(40, 'allow_transfer', '0', '2019-01-23 06:42:05', '2019-01-25 09:56:44'),
(41, 'type_slider', 'slider', '2019-01-23 06:42:05', '2019-01-25 09:56:44'),
(42, 'countdown', '30', NULL, '2019-01-25 09:56:44'),
(43, 'footerlogo', '/storage/userfiles/images/nencer-logo-gray.png', NULL, NULL),
(44, 'logo', '/storage/userfiles/images/nencer-logo.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `sliders` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `sliders`, `slogan`, `created_at`, `updated_at`) VALUES
(1, 'nguyenlongit95.jpg', 'nguyenlongit95@gmail.com', NULL, NULL),
(2, 'nguyenlongit95.jpg', 'nguyenlongit95@gmail.com', NULL, NULL),
(3, 'R4U_18056787_244661169333842_472524775331721873_n.jpg', 'Ngôn ngữ lập trình PHP', '2019-04-29 02:10:29', '2019-04-29 02:10:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `state_orders`
--

CREATE TABLE `state_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `idOrder` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `state_orders`
--

INSERT INTO `state_orders` (`id`, `idOrder`, `state`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tokenapis`
--

CREATE TABLE `tokenapis` (
  `id` int(10) UNSIGNED NOT NULL,
  `partner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `level` int(11) NOT NULL COMMENT 'Nếu là 1 thì là admin, 0 thì là User và còn thêm tùy theo yêu cầu',
  `avatar` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nguyenlongit95', 'nguyenlongit95@gmail.com', '$2y$10$/XiVXPWQ5Ol2RmUitWDmKebYsyMJfoS/ohx8Z5NTLbDd6zoot53fe', 1, 'default.png', 'VTDzDn8ao1SRxzihv7ECKrk95SAcQ5dDglG47zMYEqJsDARqIwpxALxLhPKe', '2019-02-23 03:47:51', '2018-08-30 14:18:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `widgets`
--

CREATE TABLE `widgets` (
  `id` int(11) NOT NULL,
  `item` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE ucs2_unicode_ci NOT NULL,
  `idItem` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT 'Quy định loại của widget: 1 là menu, 2 là sidebar, 3 là footermenu v.v...',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories_blogs`
--
ALTER TABLE `categories_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories_products`
--
ALTER TABLE `categories_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_status_index` (`status`),
  ADD KEY `currencies_hide_index` (`homepage`);

--
-- Chỉ mục cho bảng `custom_properties`
--
ALTER TABLE `custom_properties`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `image_products`
--
ALTER TABLE `image_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `info_of_pages`
--
ALTER TABLE `info_of_pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `linkeds`
--
ALTER TABLE `linkeds`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `paygates`
--
ALTER TABLE `paygates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `paygates_logs`
--
ALTER TABLE `paygates_logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rattings`
--
ALTER TABLE `rattings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `checksum` (`checksum`),
  ADD KEY `link` (`link`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `state_orders`
--
ALTER TABLE `state_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tokenapis`
--
ALTER TABLE `tokenapis`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `categories_blogs`
--
ALTER TABLE `categories_blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `categories_products`
--
ALTER TABLE `categories_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `custom_properties`
--
ALTER TABLE `custom_properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `image_products`
--
ALTER TABLE `image_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `info_of_pages`
--
ALTER TABLE `info_of_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `linkeds`
--
ALTER TABLE `linkeds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `paygates`
--
ALTER TABLE `paygates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `paygates_logs`
--
ALTER TABLE `paygates_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `rattings`
--
ALTER TABLE `rattings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `state_orders`
--
ALTER TABLE `state_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tokenapis`
--
ALTER TABLE `tokenapis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
