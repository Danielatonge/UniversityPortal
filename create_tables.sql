DROP DATABASE IF EXISTS `uni_portal`;
CREATE DATABASE `uni_portal`;
USE `uni_portal`;



--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(3) NOT NULL AUTO_INCREMENT,
  `news_date` datetime NOT NULL,
  `news_title` varchar(100) NOT NULL,
  `news_content` text NOT NULL,
  `news_image` varchar(50) NOT NULL,
  PRIMARY KEY (`news_id`)
);


--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(3) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(10) NOT NULL,
  PRIMARY KEY (`group_id`)
);
INSERT INTO `groups` (`group_name`) VALUES ('890');
INSERT INTO `groups` (`group_name`) VALUES ('452');
INSERT INTO `groups` (`group_name`) VALUES ('977');
INSERT INTO `groups` (`group_name`) VALUES ('353');


--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_uname` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_image` varchar(50) NOT NULL DEFAULT 'default.png',
  `user_number` varchar(15), 
  `user_role` varchar(50) NOT NULL,
  `user_date` datetime NOT NULL,
  `group_id` int(3),
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (`group_id`) REFERENCES `groups`(`group_id`)
);
INSERT INTO `users` (`user_uname`, `user_pass`, `user_email`, `user_number`, `user_image`, `user_role`, `user_date`) VALUES ('dan', '$2y$12$wp3q6cUbtDKh3E55K6hy4OvO.q8mzBT0SgeE/Ldl954NYYGuqzcnq', 'dan@gmail.com', '+897868763', 'default.png', 'teacher', '2021-06-01 13:16:53');


--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(3) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(20) NOT NULL,
  `user_id` int(3) NOT NULL,
  PRIMARY KEY (`course_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
);

--
-- Table structure for table `lectures`
--
CREATE TABLE `lectures` (
  `lecture_id` int(3) NOT NULL AUTO_INCREMENT,
  `lecture_name` varchar(20) NOT NULL,
  `course_id` int(3),
  `lecture` varchar(50) NOT NULL,
  `lecture_note` varchar(256),
  PRIMARY KEY (`lecture_id`),
  FOREIGN KEY (`course_id`) REFERENCES `courses`(`course_id`)
);


--
-- Table structure for table `session`
--
CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`session_id`)
);


--
-- Table structure for table `book`
--

CREATE TABLE `books` (
  `book_id` int(3) NOT NULL AUTO_INCREMENT,
  `course_id` int(3),
  `book_preview` varchar(50) NOT NULL,
  `book` varchar(50) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `book_note` varchar(256) NOT NULL,
  PRIMARY KEY (`book_id`),
  FOREIGN KEY (`course_id`) REFERENCES `courses`(`course_id`)
);



--
-- Table structure for table `grade`
--

CREATE TABLE `grades` (
  `grade_id` int(3) NOT NULL AUTO_INCREMENT,
  `group_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `grade_practical` int(4) NOT NULL,
  `grade_theory` int(4) NOT NULL,
  `grade_result` int(4) NOT NULL,
  PRIMARY KEY (`grade_id`),
  FOREIGN KEY (`group_id`) REFERENCES `groups`(`group_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
);


