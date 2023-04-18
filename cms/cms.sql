-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 09:14 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(4, 'PHP'),
(5, 'Java'),
(11, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(11, 22, 'Yamin', 'yamin@gmail.com', 'This is a test comment', 'unapproved', '2023-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(3) NOT NULL,
  `category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(1, 1, 'Edwin\'s CMS PHP Course', 'John Doe', '', '2023-03-30', 'post.png', 'This is the content section.', 'edwin, javascript, php', 2, 'Draft', 3),
(2, 5, 'JavaScript Course', 'Belinda', '', '2023-04-03', 'post.png', 'This is the content section. ', 'belinda, javascript, php', 2, 'Draft', 3),
(11, 1, 'Test', 'Yamin', '', '2023-04-05', 'post.png', 'This is a test content', 'test', 0, 'Draft', 1),
(14, 1, 'Test Post', 'Belinda', '', '2023-04-07', 'post.png', 'This is a test post by Belinda', 'test_post', 0, 'Draft', 1),
(15, 1, 'Test', 'Yamin', '', '2023-04-05', 'post.png', 'This is a test content', 'test', 0, 'Draft', 1),
(16, 1, 'Test Post', 'Belinda', '', '2023-04-17', 'post.png', ' This is a test post by Belinda \r\n\r\n\r\n\r\n', 'test_post', 0, 'Draft', 3),
(22, 1, 'Test', 'Yamin', '', '2023-04-05', 'post.png', 'This is a test content', 'test', 0, 'Draft', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(2, 'yamin', '$1$MOX2IsFX$Q4koLxCJB8dL2r73QgapA/', 'Yamin', 'Bin Yahiya', 'yamin@gmail.com', '', 'admin', ''),
(9, 'faiyaz', '12345', 'Faiyaz', 'Bin Khaled', 'faiyaz@gmail.com', '', 'subsciber', ''),
(11, 'mrinmoy', '$1$MRR2swEY$fnSyRLEczirBzeKCRpckT.', '', '', 'mrinmoy@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(14, 'kutub', 'kutub', 'Kutub', 'Uddin Bayezid', 'kutub@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(15, 'amarto', '$2y$12$f7hSitBqYoUG83a7g/Aocez8YfugzQpeGhh7Bg0N3d8IfgyAzS3Uy', 'Amarto', 'Sarker', 'amarto@gmail.com', '', 'subsciber', '$2y$10$iusesomecrazystrings22'),
(23, 'tahsin', '$2y$12$6ODRW3kjVm0SMp8/aRMDxuo1aXF3uPq2dDwoVKbpBtbi.CGnggGpq', '', '', 'tahsin@mail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(25, 'sajid', '$2y$12$HpoXMARO8590Nza0/TegLOOF1OrN5bLfVwAmOX9xpRgnb9QxnqVu6', '', '', 'sajid@mail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'v2dt9jr4aq34sr5l4rghkhfn3q', 1681124116);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
