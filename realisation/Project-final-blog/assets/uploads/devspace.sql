-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 10:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `featured_image_url` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `views_count` int(11) DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `excerpt`, `featured_image_url`, `author_id`, `category_id`, `status`, `views_count`, `published_at`, `created_at`, `updated_at`) VALUES
(2, 'The Future of UI Layouts with CSS Subgrid', 'Full content about CSS Subgrid goes here...', 'Discover how CSS Subgrid is changing the way we design complex layouts on the web.', '../assets/uploads/css-layout.jpg', 1, 2, 'published', 0, '2026-04-02 10:28:39', '2026-04-02 08:28:39', '2026-04-02 09:31:59'),
(11, 'Introduction to Neural Networks', 'Deep dive into how neural networks function in AI...', 'Ever wondered how computers learn? We break down the basics of neural networks in simple terms.', '../assets/uploads/ai-neural.jpg', 1, 3, 'published', 85, '2026-04-02 11:29:06', '2026-04-02 09:29:06', '2026-04-02 09:29:06'),
(12, 'Why PHP 8.3 is Great for Developers', 'Technical breakdown of new features in PHP 8.3...', 'Explore the latest features and performance improvements in the newest version of PHP.', '../assets/uploads/php-8.jpg', 1, 1, 'published', 210, '2026-04-02 11:29:06', '2026-04-02 09:29:06', '2026-04-02 09:29:06'),
(13, 'Building the Next Generation of Web Applications', 'Full content about web Applications goes here...', 'Explore advanced techniques, modern frameworks, and architectural patterns to create highly performant and scalable user interfaces.', '../assets/uploads/firstarticle.avif', 1, 1, 'published', 0, '2026-04-02 17:06:41', '2026-04-02 15:06:41', '2026-04-02 15:06:41'),
(16, 'HTML', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n<title>Page Title</title>\r\n</head>\r\n<body>\r\n\r\n<h1>This is a Heading</h1>\r\n<p>This is a paragraph.</p>\r\n\r\n</body>\r\n</html>', 'HTML is the standard markup language for Web pages.\r\n\r\nWith HTML you can create your own Website.\r\n\r\nHTML is easy to learn - You will enjoy it!', '../uploads/post_1775837220.png', 1, 1, 'published', 0, '2026-04-10 18:07:00', '2026-04-10 16:07:00', '2026-04-10 16:07:00'),
(17, 'CSS', 'CSS is the language we use to style a Web page.\r\n\r\nCSS stands for Cascading Style Sheets\r\nCSS describes how HTML elements are to be displayed on screen, paper, or in other media\r\nCSS saves a lot of work. It can control the layout of multiple web pages all at once\r\nExternal stylesheets are stored in CSS files', 'Here we will show one HTML page displayed with four different stylesheets. Click on the \"Stylesheet 1\", \"Stylesheet 2\", \"Stylesheet 3\", \"Stylesheet 4\" links below to see the different styles:', '../uploads/post_1776081242.png', 4, 2, 'published', 0, '2026-04-13 13:54:02', '2026-04-13 11:54:02', '2026-04-13 11:54:02'),
(18, 'PHP (Hypertext Preprocessor)', 'Key Aspects of PHP:\r\nServer-Side Scripting: Unlike JavaScript, PHP runs on the server (e.g., Apache, Nginx), hiding code from the user.\r\nWeb Development Focus: It is heavily used for backend web development, including CMS platforms like WordPress, Drupal, and Joomla!.\r\nEasy Integration: PHP can be embedded directly into HTML code, making it easy for beginners to start creating dynamic pages.\r\nPopularity & Use Cases: Despite being older, it is highly popular for small businesses, freelancing, and large applications like Facebook and Wikipedia.\r\nDatabase Integration: PHP works seamlessly with databases like MySQL.\r\nCurrent Versions: As of 2026, PHP 8.3 is a supported stable version, with 8.4 bringing new features like new classes and methods. \r\nPHP\r\nPHP\r\n +4\r\nKey Concepts to Learn:\r\nSyntax: PHP tags (<?php ... ?>).\r\nVariables & Data Types: Variables start with $.\r\nForms: Handling and validating form data ($_POST, $_GET).\r\nObject-Oriented Programming (OOP): Classes, objects, inheritance, and interfaces.\r\nFile Handling: Reading, creating, and uploading files.\r\nSessions & Cookies: Managing user state. \r\nW3Schools\r\nW3Schools\r\n +1\r\nTo get started, you can download PHP, look at documentation, and find tutorials on the', 'powering over 75% of websites. It embeds directly into HTML, allowing developers to create dynamic, interactive web applications. PHP code executes on the server, producing HTML sent to the browser', '../uploads/post_1776204161.jfif', 4, 1, 'published', 0, '2026-04-15 00:02:41', '2026-04-14 22:02:41', '2026-04-14 22:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Development', NULL, '2026-04-02 09:28:46'),
(2, 'Design', NULL, '2026-04-02 09:28:46'),
(3, 'Machine Learning', NULL, '2026-04-02 09:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` enum('pending','approved') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','author','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `created_at`, `password`) VALUES
(1, 'Marwan', 'marwan@gmail.com', 'admin', '2026-04-02 08:28:39', '123456'),
(2, 'Anouare', 'anouare@gmail.com', 'user', '2026-04-03 21:39:39', '123456'),
(3, 'admin', 'marwanbouhamid123@gmail.com', 'user', '2026-04-05 13:44:14', '123456'),
(4, 'Abdeslame', 'abdeslame@gmail.com', 'author', '2026-04-08 10:04:16', '123456'),
(5, 'azize', 'azize@gmail.com', 'author', '2026-04-23 12:32:12', '123456'),
(6, 'SALMA', 'SALMA@gmail.com', 'author', '2026-04-23 12:42:53', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_articles_category` (`category_id`),
  ADD KEY `idx_articles_author` (`author_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article` (`article_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
