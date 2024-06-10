-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-06-10 15:12:45
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `files`
--

-- --------------------------------------------------------

--
-- 資料表結構 `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `images`
--

INSERT INTO `images` (`id`, `file_name`, `type`, `size`) VALUES
(12, '20240610201906.jpg', 'image/jpeg', 229980),
(13, '20240610210601.jpg', 'image/jpeg', 237571);

-- --------------------------------------------------------

--
-- 資料表結構 `method`
--

CREATE TABLE `method` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `method_ch_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `method`
--

INSERT INTO `method` (`id`, `name`, `method_ch_name`) VALUES
(1, 'Oil_paint', '油彩'),
(2, 'Watercolor', '水彩'),
(3, 'Acrylic_Paint', '丙烯畫');

-- --------------------------------------------------------

--
-- 資料表結構 `purpose`
--

CREATE TABLE `purpose` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `purpose_ch_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `purpose`
--

INSERT INTO `purpose` (`id`, `name`, `purpose_ch_name`) VALUES
(1, 'landscape', '風景'),
(2, 'still_life', '靜物'),
(3, 'portrait', '肖像'),
(4, 'pet_portrait', '寵物肖像');

-- --------------------------------------------------------

--
-- 資料表結構 `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `size`
--

INSERT INTO `size` (`id`, `size_name`) VALUES
(1, '12F'),
(2, '10F'),
(3, '8P'),
(4, '8F');

-- --------------------------------------------------------

--
-- 資料表結構 `style`
--

CREATE TABLE `style` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `style_ch_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `style`
--

INSERT INTO `style` (`id`, `name`, `style_ch_name`) VALUES
(1, 'vertical', '直幅'),
(2, 'horizontal', '橫幅');

-- --------------------------------------------------------

--
-- 資料表結構 `text`
--

CREATE TABLE `text` (
  `id` int(11) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `original_name` text NOT NULL,
  `description` text NOT NULL,
  `style` int(2) NOT NULL,
  `method` int(10) NOT NULL,
  `purpose` int(10) NOT NULL,
  `size` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `text`
--

INSERT INTO `text` (`id`, `file_name`, `original_name`, `description`, `style`, `method`, `purpose`, `size`) VALUES
(12, '20240610201906.jpg', '314234', '534534', 1, 1, 1, 1),
(13, '20240610210601.jpg', 'gyegt', 'thfgfge', 1, 1, 1, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `purpose`
--
ALTER TABLE `purpose`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `text`
--
ALTER TABLE `text`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `method`
--
ALTER TABLE `method`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purpose`
--
ALTER TABLE `purpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `style`
--
ALTER TABLE `style`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `text`
--
ALTER TABLE `text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
