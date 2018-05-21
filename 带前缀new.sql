-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-03-09 00:10:46
-- 服务器版本： 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newy`
--

-- --------------------------------------------------------

--
-- 表的结构 `test_adminuser`
--

CREATE TABLE `test_adminuser` (
  `id` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `settime` int(11) NOT NULL DEFAULT '90'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `test_adminuser`
--

INSERT INTO `test_adminuser` (`id`, `username`, `nickname`, `password`, `email`, `profile`, `auth_key`, `password_hash`, `password_reset_token`, `settime`) VALUES
(5, '方克米', '克米', '*', 'fangkemi@sina.com', '', 'pEiIaSLJqOj1Z3qhqT8_sVbf0KnY43F_', '$2y$13$y3sGLlKF3Rtq8ZdaKBrb9exo/djU30XpJUUGGDDT.8H0gbsMuKYBK', NULL, 90),
(6, 'gang', '刚', '*', 'facck@admin.com', 'myself', 'gopK_CyxaERtcV4p0c3O2xNswWRoM6B5', '$2y$13$0OX/OwhGPQ8vt0H9cQKD4ecDbbpYZMQ39jYQIzTFSP1Ry5ZKTvqbK', NULL, 90);

-- --------------------------------------------------------

--
-- 表的结构 `test_choice`
--

CREATE TABLE `test_choice` (
  `id` int(11) NOT NULL COMMENT '题号',
  `answer` enum('A','B','C','D') COLLATE utf8_unicode_ci NOT NULL COMMENT '答案',
  `admin_id` int(11) NOT NULL COMMENT '出题人',
  `title` text COLLATE utf8_unicode_ci NOT NULL COMMENT '题目内容',
  `A` text COLLATE utf8_unicode_ci NOT NULL,
  `B` text COLLATE utf8_unicode_ci NOT NULL,
  `C` text COLLATE utf8_unicode_ci NOT NULL,
  `D` text COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL DEFAULT '10' COMMENT '题目分数，默认10分',
  `difficulty` enum('简单','中等','困难') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='选择题表';

-- --------------------------------------------------------

--
-- 表的结构 `test_choicepaper`
--

CREATE TABLE `test_choicepaper` (
  `id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL COMMENT '考试编号，用此索引可以查找到这此考试试卷',
  `choice_id` int(11) NOT NULL COMMENT '用于查找每道选择题',
  `choice_answer` enum('A','B','C','D') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='考试表，里面存储考试题目编号，考试历史信息，用来保存考试记录';

-- --------------------------------------------------------

--
-- 表的结构 `test_judgement`
--

CREATE TABLE `test_judgement` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT '出题人',
  `title` text COLLATE utf8_unicode_ci NOT NULL COMMENT '出题人',
  `answer` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '答案',
  `score` int(11) NOT NULL DEFAULT '5' COMMENT '分数，默认5分'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `test_judgementpaper`
--

CREATE TABLE `test_judgementpaper` (
  `id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `judgement_id` int(11) NOT NULL,
  `judgement_answer` enum('1','2') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `test_migration`
--

CREATE TABLE `test_migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `test_migration`
--

INSERT INTO `test_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1520508690),
('m130524_201442_init', 1520508698);

-- --------------------------------------------------------

--
-- 表的结构 `test_result`
--

CREATE TABLE `test_result` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '参与考试人员id',
  `score` int(11) NOT NULL COMMENT '考试分数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='每一次的考试结果';

-- --------------------------------------------------------

--
-- 表的结构 `test_user`
--

CREATE TABLE `test_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `test_adminuser`
--
ALTER TABLE `test_adminuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_choice`
--
ALTER TABLE `test_choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `admin_id_2` (`admin_id`);

--
-- Indexes for table `test_choicepaper`
--
ALTER TABLE `test_choicepaper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `result_id` (`result_id`),
  ADD KEY `choice_id` (`choice_id`);

--
-- Indexes for table `test_judgement`
--
ALTER TABLE `test_judgement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `test_judgementpaper`
--
ALTER TABLE `test_judgementpaper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `result_id` (`result_id`),
  ADD KEY `judgement_id` (`judgement_id`);

--
-- Indexes for table `test_migration`
--
ALTER TABLE `test_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `test_result`
--
ALTER TABLE `test_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `test_user`
--
ALTER TABLE `test_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `test_adminuser`
--
ALTER TABLE `test_adminuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `test_choice`
--
ALTER TABLE `test_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '题号';
--
-- 使用表AUTO_INCREMENT `test_choicepaper`
--
ALTER TABLE `test_choicepaper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `test_judgement`
--
ALTER TABLE `test_judgement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `test_judgementpaper`
--
ALTER TABLE `test_judgementpaper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `test_user`
--
ALTER TABLE `test_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 限制导出的表
--

--
-- 限制表 `test_choice`
--
ALTER TABLE `test_choice`
  ADD CONSTRAINT `关联到出题人` FOREIGN KEY (`admin_id`) REFERENCES `test_adminuser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `test_choicepaper`
--
ALTER TABLE `test_choicepaper`
  ADD CONSTRAINT ` 约束考试编号，` FOREIGN KEY (`result_id`) REFERENCES `test_result` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `关联到考试的试题编号，精确到每道试题` FOREIGN KEY (`choice_id`) REFERENCES `test_choice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `test_judgement`
--
ALTER TABLE `test_judgement`
  ADD CONSTRAINT `关联出题人` FOREIGN KEY (`admin_id`) REFERENCES `test_adminuser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `test_judgementpaper`
--
ALTER TABLE `test_judgementpaper`
  ADD CONSTRAINT `关联考试判断题编号` FOREIGN KEY (`judgement_id`) REFERENCES `test_judgement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `关联考试场次` FOREIGN KEY (`result_id`) REFERENCES `test_result` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `test_result`
--
ALTER TABLE `test_result`
  ADD CONSTRAINT `参与考试人` FOREIGN KEY (`user_id`) REFERENCES `test_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
