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
INSERT INTO `news` (`news_date`, `news_title`, `news_content`, `news_image`) VALUES 
  ('2021-06-01 13:16:53', 'The Universe Through A Child S Eyes', 'For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.', 'xe2.jpg.pagespeed.ic.LTf87DI54f.jpg');

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
INSERT INTO `users` (`user_uname`, `user_pass`, `user_email`, `user_number`, `user_image`, `user_role`, `user_date`) VALUES ('dan', '$2y$12$wp3q6cUbtDKh3E55K6hy4OvO.q8mzBT0SgeE/Ldl954NYYGuqzcnq', 'dan@gmail.com', '+897868763', 'default.png', 'admin', '2021-06-01 13:16:53');
INSERT INTO `users` (`user_uname`, `user_pass`, `user_email`, `user_number`, `user_image`, `user_role`, `user_date`) VALUES ('nas', '$2y$12$wp3q6cUbtDKh3E55K6hy4OvO.q8mzBT0SgeE/Ldl954NYYGuqzcnq', 'dan@gmail.com', '+897868763', 'default.png', 'teacher', '2021-06-01 13:16:53');
INSERT INTO `users` (`user_uname`, `user_pass`, `user_email`, `user_number`, `user_image`, `user_role`, `user_date`) VALUES ('and', '$2y$12$wp3q6cUbtDKh3E55K6hy4OvO.q8mzBT0SgeE/Ldl954NYYGuqzcnq', 'dan@gmail.com', '+897868763', 'default.png', 'student', '2021-06-01 13:16:53');


--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(3) NOT NULL AUTO_INCREMENT,
  `course_image` varchar(50) NULL,
  `course_name` varchar(20) NOT NULL,
  `course_overview` varchar(256) NULL,
  `user_id` int(3) NOT NULL,
  PRIMARY KEY (`course_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
);
INSERT INTO `courses` (`course_name`, `course_image`, `course_overview`, `user_id`) VALUES 
('Maths', 'xb1.jpg.pagespeed.ic.9F-kTnBvcY.jpg', 'Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their.', 2);



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
INSERT INTO `books` (`book_preview`, `book`, `book_title`, `book_author`, `book_note`) VALUES 
  ('xb1.jpg.pagespeed.ic.9F-kTnBvcY.jpg', 'lsq.pdf', 'Addiction When Gambling Becomes A Problem','Mark Wiens', 
  'Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their.');



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



--
-- Table structure for table `test`
--
CREATE TABLE `tests` (
  `test_id` int(3) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(100) NOT NULL,
  `test_content` varchar(256) NULL,
  `course_id` int(3) NOT NULL,
  PRIMARY KEY (`test_id`),
  FOREIGN KEY (`course_id`) REFERENCES `courses`(`course_id`)
);
INSERT INTO `tests` (`test_name`, `test_content`, `course_id`) VALUES ('First Semester Test',
'MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction', 1);
INSERT INTO `tests` (`test_name`, `test_content`, `course_id`) VALUES ('Astronomy Binoculars A Great Alternative',
'MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction', 1);

--
-- Table structure for table `questions`
--
CREATE TABLE `questions` (
  `question_id` int(3) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(250) NOT NULL,
  `test_id` int(3) NOT NULL,
  `option_one` varchar(150) NOT NULL,
  `option_two` varchar(150) NOT NULL,
  `option_three` varchar(150) NOT NULL,
  `correct` int(2) NOT NULL,
  PRIMARY KEY (`question_id`),
  FOREIGN KEY (`test_id`) REFERENCES `tests`(`test_id`)
);
INSERT INTO `questions` (`question_text`, `test_id`, `option_one`, `option_two`, `option_three`, `correct`) VALUES
('Which of the functions is used to sort an array in descending order?', 1, 'sort()', 'asort()', 'rsort()', 3);
INSERT INTO `questions` (`question_text`, `test_id`, `option_one`, `option_two`, `option_three`, `correct`) VALUES
('Who is the father of PHP?', 1, 'Rasmus Lerdorf', 'Larry Wall', 'Zeev Suraski', 1);