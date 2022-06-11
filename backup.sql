-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2022 at 11:21 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs-dept`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliations`
--

DROP TABLE IF EXISTS `affiliations`;
CREATE TABLE IF NOT EXISTS `affiliations` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `affiliations_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `affiliations`
--

INSERT INTO `affiliations` (`user_id`, `position`, `organization`) VALUES
(1, 'Co-Founder', 'Aguora IT Solutions and Technology Inc.'),
(1, 'Ambassador', 'Microsoft'),
(1, 'Technical Consultant', 'House of Representative & TNC Cafe'),
(9, 'Managing Director', 'Po-Lite Technology Inc.'),
(9, 'General Manager', 'RPM Business Solutions'),
(9, 'Civil Contractor', 'CACTech Construction'),
(9, 'Graduate School Professor', 'Technological Institute of the Philippines.');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_author_id_foreign` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `image`, `title`, `source`, `content`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'announcement1.jpg', 'Payment Options', 'https://www.national-u.edu.ph/payment-options/', '\r\n				<p>Good news, Nationalians!</p>\r\n				<p>Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.</p>\r\n				<p>You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.</p>', 4, '2021-03-17 16:00:00', '2022-06-11 07:41:25'),
(2, 'announcement2.jpg', 'BDO EasyPay Cash Tuition Program', 'https://www.national-u.edu.ph/payment-options', '<p>EASYPAY-CASH-TUITION-PROMO-MECHANICS-v121620</p>', 4, '2021-02-14 16:00:00', '2022-06-11 07:41:25'),
(3, 'announcement3.jpg', 'NU Manila’s COE hosts REFOREST 2020: For Vivid Solutions', 'https://www.national-u.edu.ph/payment-options/', '\r\n				<p>The National University Manila’s College of Engineering along with PICE and PSSE student chapters of NU successfully hosted the virtual REFOREST 2020: For Vivid Solutions, last January 29 with 1500 global crowd in attendance.</p>\r\n				<p>Research Forum and Exhibition on Environmental Sustainability and Technologies (REFOREST) aims to produce solutions that will address relevant environmental crises both for present and in the future.</p>\r\n				<p>Reputable plenary speakers, forum discussants and presenters were present to share their knowledge and experience in the significance of wise environmental decision-making in a well-functioning ecosystem.</p>\r\n				<p>To top off the event, National-U’s Electronics and Communications Engineering alumnus, Jayvee Boy H. Agustin, was awarded the Best Paper Presenter for the topic: “Development of Subsystems for a Web-based Survey Tool Using Automatic Speech and Optical Character Recognition with Geotagging Features.”</p>\r\n				<p>With the mission to combat emerging natural and environmental conflicts, REFOREST 2020 will indeed help us attain a sustainable environment.</p>', 4, '2021-01-30 16:00:00', '2022-06-11 07:41:25'),
(4, 'announcement4.jpg', 'Enrollment for 1st Term AY 2021-2022 is ongoing.', 'https://www.facebook.com/nuadmissionsmnl/posts/282474563481754', '\r\n				<p>\r\n					The NU Manila ENROLLMENT for 1st Term AY 2021-2022 is ONGOING.<br>\r\n					Applicants may register online via <a href=\"bit.ly/NUManilaOnlineApplication\">bit.ly/NUManilaOnlineApplication</a>.\r\n				</p>\r\n				\r\n				<p>To all ENROLLEES of 1st Term AY 2021-2022 (Freshmen, Transferee, 2nd Degree, Graduate Studies, and Cross Enrollee) kindly upload your requirements here:</p>\r\n				\r\n				<p>For FRESHMEN Online Enrollment: <a href=\"http://bit.ly/NUMNLFreshmenEnrollment\">http://bit.ly/NUMNLFreshmenEnrollment</a></p>\r\n				\r\n				<p>For Transferee, 2nd Degree, Graduate Studies and Cross Enrollees:<br><a href=\"http://bit.ly/NUMNLOnlineEnrollment\">http://bit.ly/NUMNLOnlineEnrollment</a></p>\r\n				\r\n				<p>Should you have any questions, please don\'t hesitate to reach us at: </p>\r\n				\r\n				<p>\r\n					📧 : <a href=\"mailto:admissions@national-u.edu.ph\">admissions@national-u.edu.ph</a><br>\r\n					📞 : 09479961932 and 09479961933 (Smart) / 09223016192 (Sun)<br>\r\n					☎️ : 8712-1900 local 1201 | 8743-7951\r\n				</p>\r\n				<p>Or send us a personal message here at NU Admissions Office-Manila\'s official Facebook Page account.</p>\r\n				<p>\r\n					Keep safe and we hope to see all of you here at NU!<br>\r\n					#EducationThatWorks\r\n				</p>', 4, '2021-04-27 16:00:00', '2022-06-11 07:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

DROP TABLE IF EXISTS `colleges`;
CREATE TABLE IF NOT EXISTS `colleges` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`, `abbr`) VALUES
(1, 'Others', NULL),
(2, 'College of Computing and Information Technology', 'CCIT');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_college_foreign` (`college`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `abbr`, `college`) VALUES
(1, 'Computer Science', 'CS', 2),
(2, 'Information Technology', 'IT', 2),
(3, 'Center for Innovation and Entrepreneurship', 'CentIE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_focus`
--

DROP TABLE IF EXISTS `faculty_focus`;
CREATE TABLE IF NOT EXISTS `faculty_focus` (
  `faculty_staff_id` int(10) UNSIGNED NOT NULL,
  `focus_id` int(10) UNSIGNED NOT NULL,
  KEY `faculty_focus_faculty_staff_id_foreign` (`faculty_staff_id`),
  KEY `faculty_focus_focus_id_foreign` (`focus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faculty_focus`
--

INSERT INTO `faculty_focus` (`faculty_staff_id`, `focus_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(5, 14),
(6, 15),
(6, 16),
(6, 17),
(6, 18),
(6, 1),
(9, 19),
(9, 20),
(9, 21);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_skills`
--

DROP TABLE IF EXISTS `faculty_skills`;
CREATE TABLE IF NOT EXISTS `faculty_skills` (
  `faculty_staff_id` int(10) UNSIGNED NOT NULL,
  `skill_id` int(10) UNSIGNED NOT NULL,
  KEY `faculty_skills_faculty_staff_id_foreign` (`faculty_staff_id`),
  KEY `faculty_skills_skill_id_foreign` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faculty_skills`
--

INSERT INTO `faculty_skills` (`faculty_staff_id`, `skill_id`) VALUES
(1, 3),
(1, 1),
(1, 20),
(1, 8),
(1, 18),
(1, 9),
(1, 17),
(1, 19),
(1, 4),
(1, 5),
(1, 14),
(1, 21),
(2, 10),
(2, 16),
(2, 7),
(2, 15),
(2, 11),
(2, 12),
(2, 13),
(2, 2),
(2, 6),
(2, 21),
(2, 8),
(2, 18),
(3, 8),
(3, 18),
(3, 9),
(3, 17),
(3, 19),
(3, 4),
(3, 5),
(3, 14),
(3, 21),
(4, 1),
(4, 3),
(4, 4),
(4, 5),
(4, 8),
(4, 9),
(4, 14),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(5, 8),
(5, 18),
(5, 9),
(5, 19),
(5, 4),
(5, 5),
(5, 14),
(5, 21),
(6, 8),
(6, 18),
(6, 9),
(6, 19),
(6, 4),
(6, 5),
(6, 14),
(6, 21),
(7, 8),
(7, 18),
(7, 21),
(8, 8),
(8, 18),
(8, 21),
(9, 22),
(9, 23),
(9, 24),
(9, 25),
(9, 19);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_staffs`
--

DROP TABLE IF EXISTS `faculty_staffs`;
CREATE TABLE IF NOT EXISTS `faculty_staffs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `department` int(10) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_staffs_user_id_foreign` (`user_id`),
  KEY `faculty_staffs_position_foreign` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faculty_staffs`
--

INSERT INTO `faculty_staffs` (`id`, `user_id`, `department`, `position`, `location`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 'National University', 'Dr. Angelique D. Lacasandile is the Department Chair of the Computer Science Department at National University, Manila. She is also the Academe and Industry Linkage Coordinator, and a recipient of CHED Scholarship for Graduate Studies that enjoys full-privileges to earn doctorate degree. She graduated at Technological Institute of the Philippines – Manila with a degree of Doctor in Information Technology (DIT), her current research papers and system developed focused on the projects about the government.', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(2, 2, 1, 5, 'National University', NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(3, 3, 1, 5, 'National University', 'A graduate student at De La Salle University under the MS Computer Science program. I am also a full-time faculty member of the Computer Science Department at National University-Manila. My research works are focused on applying Natural Language Processing (NLP) on Philippine languages using Machine Learning and Deep Learning methods.', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(4, 4, 1, 3, 'National University', 'Dr. Arlene Trillanes is the Dean of the College of Computing and Information Technologies at National University, Manila.', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(5, 5, 1, 5, 'National University', 'Susan S. Caluya is a holder of a degree in Master of Science in Computer Science from AMA Computer College, Makati City. She earned her Bachelor of Science in Computer Science from Eulogio Amang Rodriguez Institute of Technology. Currently, she is the Chair of the Information Technology department of TIP Manila.', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(6, 6, 2, 5, 'National University', 'With a decade of strong years of experience in the academe, I had the opportunity to excel in teaching, research and extension which paved the way for my three Faculty Excellence Awards (2015, 2017, 2018) and six Faculty Research Awards from 2015 to 2020 all obtained from National University-Manila.', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(7, 7, 2, 4, 'National University', NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(8, 8, 1, 5, 'National University', NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(9, 9, 3, 2, 'National University', 'Dr. Ria Liza C. Canlas is an engineer, technologist and Intellectual Property expert. She obtained her degrees in Bachelor of Science in Civil Engineering at the Mapua Institute of Technology, Master of Engineering Management major in Construction Management at the Pamantasan ng Lungsod ng Maynila, and Doctor of Technology at the Technological University of the Philippines. She had researches published and several completed studies, as project leader, including Grant-in-aid studies funded by the Commission on Higher Education (CHED), Department of Science and Technology (DOST), and various institutional research projects. Her expertise is in research, project management, engineering and technology, and intellectual property. Presently, she is one of the Consultants at Strategic Research and Development, Inc (STRAND, Inc) and the Principal at Po-lite Technology Incorporated, RPM Business Solutions and CACTech Construction. Futhermore, she is into innovations through engagement in various experimental researches, mentoring and Intellectual Property concept trainings. She is a licensed Civil Engineer, Certified Materials Engineer 1 and Registered Patent Agent. She is presently the Assistant Research Director at National University. Also connected as independent Patent Consultant and Technical Expert of Intellectual Property Office of the University of the Philippines, Diliman. She has ongoing inventions under different stages (for development, for patent drafting, and filed).', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(10, 10, 3, 5, 'National University', 'Experienced Technical Consultant with a demonstrated history of working in the education management industry. Skilled in Management, Training, Instrumentation, Leadership, and Programmable Logic Controller (PLC). Strong sales professional with a Masters of Engineering focused in Electrical and Electronics Engineering from Technological University of the Philippines.', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(11, 11, 1, 5, 'National University', NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `focus`
--

DROP TABLE IF EXISTS `focus`;
CREATE TABLE IF NOT EXISTS `focus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `focus`
--

INSERT INTO `focus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'e-government & e-governance', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(2, 'disaster preparedness', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(3, 'android technology', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(4, 'data mining', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(5, 'artificial intelligence', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(6, 'e-learning', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(7, 'adaptive learning', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(8, 'emphatic coding', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(9, 'machine learning', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(10, 'readability assessment', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(11, 'ai for education', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(12, 'natural language processing', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(13, 'computational linguistics', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(14, 'computing technology', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(15, 'social computing', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(16, 'm-learning', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(17, 'mobile game continuance', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(18, 'is success theories', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(19, 'Green Technology', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(20, 'Innovations', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(21, 'Construction Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `innovations`
--

DROP TABLE IF EXISTS `innovations`;
CREATE TABLE IF NOT EXISTS `innovations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authors` mediumtext COLLATE utf8mb4_unicode_ci,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_by` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_file_requestable` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `date_published` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `innovations_posted_by_foreign` (`posted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `innovations`
--

INSERT INTO `innovations` (`id`, `title`, `authors`, `description`, `posted_by`, `url`, `is_file_requestable`, `is_featured`, `date_published`, `created_at`, `updated_at`) VALUES
(1, 'Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance', 'Lalaine P. Abad', 'The need to address societal issues of every community is a salient aspect that demands attention from the people in authority. These are important responsibilities of every barangay and its official in the Philippines. Profiling each household in the community using information and communication technology could achieve good governance through E-government as its core. Once profile data is aggregated, essential information could provide statistics in labor and employment, family income and expenditures, demography by (population) and (age), water and sanitation, type of housing and education. The focus is based on the profiling of Zone 42 and adding other facets as mentioned above was initiated, with the idea that educational institution around the barangay can help towards the areas included. This paper intends to aid barangay official in budget allocation and decision making in their respective governed …', 1, 'https://scholar.google.com/scholar?oi=bibs&cluster=13452525736665322785&btnI=1&hl=en', 1, 1, '2020-08-15', '2022-06-09 07:41:25', '2022-06-11 07:41:25'),
(2, 'Barriers and challenges of computing students in an online learning environment: Insights from one private university in the Philippines', 'Jeshnile R. Sarmiento', 'While the literature presents various advantages of using blended learning, policymakers must identify the barriers and challenges faced by students that may cripple their online learning experience. Understanding these barriers can help academic institutions craft policies to advance and improve the students\' online learning experience. This study was conducted to determine the challenges of computing students in one private University in the Philippines during the period where the entire Luzon region was placed under the Enhanced Community Quarantine (ECQ) as a response to the COVID-19 pandemic. A survey through MS Forms Pro was performed to identify the experiences of students in online learning. The survey ran from March 16 to March 18, 2020, which yielded a total of 300 responses. Descriptive statistics revealed that the top three barriers and challenges encountered by students were 1. the difficulty of clarifying topics or discussions with the professors, 2. the lack of study or working area for doing online activities, and 3. the lack of a good Internet connection for participating in online activities. It can be concluded that both students and faculty members were not fully prepared to undergo full online learning. More so, some faculty members may have failed to adapt to the needs of the students in an online learning environment. While the primary data of the study mainly came from the students, it would also be an excellent addition to understand the perspective of the faculty members in terms of their experiences with their students. Their insights could help validate the responses in the survey and provide other barriers that may …', 4, 'https://arxiv.org/abs/2012.02121', 1, 1, '2020-11-20', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(3, 'Exploring Hybrid Linguistic Feature Sets to Measure Filipino Text Readability', 'Ethel Ong', 'Proper identification of the difficulty level of materials prescribed as required readings in an educational setting is key towards effective learning in children. Educators and publishers have relied on readability formulas in predicting text readability. While these formulas abound in the English language, limited work has been done on automatic readability assessment for the Filipino language. In this study, we build upon the previous works using traditional (TRAD) and lexical (LEX) linguistic features by incorporating language model (LM) features for possible improvement in identifying readability levels of Filipino storybooks. Results showed that combining LM predictors to TRAD and LEX, forming a hybrid feature set, increased the performances of readability models trained using Logistic Regression and Support Vector Machines by up to ≈ 25% – 32%. From the results of performing feature selection using …', 3, 'https://ieeexplore.ieee.org/abstract/document/9310473', 1, 0, '2020-12-04', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(4, 'Sample PDF Upload', 'これは例です。', 'A sample pdf upload for testing and presentation purposes.', 1, NULL, 1, 1, '2021-05-04', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(5, 'SYSTEM AND METHODS FOR INTEGRATED TRACKING OF PUBLIC TRANSIT VEHICLES AND REAL-TIME TRAFFIC CONGESTION', 'Leonila B. Valdez', 'The object of the present invention is to provide consolidated mobile/web applications for train passengers in order to aid them in finding the best route to their destinations and their connectivity like alternative mode of transportation per stations for train administrators to manage passenger congestion. Furthermore, the present invention enables the train passengers to view the following integrated information from trains: (a) fare matrix, (b) time matrix, (c) data analytics of passenger congestion, (d) video streaming per stations, (e) incident alerts, and (f) PWD assistance and other services and announcements from commuters and train management.', 9, 'http://121.58.254.45/PatGazette/IPASJournal/V24N4_Inv_1st.pdf', 1, 0, '2019-03-06', '2022-06-11 07:41:25', '2022-06-11 07:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `innovation_authors`
--

DROP TABLE IF EXISTS `innovation_authors`;
CREATE TABLE IF NOT EXISTS `innovation_authors` (
  `innovation_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  KEY `innovation_authors_innovation_id_foreign` (`innovation_id`),
  KEY `innovation_authors_staff_id_foreign` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `innovation_authors`
--

INSERT INTO `innovation_authors` (`innovation_id`, `staff_id`) VALUES
(1, 1),
(1, 2),
(1, 8),
(2, 6),
(2, 4),
(3, 3),
(5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `innovation_files`
--

DROP TABLE IF EXISTS `innovation_files`;
CREATE TABLE IF NOT EXISTS `innovation_files` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `innovation_id` int(10) UNSIGNED NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `innovation_files_innovation_id_foreign` (`innovation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `innovation_files`
--

INSERT INTO `innovation_files` (`id`, `innovation_id`, `original_name`, `file`) VALUES
(1, 4, 'sample_pdf.pdf', 'sample_pdf.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `innovation_focus`
--

DROP TABLE IF EXISTS `innovation_focus`;
CREATE TABLE IF NOT EXISTS `innovation_focus` (
  `innovation_id` int(10) UNSIGNED NOT NULL,
  `focus_id` int(10) UNSIGNED NOT NULL,
  KEY `innovation_focus_innovation_id_foreign` (`innovation_id`),
  KEY `innovation_focus_focus_id_foreign` (`focus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `innovation_focus`
--

INSERT INTO `innovation_focus` (`innovation_id`, `focus_id`) VALUES
(1, 1),
(2, 6),
(3, 12),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic_id` int(10) UNSIGNED NOT NULL,
  `faculty_staff_id` int(10) UNSIGNED NOT NULL,
  `material_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materials_topic_id_foreign` (`topic_id`),
  KEY `materials_faculty_staff_id_foreign` (`faculty_staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `topic_id`, `faculty_staff_id`, `material_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Logo Documentation', 'In this course material, I will be discussing on how to create a documentation for a logo or brand. This material would include the important information that should be in the documentation, formatting the document and detailed user instruction.', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(2, 2, 1, 'Basics of MS Powerpoint', 'PowerPoint presentations work like slide shows. To convey a message or a story, you break it down into slides. Think of each slide as a blank canvas for the pictures and words that help you tell your story. In this course material, I would be teaching you on how to', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(3, 3, 1, 'Getting started with GitLab', 'In this course material, I will be discussing on how to get started with GitLab to practice version control on all programming related projects. This course materials includes introduction to GitLab, setting up, creating a repository, etc.', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(4, 3, 1, 'Object-Oriented Programming', 'In this course material, I would be teaching object-oriented programming. It is used to structure a software program into simple, reusable pieces of code blueprints (usually called classes), which are used to create individual instances of objects', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(5, 4, 1, 'Developers Timeline', 'In this course material, I will be discussing on how to create a developer\'s timeline to track project timeline using Microsoft Excel. This material includes formatting of document and creating a Gantt chart. This material would ensure to increase productivity.', '2022-06-11 07:41:25', '2022-06-11 07:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `material_files`
--

DROP TABLE IF EXISTS `material_files`;
CREATE TABLE IF NOT EXISTS `material_files` (
  `material_id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `material_files_material_id_foreign` (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `material_links`
--

DROP TABLE IF EXISTS `material_links`;
CREATE TABLE IF NOT EXISTS `material_links` (
  `material_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `material_links_material_id_foreign` (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `material_links`
--

INSERT INTO `material_links` (`material_id`, `url`) VALUES
(1, 'http://myriad-files.herokuapp.com/'),
(2, 'http://myriad-files.herokuapp.com/'),
(3, 'http://myriad-files.herokuapp.com/'),
(4, 'http://myriad-files.herokuapp.com/'),
(5, 'http://myriad-files.herokuapp.com/');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2021_05_23_999999_create_password_resets_table', 1),
('2021_05_24_000000_create_roles_table', 1),
('2021_05_24_000001_create_privileges_table', 1),
('2021_05_24_000002_create_role_privileges_table', 1),
('2021_05_24_000003_create_users_table', 1),
('2021_05_24_000004_create_announcements_table', 1),
('2021_05_24_000005_create_staff_types_table', 1),
('2021_05_24_000006_create_college_table', 1),
('2021_05_24_000006_create_departments_table', 1),
('2021_05_24_000007_create_faculty_staff_table', 1),
('2021_05_24_000008_create_skill_table', 1),
('2021_05_24_000009_create_faculty_skill_table', 1),
('2021_05_24_000010_create_focus_table', 1),
('2021_05_24_000011_create_faculty_focus_table', 1),
('2021_05_24_000012_create_research_table', 1),
('2021_05_24_000013_create_research_focus_table', 1),
('2021_05_24_000014_create_innovation_table', 1),
('2021_05_24_000015_create_innovation_focus_table', 1),
('2021_05_31_101525_create_research_authors_table', 1),
('2021_06_01_025206_create_innovation_authors_table', 1),
('2021_06_28_091001_create_affiliations_table', 1),
('2021_06_28_091002_create_other_profiles_table', 1),
('2021_07_03_093803_create_topics_table', 1),
('2021_07_03_093805_create_materials_table', 1),
('2021_07_14_152615_create_research_files_table', 1),
('2021_07_14_152754_create_innovation_files_table', 1),
('2021_07_22_121239_create_material_files_table', 1),
('2021_07_22_121414_create_material_links_table', 1),
('2021_08_09_085937_create_var_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_profiles`
--

DROP TABLE IF EXISTS `other_profiles`;
CREATE TABLE IF NOT EXISTS `other_profiles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `website` enum('Facebook','Github','Google Scholar','LinkedIn','Twitter') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `other_profiles_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `other_profiles`
--

INSERT INTO `other_profiles` (`user_id`, `website`, `url`) VALUES
(1, 'Facebook', 'https://www.facebook.com/angelique.lacasandile.3'),
(1, 'Google Scholar', 'https://scholar.google.com/citations?hl=en&user=ZsEoUCgAAAAJ'),
(1, 'LinkedIn', 'https://www.linkedin.com/in/dr-angelique-lacasandile-034a3780/'),
(3, 'LinkedIn', 'https://www.linkedin.com/in/joseph-marvin-imperial-9382b9a7/'),
(7, 'Facebook', 'https://www.facebook.com/JayBermudezPH'),
(7, 'Google Scholar', 'https://scholar.google.com/citations?user=Tb8Zzk0AAAAJ&hl=en&oi=ao'),
(9, 'Facebook', 'https://www.facebook.com/rializa.centeno'),
(9, 'Google Scholar', 'https://scholar.google.com/citations?user=tCCqlbkAAAAJ&hl=en'),
(9, 'LinkedIn', 'https://www.linkedin.com/in/ria-canlas-0b788b4a/');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `name`) VALUES
(1, 'faculty_members'),
(2, 'faculty_members_create'),
(3, 'faculty_members_details'),
(4, 'faculty_members_skills'),
(5, 'faculty_members_contents'),
(6, 'faculty_members_delete'),
(7, 'announcements'),
(8, 'announcements_create'),
(9, 'announcements_details'),
(10, 'announcements_delete'),
(11, 'skills'),
(12, 'skills_create'),
(13, 'skills_edit'),
(14, 'skills_delete');

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

DROP TABLE IF EXISTS `research`;
CREATE TABLE IF NOT EXISTS `research` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authors` mediumtext COLLATE utf8mb4_unicode_ci,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_by` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_file_requestable` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `date_published` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `research_posted_by_foreign` (`posted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`id`, `title`, `authors`, `description`, `posted_by`, `url`, `is_file_requestable`, `is_featured`, `date_published`, `created_at`, `updated_at`) VALUES
(1, 'Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance', 'Lalaine P. Abad', 'The need to address societal issues of every community is a salient aspect that demands attention from the people in authority. These are important responsibilities of every barangay and its official in the Philippines. Profiling each household in the community using information and communication technology could achieve good governance through E-government as its core. Once profile data is aggregated, essential information could provide statistics in labor and employment, family income and expenditures, demography by (population) and (age), water and sanitation, type of housing and education. The focus is based on the profiling of Zone 42 and adding other facets as mentioned above was initiated, with the idea that educational institution around the barangay can help towards the areas included. This paper intends to aid barangay official in budget allocation and decision making in their respective governed …', 1, 'https://scholar.google.com/scholar?oi=bibs&cluster=13452525736665322785&btnI=1&hl=en', 1, 1, '2020-08-15', '2022-06-10 07:41:25', '2022-06-11 07:41:25'),
(2, 'Barriers and challenges of computing students in an online learning environment: Insights from one private university in the Philippines', 'Jeshnile R. Sarmiento', 'While the literature presents various advantages of using blended learning, policymakers must identify the barriers and challenges faced by students that may cripple their online learning experience. Understanding these barriers can help academic institutions craft policies to advance and improve the students\' online learning experience. This study was conducted to determine the challenges of computing students in one private University in the Philippines during the period where the entire Luzon region was placed under the Enhanced Community Quarantine (ECQ) as a response to the COVID-19 pandemic. A survey through MS Forms Pro was performed to identify the experiences of students in online learning. The survey ran from March 16 to March 18, 2020, which yielded a total of 300 responses. Descriptive statistics revealed that the top three barriers and challenges encountered by students were 1. the difficulty of clarifying topics or discussions with the professors, 2. the lack of study or working area for doing online activities, and 3. the lack of a good Internet connection for participating in online activities. It can be concluded that both students and faculty members were not fully prepared to undergo full online learning. More so, some faculty members may have failed to adapt to the needs of the students in an online learning environment. While the primary data of the study mainly came from the students, it would also be an excellent addition to understand the perspective of the faculty members in terms of their experiences with their students. Their insights could help validate the responses in the survey and provide other barriers that may …', 4, 'https://arxiv.org/abs/2012.02121', 1, 1, '2020-11-20', '2022-05-11 07:41:25', '2022-06-11 07:41:25'),
(3, 'Exploring Hybrid Linguistic Feature Sets to Measure Filipino Text Readability', 'Ethel Ong', 'Proper identification of the difficulty level of materials prescribed as required readings in an educational setting is key towards effective learning in children. Educators and publishers have relied on readability formulas in predicting text readability. While these formulas abound in the English language, limited work has been done on automatic readability assessment for the Filipino language. In this study, we build upon the previous works using traditional (TRAD) and lexical (LEX) linguistic features by incorporating language model (LM) features for possible improvement in identifying readability levels of Filipino storybooks. Results showed that combining LM predictors to TRAD and LEX, forming a hybrid feature set, increased the performances of readability models trained using Logistic Regression and Support Vector Machines by up to ≈ 25% – 32%. From the results of performing feature selection using …', 3, 'https://ieeexplore.ieee.org/abstract/document/9310473', 1, 0, '2020-12-04', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(4, 'Sample PDF Upload', 'これは例です。', 'A sample pdf upload for testing and presentation purposes.', 1, NULL, 1, 1, '2021-05-04', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(5, 'Development of Load Moment Control and Monitoring System for Mobile Heavy Load Cranes', NULL, 'This study was conducted to develop a fully functional controlling and monitoring device to be used during the actual industrial operation of mobile heavy load cranes. The project aimed to provide a cost effective and user-friendly load moment indicator that meets the requirements of industry safety standards. The control system of the device measures and monitors the main parameters such as boom length, working radius, tip height, maximum load capacity based on crane load chart, actual load, efficiency and (actual load/maximum load) ratio. It was developed using the advanced application of Programmable Logic Controller (PLC) and latest technology of Human Machine Interface (HMI). The interface of Delta PLC and Delta HMI was able to replace the traditional controlling panels which need extensive wiring and the monitoring screen allows the user to complete settings through touchable keys on a user-friendly window. The performance of the implemented load moment control and monitoring system was evaluated and compared to the standard manufacturer rated lifting load chart. A series of tests was conducted and the results attest that the developed device successfully attained its functionality with an average of 99% accuracy on all the readings.', 10, NULL, 1, 0, '2022-06-11', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(6, '“How do people view the estuary and the technology management practices to rehabilitate it?”: The case of Estero de Paco in Manila', 'Rex P Bringula,Jovy M Afable,Roque Gajo,Ma Carmelita Santos,Arlen A Ancheta', 'This descriptive study determined the profile of the people living near Estero de Paco in Manila. It also determined their attitudes and perceptions towards the use and purpose of the estuary and the technology management practices employed to rehabilitate it. It was revealed that most of the respondents were male, young, high school graduate, born in CALABARZON and NCR, had no permanent occupation, belonged to lower income class family with five or six members, living in family owned houses made of wood and cement for at least 20 years and living near the estero. Proximity to work was the main purpose of living near the estero. It was also revealed that they participated in various ways to clean up the estero. They perceived that there were efforts to rehabilitate the estero and technology management practices were visible and important. However, they also perceived that these practices were temporary …', 9, 'https://ieeexplore.ieee.org/abstract/document/7011605/', 1, 0, '2014-08-19', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(7, 'Determinants of the best practices on practicum programs in engineering courses of selected higher education institutes in the Philippines', 'Miriam R Borja,Laarnie D Macapagal,Emerita Hinojales', 'In the attempt to identify the determinants of the best practices on practicum programs, this study looked at what is prevalent within the Philippine educational system and to surface information to evolve a more feasible concept of best practices on one of the popular courses which as engineering. The study employed descriptive - causal, explanatory and exploratory research. Data were gathered using Delphi-technique from representatives coming from institutions and industries and in-depth interview from students. The research instrument was validated by four experts. Reliability test was done by pre-testing the instrument on four Higher Education Institutions (HEI) in Luzon. Factor analysis was employed to determine the indicators of best practices while multiple regression was employed to identify the determinants of best practices and to test mediational relationships of variables. Seven indicators of best …', 9, 'https://ieeexplore.ieee.org/abstract/document/6654513', 1, 0, '2013-08-26', '2022-06-11 07:41:25', '2022-06-11 07:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `research_authors`
--

DROP TABLE IF EXISTS `research_authors`;
CREATE TABLE IF NOT EXISTS `research_authors` (
  `research_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  KEY `research_authors_research_id_foreign` (`research_id`),
  KEY `research_authors_staff_id_foreign` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `research_authors`
--

INSERT INTO `research_authors` (`research_id`, `staff_id`) VALUES
(1, 1),
(1, 2),
(1, 8),
(2, 6),
(2, 4),
(3, 3),
(6, 9),
(7, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `research_files`
--

DROP TABLE IF EXISTS `research_files`;
CREATE TABLE IF NOT EXISTS `research_files` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `research_id` int(10) UNSIGNED NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `research_files_research_id_foreign` (`research_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `research_files`
--

INSERT INTO `research_files` (`id`, `research_id`, `original_name`, `file`) VALUES
(1, 4, 'sample_pdf.pdf', 'sample_pdf.pdf'),
(2, 5, 'Development-of-Load-Moment-Control-and-Monitoring-System_Dimaculangan_IEEE-1.pdf', 'Development-of-Load-Moment-Control-and-Monitoring-System_Dimaculangan_IEEE-1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `research_focus`
--

DROP TABLE IF EXISTS `research_focus`;
CREATE TABLE IF NOT EXISTS `research_focus` (
  `research_id` int(10) UNSIGNED NOT NULL,
  `focus_id` int(10) UNSIGNED NOT NULL,
  KEY `research_focus_research_id_foreign` (`research_id`),
  KEY `research_focus_focus_id_foreign` (`focus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `research_focus`
--

INSERT INTO `research_focus` (`research_id`, `focus_id`) VALUES
(1, 1),
(2, 6),
(3, 12),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `role_privileges`
--

DROP TABLE IF EXISTS `role_privileges`;
CREATE TABLE IF NOT EXISTS `role_privileges` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `privilege_id` int(10) UNSIGNED NOT NULL,
  KEY `role_privileges_role_id_foreign` (`role_id`),
  KEY `role_privileges_privilege_id_foreign` (`privilege_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role_privileges`
--

INSERT INTO `role_privileges` (`role_id`, `privilege_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(2, 7),
(2, 8),
(2, 9),
(2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `skill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill`, `created_at`, `updated_at`) VALUES
(1, 'Business Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(2, 'Business Process Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(3, 'Consultancy', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(4, 'Curriculum Development', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(5, 'Event Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(6, 'Emphatic Computing', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(7, 'E-Business', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(8, 'Higher Education', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(9, 'Hosting Events', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(10, 'Information Technology', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(11, 'Information System Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(12, 'Information Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(13, 'Information Technology Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(14, 'IT Consulting', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(15, 'IT Project Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(16, 'Knowledge Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(17, 'MySQL', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(18, 'Programming', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(19, 'Project Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(20, 'Software Quality Assurance', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(21, 'Teaching', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(22, 'Patent Drafting', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(23, 'Materials Drafting', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(24, 'Technology Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25'),
(25, 'Intellectual Property Management', '2022-06-11 07:41:25', '2022-06-11 07:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `staff_types`
--

DROP TABLE IF EXISTS `staff_types`;
CREATE TABLE IF NOT EXISTS `staff_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `staff_types`
--

INSERT INTO `staff_types` (`id`, `type`) VALUES
(1, 'other'),
(2, 'director'),
(3, 'dean'),
(4, 'program_chair'),
(5, 'professor');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `topic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic_name`) VALUES
(1, 'Branding'),
(2, 'Microsoft'),
(3, 'Programming'),
(4, 'Project Management');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isAvatarLink` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_contact_no_unique` (`contact_no`),
  KEY `users_role_foreign` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `first_name`, `middle_name`, `last_name`, `suffix`, `avatar`, `isAvatarLink`, `email`, `username`, `contact_no`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `expiration_date`) VALUES
(1, NULL, 'Angelique', 'D', 'Lacasandile', NULL, 'user1.jpg', 0, 'angelique.lacasandile@gmail.com', 'lacasandillea', '966 712 5676', '$2y$10$aPVxZ8eunnpyIaJiSc.GyOjDgPENAVDMAAvusW5qdzXx39zREwGOu', 1, NULL, '2022-06-11 07:41:24', '2022-06-11 07:41:24', NULL),
(2, NULL, 'Mideth', 'B', 'Abisado', NULL, 'user2.jpg', 0, 'mbabisado@national-u.edu.ph', 'abisadomb', NULL, '$2y$10$FSvD4qhNQgoPwldCJCi3ZeUXXhBs7W2oa9oTm0xiugZjVw9BPQwvO', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(3, NULL, 'Joseph Marvin', NULL, 'Imperial', NULL, 'user3.jpg', 0, 'jrimperial@national-u.edu.ph', 'imperialjm', NULL, '$2y$10$M.wjHgaU5iqow6itunJQH.GK9JxyjgA0.bxoAP.ReJr74rCPu8hzq', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(4, NULL, 'Arlene', 'O', 'Trillanes', NULL, 'user4.jpg', 0, 'aotrillanes@national-u.edu.ph', 'trillanesao', NULL, '$2y$10$7fVmwCDasZiJl7So7TOPkOZEd.fL4.FWDM8EQPzqPAf7KsU7bWjt6', 1, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(5, NULL, 'Susan', 'S', 'Caluya', NULL, 'user5.jpg', 0, 'sscaluya@national-u.edu.ph', 'caluyass', NULL, '$2y$10$Az1gznToLISgPdVZwf27t.BQpYT0Q43I.lHIxDgTnQyDT4hDJUoz.', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(6, NULL, 'Bernie', 'S', 'Fabito', NULL, 'user6.jpg', 0, 'bsfabito@national-u.edu.ph', 'fabitobs', NULL, '$2y$10$81XVZKZu6Fd46tr2TGOkXucSqXQBbh0pEO07LvB4Hf/8GLHskwecu', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(7, NULL, 'Jayson Raymund', 'D', 'Bermudez', NULL, 'user7.jpg', 0, 'jrdbermudez@national-u.edu.ph', 'bermudezjrd', NULL, '$2y$10$n5C4snGFmpEzTafb180mSunyl2vgcMgjSJNyJQytVuV3cvAjroD9G', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(8, NULL, 'Rogel', 'M', 'Labanan', NULL, 'user8.jpg', 0, NULL, 'labananrm', NULL, '$2y$10$j.CKtSEn0/nwdYnajcRlh.n5b43DewV4NXMgt7RHVgQwSR//uTd0y', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(9, NULL, 'Ria Liza', 'C', 'Canlas', NULL, 'user9.jpg', 0, 'rlccanlas@national-u.edu.ph', 'canlasrl', NULL, '$2y$10$JV.HVdE.S2nxQ9/1RhdlYeabW6srNyeab21rWS1Cq4GCb12Z4XjJC', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(10, NULL, 'Rafael', 'A', 'Dimaculangan', NULL, 'user10.jpg', 0, NULL, 'dimaculanganra', NULL, '$2y$10$yEkbLLLWz9B.F.VWm7p7ROBTTYPZ36sH4iNwzqJRoN2p6qGiuLUBW', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(11, NULL, 'Gabrielle Avelino', NULL, 'Sampedro', NULL, NULL, 0, NULL, 'sampedroga', NULL, '$2y$10$xw0uc2lhpbJpl1sBkdttbO37DW8IVGxC04A2gMh8XbEPTItN8z3QS', 3, NULL, '2022-06-11 07:41:25', '2022-06-11 07:41:25', NULL),
(12, NULL, 'カール・サッチ', 'エスゲラ', 'ナビダ', NULL, 'https://avatars.githubusercontent.com/u/19548426?v=4', 1, 'satchi5600@gmail.com', 'navidake', '933 819 3519', '$2y$10$aPVxZ8eunnpyIaJiSc.GyOjDgPENAVDMAAvusW5qdzXx39zREwGOu', 1, 'exZaoxN1ea7yHJRZcAsPPesyzRkOmNGlKiTGU9bkORKidCxzZz1qvmnW17s4', '2022-06-11 08:06:49', '2022-06-11 08:08:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `var`
--

DROP TABLE IF EXISTS `var`;
CREATE TABLE IF NOT EXISTS `var` (
  `option_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affiliations`
--
ALTER TABLE `affiliations`
  ADD CONSTRAINT `affiliations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_college_foreign` FOREIGN KEY (`college`) REFERENCES `colleges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faculty_focus`
--
ALTER TABLE `faculty_focus`
  ADD CONSTRAINT `faculty_focus_faculty_staff_id_foreign` FOREIGN KEY (`faculty_staff_id`) REFERENCES `faculty_staffs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faculty_focus_focus_id_foreign` FOREIGN KEY (`focus_id`) REFERENCES `focus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faculty_skills`
--
ALTER TABLE `faculty_skills`
  ADD CONSTRAINT `faculty_skills_faculty_staff_id_foreign` FOREIGN KEY (`faculty_staff_id`) REFERENCES `faculty_staffs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faculty_skills_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faculty_staffs`
--
ALTER TABLE `faculty_staffs`
  ADD CONSTRAINT `faculty_staffs_position_foreign` FOREIGN KEY (`position`) REFERENCES `staff_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faculty_staffs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `innovations`
--
ALTER TABLE `innovations`
  ADD CONSTRAINT `innovations_posted_by_foreign` FOREIGN KEY (`posted_by`) REFERENCES `faculty_staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `innovation_authors`
--
ALTER TABLE `innovation_authors`
  ADD CONSTRAINT `innovation_authors_innovation_id_foreign` FOREIGN KEY (`innovation_id`) REFERENCES `innovations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `innovation_authors_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `faculty_staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `innovation_files`
--
ALTER TABLE `innovation_files`
  ADD CONSTRAINT `innovation_files_innovation_id_foreign` FOREIGN KEY (`innovation_id`) REFERENCES `innovations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `innovation_focus`
--
ALTER TABLE `innovation_focus`
  ADD CONSTRAINT `innovation_focus_focus_id_foreign` FOREIGN KEY (`focus_id`) REFERENCES `focus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `innovation_focus_innovation_id_foreign` FOREIGN KEY (`innovation_id`) REFERENCES `innovations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_faculty_staff_id_foreign` FOREIGN KEY (`faculty_staff_id`) REFERENCES `faculty_staffs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materials_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `material_files`
--
ALTER TABLE `material_files`
  ADD CONSTRAINT `material_files_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `material_links`
--
ALTER TABLE `material_links`
  ADD CONSTRAINT `material_links_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `other_profiles`
--
ALTER TABLE `other_profiles`
  ADD CONSTRAINT `other_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `research_posted_by_foreign` FOREIGN KEY (`posted_by`) REFERENCES `faculty_staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `research_authors`
--
ALTER TABLE `research_authors`
  ADD CONSTRAINT `research_authors_research_id_foreign` FOREIGN KEY (`research_id`) REFERENCES `research` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `research_authors_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `faculty_staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `research_files`
--
ALTER TABLE `research_files`
  ADD CONSTRAINT `research_files_research_id_foreign` FOREIGN KEY (`research_id`) REFERENCES `research` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `research_focus`
--
ALTER TABLE `research_focus`
  ADD CONSTRAINT `research_focus_focus_id_foreign` FOREIGN KEY (`focus_id`) REFERENCES `focus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `research_focus_research_id_foreign` FOREIGN KEY (`research_id`) REFERENCES `research` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_privileges`
--
ALTER TABLE `role_privileges`
  ADD CONSTRAINT `role_privileges_privilege_id_foreign` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_privileges_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
