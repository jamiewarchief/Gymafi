-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2020 at 01:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jnevin02`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `client_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date`, `client_id`, `coach_id`, `session_id`, `class_id`) VALUES
(16, '2020-05-06 12:00:00', 101, 100, 2, NULL),
(18, '2020-05-08 12:00:00', 101, 100, 1, NULL),
(21, '2020-04-23 09:00:00', 101, 100, 4, NULL),
(22, '2020-05-15 12:05:00', 101, 100, 5, NULL),
(23, '2020-05-30 09:45:00', 101, 100, 3, NULL),
(24, '2020-05-30 10:55:00', 101, 100, 4, NULL),
(29, '2019-11-04 14:00:00', 101, 100, 3, NULL),
(30, '2019-11-06 12:30:00', 101, 100, 5, NULL),
(31, '2019-11-08 11:30:00', 101, 100, 2, NULL),
(32, '2019-11-11 14:15:00', 101, 100, 4, NULL),
(33, '2019-11-16 13:30:00', 101, 100, 1, NULL),
(34, '2019-11-19 10:45:00', 101, 100, 2, NULL),
(35, '2019-11-25 12:30:00', 101, 100, 5, NULL),
(36, '2019-11-29 12:30:00', 101, 100, 3, NULL),
(37, '2019-12-02 12:30:00', 101, 100, 1, NULL),
(38, '2019-12-04 12:30:00', 101, 100, 2, NULL),
(39, '2019-12-08 12:30:00', 101, 100, 4, NULL),
(40, '2019-12-13 12:30:00', 101, 100, 5, NULL),
(41, '2019-12-15 12:30:00', 101, 100, 3, NULL),
(42, '2019-12-19 12:30:00', 101, 100, 1, NULL),
(43, '2019-12-21 12:30:00', 101, 100, 2, NULL),
(44, '2020-01-01 12:30:00', 101, 100, 3, NULL),
(45, '2020-01-04 12:30:00', 101, 100, 4, NULL),
(46, '2020-01-14 12:30:00', 101, 100, 4, NULL),
(47, '2020-01-18 12:30:00', 101, 100, 2, NULL),
(48, '2020-01-24 12:30:00', 101, 100, 1, NULL),
(49, '2020-02-03 12:30:00', 101, 100, 5, NULL),
(50, '2020-02-07 12:30:00', 101, 100, 4, NULL),
(51, '2020-02-10 12:30:00', 101, 100, 3, NULL),
(52, '2020-02-16 12:30:00', 101, 100, 1, NULL),
(53, '2020-02-20 12:30:00', 101, 100, 5, NULL),
(54, '2020-03-10 12:30:00', 101, 100, 1, NULL),
(55, '2020-03-17 12:30:00', 101, 100, 1, NULL),
(56, '2020-03-25 12:30:00', 101, 100, 2, NULL),
(57, '2020-03-30 12:30:00', 101, 100, 3, NULL),
(58, '2020-04-03 12:30:00', 101, 100, 4, NULL),
(59, '2020-04-08 12:30:00', 101, 100, 4, NULL),
(60, '2020-04-12 12:30:00', 101, 100, 1, NULL),
(62, '2020-04-18 12:30:00', 101, 100, 2, NULL),
(63, '2020-04-20 12:30:00', 101, 100, 5, NULL),
(65, '2020-05-07 12:00:00', 101, 100, 3, NULL),
(66, '2020-04-24 14:00:00', 177, 100, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(200) NOT NULL,
  `class_desc` varchar(1000) NOT NULL,
  `class_info` varchar(10000) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  `coach_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `class_desc`, `class_info`, `img_path`, `coach_id`) VALUES
(1, 'Vinyasa Yoga', 'Vinyasa is a style of yoga characterised by stringing postures together so that you move from one to another, seamlessly, using breath - commonly referred to as flow yoga.', 'Vinyasa is a style of yoga characterised by stringing postures together so that you move from one to another, seamlessly, using breath. Commonly referred to as flow yoga, it is sometimes confused with power yoga.\r\n\r\nVinyasa classes offer a variety of postures and no two classes are ever alike.  The opposite would be fixed forms such as Bikram Yoga, which features the same 26 postures in every class, or Ashtanga which has the same sequence every time.\r\n\r\nThe variable nature of Vinyasa Yoga helps to develop a more balanced body as well as prevent repetitive motion injuries that can happen if you are always doing the same thing every day.\r\n\r\nAs a philosophy, Vinyasa recognises the temporary nature of things.  We enter into a posture, are there for a while and then leave.\r\n\r\nWhile Vinyasa, or Vinyasa-Krama, dates back to the Vedic age - the earliest period of yoga thousands of years ago - it referred to a series, or sequence of steps, to make something sacred.\r\n\r\nThe movement practice of Vinyasa is said to begin with T Krishnamacharya who has had the largest influence on how yoga, in general, is practiced today.\r\n\r\nPut all this together and Vinyasa, is a breath initiated practice, that connects every action of our life with the intention of moving towards what is sacred, or most important to us.\r\n\r\nWhile Vinyasa Yoga is one of the most popular forms of the practice in the world today, it is not well understood.', '/gymafi/img/carousel/vinyasa.jpg', 100),
(2, 'Doga', 'Doga is a human yoga practice that helps support the natural bond we have with our dog.', 'Doga is a human yoga practice that helps support the natural bond we have with our dog.\r\n\r\nDoga works on the natural symbiotic relationship that already exists between you and your dog. If there\'s stress and tension in YOU, your dog may feel it and absorb your tension... this may reflect in their immediate environment and the way they socialise with other dogs.\r\n\r\nBy releasing any tension, stress or anxiety you automatically help your dog to be more accepting and feel secure to meet other dogs without worrying about you. Yoga can help this process and Doga is the magic glue that derives from your internal practice of Yoga.\r\n\r\nHaving your dog included in your yoga practice enables you to observe \"your attitude\" towards yourself and all living beings and get a deeper insight and understanding of behaviour patterns that arise from the mind.I love it when my dog interrupts my yoga because he reminds me that I mustn\'t be so uptight about getting the poses right. There\'s no such thing as perfection, anything goes.', '/gymafi/img/carousel/doga.jpg', 100),
(3, 'The Body Pop Shop', 'The Body Pop Shop is a great way to challenge your body in a variety of ways while boosting the fun factor.', 'Looking for a way to infuse your fitness routine with some new energy and excitement? Whether you\'re a seasoned athlete or just getting started with physical activity, circuit training at The Body Pop Shop is a great way to challenge your body in a variety of ways while boosting the fun factor.\r\n\r\nA typical workout includes about 8-10 exercise stations. After completing a station, instead of resting, you move quickly to the next station. A muscular strength and endurance circuit alternates muscle groups, such as upper body, lower body and core, so little or no rest is needed in between stations. This article focuses on another form of circuit training: aerobic + strength. This type of circuit alternates 1-2 sets of resistance exercise (body weight, free weights, dumbbells, kettle bells, bands, etc.), with brief bouts of cardiovascular exercise (jogging in place, stationary cycling, rowing, etc.) lasting anywhere from 30 seconds to 3 minutes. Depending on your goals and the number of circuit stations, you can complete 1 or more circuits in a 30-60 minute session.', '/gymafi/img/carousel/bodypop.jpg', 100),
(4, 'VR Climbing', 'VR Climbing gives you the freedom to move across any environment with superhuman abilities.', 'Climbing requires upper body strength, resilience and the right equipment. Luckily most of the time with VR, you don\'t need any of the skills the real life activity would require. Get a grip and swing from rock to rock to reach the top. Just don\'t look down...\r\n\r\nVR Climbing gives you the freedom to move across the environment with superhuman abilities. Conquer over 30 levels with new obstacles and challenges. Compete for the fastest times or explore the environment. Experience the freedom of movement.\r\n\r\nTO THE TOP Academy is a virtual training program to test your skills and see if you are capable of scaling the world\'s steepest slopes. So strap in and see if you can pass this challenge.', '/gymafi/img/carousel/climbing.jpg', 100),
(5, 'Barre', 'While barre has origins in dance, the rhythmically challenged shouldn’t worry: No tapshoes, leotards, or any fancy footwork are required.', 'While barre has origins in dance, the rhythmically challenged shouldn’t worry: No tapshoes, leotards, or any fancy footwork are required. “You don’t need any dance experience—you’re not going to be doing pirouettes,” says Jamie Nevin, DPT, a former dancer and physical therapist at the GYMAFI studios in Belfast.\r\n\r\nInstead, you’ll start with a mat-based warm-up full of planks and push-ups, do a series of arm exercises, and continue at the bar with a lower-body section to work your thighs and glutes. Finally, you’ll finish with a series of core-focused moves at the bar or a short session on the mat.\r\n\r\nAs for gear, the moves are typically bodyweight only, but you can use light hand weights (usually two or three pounds) or resistance bands to level up your arm exercises. For lower-body work, a soft exercise ball is often used to help engage leg muscles. And while most studios recommend wearing socks with sticky grips on the bottom, others let you go barefoot.\r\n\r\nJamie says: “Lift, run, jump, do yoga, swim, take a barre class, dance. Mix up your routine and keep your body moving while focusing the majority of your efforts on work that increases overall strength and endurance. Do that and you’ll be fit as a fiddle for life.”', '/gymafi/img/carousel/barre.jpg', 100),
(6, 'HIIT', 'HIIT (High Intensity Interval Toddlers) sounds very scientific, but it’s really very simple – short, hard bouts of cardio exercise with your child.', 'HIIT (High Intensity Interval Toddlers) sounds very scientific, but it’s really very simple. It’s comprised of short, hard bouts of cardio exercise with your child, anywhere from 10 seconds to five minutes in length, broken up by brief recovery and crying periods.\r\n\r\nHow hard is hard? That depends on the interval length and the resilience of your toddler, but the key is to go as hard as you can for the duration of the effort. So if you’re doing Tabatas (20 seconds of effort, followed by 10 seconds of recovery), you’re running full throttle for 20 seconds. If you’re doing longer, 3- to 5-minute intervals, you’re working in your VO2 max zone, or about 95 percent of your max heart rate (or a 9 on a scale of 1 to 10) for the duration of the interval.\r\n\r\nHow much recovery you take between intervals depends on your goals. Short intervals are usually paired with equally short or even shorter recovery periods so your toddler can adapt to repeated maximal efforts. And because your heart rate stays elevated during the recovery periods, your aerobic energy system gets a training benefit as well, and you and your toddler will benefit from their decreased levels of hyperactivity. In other cases, such as high-intensity sprints, you want each effort to be done at max, so you need to let your body fully recover for four or five minutes between bouts, and to ensure your toddler is so knackered they can barely move a muscle.', '/gymafi/img/carousel/hiit.jpg', 100),
(7, 'Super Sculpt', 'With this ultra-effective workout, you can strengthen and sculpt your arms, legs, butt, back, chest and abs in 45 minutes or less!', 'It\'s hard enough to squeeze in a workout under normal conditions, but during the holidays, it can seem next to impossible. Fortunately, this party season, you won\'t have to put your fitness on hold, no matter how time-challenged you are. With this ultra-effective workout, you can strengthen and sculpt your arms, legs, butt, back, chest and abs in 45 minutes or less!\r\n\r\nBased on a hybrid class created by Belfast personal trainer and dancer Jamie Nevin, our workout blends strength training, ballet and Pilates – three disciplines that offer unique body benefits, from strong, toned muscles to better posture, flexibility and balance. Plus, all three require using your core muscles to maintain stability and control so you\'ll constantly be working to flatten your abs. \"Your core is the common thread that ties them together,\" Nevin says.\r\n\r\nThe workout is split into three fifteen-minute sequences, so you can do one for a total-body quickie, or combine them for a 45-minute body-sculpting blitz. Remember: Even if you only have a few minutes, you can still keep your muscles firm and flexible -- and burn some calories to boot.', '/gymafi/img/carousel/supersculpt.jpg', 100),
(8, 'Muay Thai', 'Get your heart rate up with some sparring, kicking and punching!', 'Muay Thai is more than just a fitness class it’s the national sport of Thailand and it’s been practiced for centuries. Now, however, boutique studios across the world like GYMAFI have begun offering Muay Thai-inspired workouts to leave you feeling empowered and challenged in a whole new way.\r\n\r\nMuay Thai is head-to-head combat; the workouts have you sparring, kicking, and punching at a fast pace to get your heart rate up and strengthen your whole body. Right now, it may be difficult to find Muay Thai fitness classes outside of big cities, but contact us at GYMAFI for more information.\r\n', '/gymafi/img/carousel/muaythai.jpg', 100),
(28, 'Freerunning', 'Urban Landscape', 'FreerunningÂ is a way of expression by interacting with various obstacles and environment.\r\n\r\nFreerunning may include flipping and spinning. These movements are usually adopted from other sports, such asÂ gymnastics,Â trickingÂ orÂ breakdancing. Freerunners can create their own moves, flows and lines in different landscapes.\r\n\r\nIt is all about becoming creative in an objective environment. Practitioners of freerunning usually doÂ parkourÂ as well. Freerunning is often associated with parkour by adding acrobatic and stylish moves, showcasing the art of movement. Freerunning was founded byÂ Jamie Nevin, who discussed the subject inÂ GYMAFIÂ in 2013.', '/gymafi/img/carousel/freerunning.jpeg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `coach_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`coach_id`, `user_id`) VALUES
(1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `mailboxes`
--

CREATE TABLE `mailboxes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mailbox` varchar(3) NOT NULL,
  `message_id` int(11) NOT NULL,
  `message_read` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mailboxes`
--

INSERT INTO `mailboxes` (`id`, `user_id`, `mailbox`, `message_id`, `message_read`) VALUES
(159, 101, 'out', 76, NULL),
(160, 100, 'in', 76, NULL),
(166, 100, 'out', 82, NULL),
(167, 101, 'in', 82, NULL),
(168, 100, 'out', 83, NULL),
(169, 173, 'in', 83, NULL),
(170, 173, 'out', 84, NULL),
(171, 100, 'in', 84, NULL),
(172, 100, 'out', 85, NULL),
(173, 101, 'in', 85, NULL),
(174, 100, 'in', 86, NULL),
(175, 100, 'in', 87, NULL),
(176, 101, 'out', 88, NULL),
(177, 100, 'in', 88, NULL),
(178, 100, 'out', 89, NULL),
(179, 101, 'in', 89, NULL),
(180, 101, 'out', 90, NULL),
(181, 100, 'in', 90, NULL),
(182, 100, 'out', 91, NULL),
(185, 177, 'out', 93, NULL),
(186, 100, 'in', 93, NULL),
(187, 100, 'out', 94, NULL),
(188, 155, 'in', 94, NULL),
(189, 100, 'out', 95, NULL),
(190, 177, 'in', 95, NULL),
(191, 101, 'out', 96, NULL),
(192, 100, 'in', 96, NULL),
(193, 101, 'out', 97, NULL),
(194, 100, 'in', 97, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `message`, `sender_id`, `recipient_id`, `created`) VALUES
(76, 'Appointment Request', 'Rachel has requested a Diet Planning for Fri 24 Apr 2020 @ 12:00', 101, 100, '2020-04-22 00:36:20'),
(81, 'Name: Jamie Nevin |  Email: jmenvn@gmail.com', 'Hello I would like to know more', 0, 100, '2020-04-22 02:19:42'),
(82, 'Re: Appointment Request', 'Yes that\'s no problem!', 100, 101, '2020-04-22 02:25:35'),
(83, 'Welcome', 'Welcome to the team!', 100, 173, '2020-04-22 02:26:22'),
(84, 'Re: Welcome', 'Thanks a lot!', 173, 100, '2020-04-22 02:26:45'),
(85, 'Cancellation on Thu 16 Apr 2020 @ 12:30', 'Jamie has cancelled your session.', 100, 101, '2020-04-22 02:27:43'),
(86, 'Name: Jamie Nevin |  Email: jmenvn@gmail.com', 'Hi, could you tell me more about your business?', 0, 100, '2020-04-22 02:52:15'),
(87, 'Name: Jamie Nevin |  Email: jmenvn@gmail.com', 'Hi I would like to know more.', 0, 100, '2020-04-22 02:56:40'),
(88, 'Appointment Request', 'Rachel has requested a Diet Planning for Thu 07 May 2020 @ 14:00', 101, 100, '2020-04-22 03:02:09'),
(89, 'Re: Appointment Request', 'Hi Rachel. That\'s no problem! I\'ll update your schedule.', 100, 101, '2020-04-22 03:03:07'),
(90, 'Cancellation on Thu 07 May 2020 @ 12:00', 'Rachel has cancelled your session.', 101, 100, '2020-04-22 03:04:21'),
(91, 'Hi', 'What\'s up?', 100, 101, '2020-04-22 03:06:18'),
(92, 'Name: Jamie Nevin |  Email: jmenvn@gmail.com', 'Hi I am interested in your business and would like to know more!', 0, 100, '2020-04-22 13:04:21'),
(93, 'Appointment Request', 'Adrian has requested a Park Running for Fri 24 Apr 2020 @ 14:00', 177, 100, '2020-04-22 13:10:47'),
(94, 'Cancellation on Fri 24 Apr 2020 @ 14:30', 'Jamie has cancelled your session.', 100, 155, '2020-04-22 13:11:41'),
(95, 'Re: Appointment Request', 'Hi Adrian, that\'s no problem! I\'ve added you to the schedule.', 100, 177, '2020-04-22 13:13:21'),
(96, 'Cancellation on Thu 07 May 2020 @ 14:00', 'Rachel has cancelled your session.', 101, 100, '2020-04-22 13:14:27'),
(97, 'Friend interested', 'Hi my friend would like to get in touch, could you add them to the business please?', 101, 100, '2020-04-22 13:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `profile_img`
--

CREATE TABLE `profile_img` (
  `img_id` int(11) NOT NULL,
  `img_path` varchar(200) NOT NULL DEFAULT '/gymafi/profileimg/placeholderimg.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_img`
--

INSERT INTO `profile_img` (`img_id`, `img_path`) VALUES
(100, '../profileimg/jamienevin.jpg'),
(101, 'profileimg/rachelmccann.jpg'),
(119, '/gymafi/profileimg/placeholderimg.jpeg'),
(155, '/gymafi/profileimg/placeholderimg.jpeg'),
(157, 'profileimg/Luke_Skywalker.jpg'),
(177, 'profileimg/sweaty.jpg'),
(178, '/gymafi/profileimg/placeholderimg.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `session_name`) VALUES
(1, 'Progression Session 1-on-1'),
(2, 'Motivation Station'),
(3, 'Diet Planning'),
(4, 'Park Running'),
(5, 'Mental Health Focus');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `postcode` varchar(200) DEFAULT NULL,
  `house_number` varchar(255) DEFAULT NULL,
  `phone_number` varchar(14) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pword` varchar(100) NOT NULL,
  `is_admin` int(1) DEFAULT 0,
  `ass_coach_id` int(11) DEFAULT 100,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `postcode`, `house_number`, `phone_number`, `email`, `pword`, `is_admin`, `ass_coach_id`, `user_status`, `date_created`) VALUES
(100, 'warchief', 'Jamie', 'Nevin', 'BT9 5AQ', '23', '07809481504', 'jmenvn@gmail.com', 'warchief123', 1, NULL, 1, '2020-04-21 14:32:49'),
(101, 'hosagen', 'Rachel', 'McCann', 'BT6 4FF', '15', '07746558733', 'rachelmccann_@live.co.uk', 'hosagen123', 0, 100, 1, '2019-11-04 11:14:49'),
(119, 'ultimatehardlad', 'Ryan', 'Thompson', 'BT29 5TY', '8', '07809481504', 'rthompson40@qub.ac.uk', 'tempest', 0, 100, 1, '2020-04-21 14:32:49'),
(155, 'ultraswag', 'Ryan', 'Bryan', 'BT29 5HA', '5', '02555555555', 'rthompson40@qub.ac.uk', 'tester', 0, 100, 1, '2020-04-21 14:32:49'),
(157, 'lukey', 'Luke', 'Mitchell', 'BT9 5EH', '36', '447742526476', 'lmitchell22@qub.ac.uk', 'password123', 0, 100, 1, '2020-04-21 14:32:49'),
(177, 'adrianp', 'Adrian', 'Peterson', 'BT7 4RR', '12', '07758475663', 'jnevin02@qub.ac.uk', 'password123', 0, 100, 1, '2020-04-22 13:06:09'),
(178, 'testman', 'Test', 'Man', 'BT8 GGG', '7', '02890446775', 'test@mail.com', 'test123', 0, 100, 0, '2020-04-22 13:17:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_client_id` (`client_id`),
  ADD KEY `FK_session_id` (`session_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_id`),
  ADD KEY `FK_coach_user_id` (`user_id`);

--
-- Indexes for table `mailboxes`
--
ALTER TABLE `mailboxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_message_id` (`message_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_img`
--
ALTER TABLE `profile_img`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mailboxes`
--
ALTER TABLE `mailboxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_client_id` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_session_id` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`);

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `FK_coach_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mailboxes`
--
ALTER TABLE `mailboxes`
  ADD CONSTRAINT `FK_message_id` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`);

--
-- Constraints for table `profile_img`
--
ALTER TABLE `profile_img`
  ADD CONSTRAINT `FK_img_id` FOREIGN KEY (`img_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
