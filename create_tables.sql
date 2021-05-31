DROP DATABASE IF EXISTS `uni_portal`;
CREATE DATABASE `uni_portal`;
USE `uni_portal`;



--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(3) NOT NULL,
  `news_date` datetime NOT NULL,
  `news_title` varchar(100) NOT NULL,
  `news_content` text NOT NULL,
  `news_image` varchar(50) NOT NULL,
  PRIMARY KEY (`news_id`)
);



--
-- Table structure for table `user`
--
CREATE TABLE `user` (
  `user_id` int(3) NOT NULL,
  `user_uname` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_image` varchar(50) NOT NULL DEFAULT 'default.png',
  `user_role` varchar(50) NOT NULL,
  `user_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
);



--
-- Table structure for table `courses`
--

CREATE TABLE `course` (
  `course_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  PRIMARY KEY (`course_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);


--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `group_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `group_name` varchar(10) NOT NULL,
  PRIMARY KEY (`group_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);



--
-- Table structure for table `session`
--
CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`session_id`)
);


--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(3) NOT NULL,
  `course_id` int(3),
  `book_title` varchar(100) NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `book_note` varchar(256) NOT NULL,
  PRIMARY KEY (`book_id`),
  FOREIGN KEY (`course_id`) REFERENCES `course`(`course_id`)
);




--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade_id` int(3) NOT NULL,
  `group_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `grade_practical` int(4) NOT NULL,
  `grade_theory` int(4) NOT NULL,
  `grade_result` int(4) NOT NULL,
  PRIMARY KEY (`grade_id`),
  FOREIGN KEY (`group_id`) REFERENCES `group`(`group_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);


