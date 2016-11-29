-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2016 at 19:00 AM
-- Server version: 5.7.15
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alconseek`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `content` varchar(3000) NOT NULL DEFAULT '' COMMENT '内容',
  `author` varchar(30) NOT NULL DEFAULT '' COMMENT '作者',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author`, `create_time`, `update_time`) VALUES
(1, '小石潭记', '从小丘西行百二十步，隔篁竹，闻水声，如鸣佩环，\r\n心乐之。伐竹取道，下见小潭，水尤清冽。\r\n全石以为底，近岸，卷石底以出，为坻，\r\n为屿，为嵁，为岩。青树翠蔓，\r\n蒙络摇缀，参差披拂。(佩 通：珮)潭中鱼可百许头，\r\n皆若空游无所依。日光下澈，影布石上，佁然不动；\r\n俶尔远逝，往来翕忽。似与游者相乐。(下澈 一作：\r\n下彻)潭西南而望，斗折蛇行，明灭可见。其岸势犬牙差互，\r\n不可知其源。坐潭上，四面竹树环合，寂寥无人，\r\n凄神寒骨，悄怆幽邃。以其境过清，不可久居，\r\n乃记之而去。同游者：吴武陵，龚古，\r\n余弟宗玄。隶而从者，崔氏二小生：曰恕己，\r\n曰奉壹。', '柳宗元 (唐代)', '2016-11-29 16:00:00', '2016-11-29 16:00:00'),
(2, '荷塘月色', '这几天心里颇不宁静。今晚在院子里坐着乘凉，忽然想起日日走过的荷塘，在这满月的光里，总该另有一番样子吧。月亮渐渐地升高了，墙外马路上孩子们的欢笑，已经听不见了；妻在屋里拍着闰儿，迷迷糊糊地哼着眠歌。我悄悄地披了大衫，带上门出去。\r\n　　沿着荷塘，是一条曲折的小煤屑路。这是一条幽僻的路；白天也少人走，夜晚更加寂寞。荷塘四面，长着许多树，蓊蓊郁郁的。路的一旁，是些杨柳，和一些不知道名字的树。没有月光的晚上，这路上阴森森的，有些怕人。今晚却很好，虽然月光也还是淡淡的。', '朱自清', '2016-11-29 16:00:00', '2016-11-29 16:00:00'),
(3, '荷塘月色(live)', '荷塘月色 - 凤凰传奇\r\n剪一段时光缓缓流淌\r\n流进了月色中微微荡漾\r\n弹一首小荷淡淡的香\r\n美丽的琴音就落在我身旁\r\n萤火虫点亮夜的星光\r\n谁为我添一件梦的衣裳\r\n推开那扇心窗远远地望\r\n谁采下那一朵昨日的忧伤\r\n我像只鱼儿在你的荷塘\r\n只为和你守候那皎白月光\r\n游过了四季荷花依然香\r\n等你宛在水中央\r\n萤火虫点亮夜的星光\r\n谁为我添一件梦的衣裳\r\n推开那扇心窗远远地望\r\n谁采下那一朵昨日的忧伤\r\n我像只鱼儿在你的荷塘\r\n只为和你守候那皎白月光\r\n游过了四季荷花依然香\r\n等你宛在水中央\r\n那时年轻的你 和你水中的模样\r\n依然不变的仰望\r\n满天迷人的星光\r\n谁能走进你的心房\r\n采下一朵莲\r\n是那夜的芬芳 还是你的发香\r\n荷塘呀荷塘 你慢慢慢慢唱哟\r\n月光呀月光 你慢慢慢慢听哟\r\n鱼儿呀鱼儿 你慢慢慢慢游哟\r\n淡淡的淡淡的 淡淡的月光\r\n我像只鱼儿在你的荷塘\r\n只为和你守候那皎白月光\r\n游过了四季荷花依然香\r\n等你宛在水中央\r\n我像只鱼儿在你的荷塘\r\n只为和你守候那皎白月光\r\n游过了四季荷花依然香\r\n等你宛在水中央\r\n等你宛在水中央', '凤凰传奇', '2016-11-29 16:00:00', '2016-11-29 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(10) UNSIGNED NOT NULL,
  `uname` varchar(30) NOT NULL DEFAULT '',
  `passwd` char(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='开发管理员用';

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `uname`, `passwd`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `spoor`
--

CREATE TABLE `spoor` (
  `id` int(10) UNSIGNED NOT NULL,
  `remote_addr` varchar(30) NOT NULL DEFAULT '' COMMENT 'ip',
  `user_agent` varchar(255) NOT NULL DEFAULT '' COMMENT 'agent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='访问记录表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spoor`
--
ALTER TABLE `spoor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `spoor`
--
ALTER TABLE `spoor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;