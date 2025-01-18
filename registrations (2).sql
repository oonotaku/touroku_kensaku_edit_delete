-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql3104.db.sakura.ne.jp
-- 生成日時: 2025 年 1 月 18 日 13:01
-- サーバのバージョン： 8.0.40
-- PHP のバージョン: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `takkun-da_node-bee-test`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `registrations`
--

CREATE TABLE `registrations` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `memo` text COLLATE utf8mb4_general_ci,
  `photo_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `registrations`
--

INSERT INTO `registrations` (`id`, `name`, `email`, `password`, `company`, `position`, `memo`, `photo_path`, `created_at`) VALUES
(13, '大谷翔平', 'ohtani@ohtani', '$2y$10$oVwPHATNOHMKH7ozLV1FQ.wUgJOztj/S33D42uNOmxDqAQikWvoLe', 'ドジャース', '二刀流', 'よろしくね', './uploaded_photos/cd87e0d6dc8ebc44851c5a229e076088.jpeg', NULL),
(14, 'oonotaku', 'taku_oono@node-bee.com', '$2y$10$XDSzXBESIrwTCs8XxZ58QOUFTlg1sLaE4iNo3Q4FA3eirvb1/jHma', 'gsacademy', '学生', '頑張るよ', './uploaded_photos/91adc6feba7dcbff9b83cce4a7ffceb8.jpg', NULL),
(15, 'アントニオ猪木', 'inoki@inoki', '$2y$10$y8HYr/3EnbATo6Y2YRItheFsNOpDIQwzjgcA2YtuzXXSr16PlBQ/q', '新日本プロレス', '創業者', '元気ですかー！', './uploaded_photos/c71732035873d9941ab0cb963880ffe0.jpg', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
