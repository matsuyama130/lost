-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-21 02:56:13
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `lost_factory`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `check_table`
--

CREATE TABLE `check_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lost_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `check_table`
--

INSERT INTO `check_table` (`id`, `user_id`, `lost_id`, `created_at`) VALUES
(14, 5, 10, '2022-01-21 10:34:57'),
(15, 5, 6, '2022-01-21 10:35:17'),
(16, 5, 11, '2022-01-21 10:35:17'),
(17, 5, 4, '2022-01-21 10:35:18'),
(18, 5, 9, '2022-01-21 10:35:18'),
(23, 5, 2, '2022-01-21 10:43:52'),
(25, 5, 8, '2022-01-21 10:51:17'),
(27, 5, 7, '2022-01-21 10:51:39');

-- --------------------------------------------------------

--
-- テーブルの構造 `lost_table`
--

CREATE TABLE `lost_table` (
  `id` int(11) NOT NULL,
  `tool` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `takeout` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `waypoint1` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `waypoint2` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `waypoint3` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `lost_table`
--

INSERT INTO `lost_table` (`id`, `tool`, `takeout`, `created_at`, `updated_at`, `waypoint1`, `waypoint2`, `waypoint3`) VALUES
(2, 'マイクロ', '2022-01-12', '2022-01-12 19:10:55', '2022-01-12 19:10:55', '', '', ''),
(3, 'ノギス', '2022-01-13', '2022-01-12 19:29:50', '2022-01-12 19:29:50', '', '', ''),
(4, '三菱', '2022-01-26', '2022-01-12 19:52:56', '2022-01-12 19:52:56', '', '', ''),
(6, 'aaa', '2022-01-15', '2022-01-14 16:59:22', '2022-01-14 16:59:22', '', '', ''),
(7, 'aaa', '2022-01-06', '2022-01-14 17:00:37', '2022-01-14 17:00:37', '', '', ''),
(8, 'aaaaaa', '2022-01-01', '2022-01-14 17:02:04', '2022-01-14 17:02:04', '', '', ''),
(9, 'a', '2022-01-30', '2022-01-14 17:05:06', '2022-01-14 17:05:06', '', '', ''),
(10, 'aaaa', '2022-01-12', '2022-01-14 17:06:46', '2022-01-14 17:06:46', '', '', ''),
(11, 'aaa', '2022-01-20', '2022-01-14 17:08:23', '2022-01-14 17:08:23', '', '', ''),
(12, 'eeee', '2022-01-13', '2022-01-14 17:09:18', '2022-01-14 17:09:18', '', '', ''),
(13, 'aa', '2022-01-15', '2022-01-20 15:45:50', '2022-01-20 15:45:50', '', '', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'testuser01', '111111', 1, 0, '2022-01-12 19:26:36', '2022-01-12 19:26:36'),
(2, 'testuser02', '222222', 0, 0, '2022-01-12 19:26:36', '2022-01-12 19:26:36'),
(3, 'testuser03', '333333', 0, 0, '2022-01-12 19:26:36', '2022-01-12 19:26:36'),
(4, 'testuser04', '444444', 0, 0, '2022-01-12 19:26:36', '2022-01-12 19:26:36'),
(5, 'hibiki', '1234', 0, 0, '2022-01-12 19:26:46', '2022-01-12 19:26:46');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `check_table`
--
ALTER TABLE `check_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `lost_table`
--
ALTER TABLE `lost_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `check_table`
--
ALTER TABLE `check_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- テーブルの AUTO_INCREMENT `lost_table`
--
ALTER TABLE `lost_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
