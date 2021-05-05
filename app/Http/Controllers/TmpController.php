<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Announcements;
use App\FacultyStaff;
use App\Research;
use App\ResearchFocus;
use App\Skills;
use App\User;

class TmpController extends Controller
{
	// TEMPORARY SUBSTITUTE... TO BE REMOVE ONCE BACKEND IS ATTACHED
	public static function getStaff() {
		$staff = FacultyStaff::hydrate([
			(object) [
				'id' => 1,
				'avatar' => 'user1.jpg',
				'first_name' => 'Angelique',
				'last_name' => 'Lacasandille',
				'title' => 'Dr.',
				'suffix' => null,
				'name' => 'Dr. Angelique Lacasandille',
				'department' => 'Computer Science',
				'position' => 'Department Chair, National University',
				'description' => 'Dr. Angelique D. Lacasandile is the Department Chair of the Computer Science Department at National University, Manila. She is also the Academe and Industry Linkage Coordinator, and a recipient of CHED Scholarship for Graduate Studies that enjoys full-privileges to earn doctorate degree. She graduated at Technological Institute of the Philippines – Manila with a degree of Doctor in Information Technology (DIT), her current research papers and system developed focused on the projects about the government.',
				'contact_no' => '966 712 5676',
				'email' => 'angelique.lacasandile@gmail.com',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Consultancy'],
					(object)['id' => 2, 'skill' => 'Business Management'],
					(object)['id' => 3, 'skill' => 'Software Quality Assurance'],
					(object)['id' => 4, 'skill' => 'Higher Education'],
					(object)['id' => 5, 'skill' => 'Programming'],
					(object)['id' => 6, 'skill' => 'Hosting Events'],
					(object)['id' => 7, 'skill' => 'MySQL'],
					(object)['id' => 8, 'skill' => 'Project Management'],
					(object)['id' => 9, 'skill' => 'Curriculum Development'],
					(object)['id' => 10, 'skill' => 'Event Management'],
					(object)['id' => 11, 'skill' => 'IT Consulting'],
					(object)['id' => 12, 'skill' => 'Teaching']
				]),
				'focus' => ResearchFocus::hydrate([
					(object)['id' => 1, 'name' => 'E-Government & E-Governance'],
					(object)['id' => 2, 'name' => 'Disaster Preparedness'],
					(object)['id' => 3, 'name' => 'Android Technology'],
					(object)['id' => 4, 'name' => 'Data Mining']
				])
			],
			(object) [
				'id' => 2,
				'avatar' => 'user2.jpg',
				'first_name' => 'Abisado',
				'last_name' => 'Mideth',
				'title' => null,
				'suffix' => null,
				'name' => 'Mideth B. Abisado',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => null,
				'contact_no' => null,
				'email' => 'mbabisado@national-u.edu.ph',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Information Technology'],
					(object)['id' => 2, 'skill' => 'Knowledge Management'],
					(object)['id' => 3, 'skill' => 'E-Business'],
					(object)['id' => 4, 'skill' => 'IT Project Management'],
					(object)['id' => 5, 'skill' => 'Information System Management'],
					(object)['id' => 6, 'skill' => 'Information Management'],
					(object)['id' => 7, 'skill' => 'Information Technology Management'],
					(object)['id' => 8, 'skill' => 'Business Process Management'],
					(object)['id' => 9, 'skill' => 'Emphatic Computing'],
					(object)['id' => 10, 'skill' => 'Teaching'],
					(object)['id' => 11, 'skill' => 'Higher Education'],
					(object)['id' => 12, 'skill' => 'Programming']
				]),
				'focus' => ResearchFocus::hydrate([
					(object)['id' => 1, 'name' => 'Artificial Intelligence'],
					(object)['id' => 2, 'name' => 'e-Learning'],
					(object)['id' => 3, 'name' => 'Adaptive Learning'],
					(object)['id' => 4, 'name' => 'Emphatic Coding'],
					(object)['id' => 5, 'name' => 'Machine Learning']
				])
			],
			(object) [
				'id' => 3,
				'avatar' => 'user3.jpg',
				'first_name' => 'Joseph Marvin',
				'last_name' => 'Imperial',
				'title' => null,
				'suffix' => null,
				'name' => 'Joseph Marvin Imperial',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => 'A graduate student at De La Salle University under the MS Computer Science program. I am also a full-time faculty member of the Computer Science Department at National University-Manila. My research works are focused on applying Natural Language Processing (NLP) on Philippine languages using Machine Learning and Deep Learning methods.',
				'contact_no' => null,
				'email' => 'mbabisado@national-u.edu.ph',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Higher Education'],
					(object)['id' => 2, 'skill' => 'Programming'],
					(object)['id' => 3, 'skill' => 'Hosting Events'],
					(object)['id' => 4, 'skill' => 'MySQL'],
					(object)['id' => 5, 'skill' => 'Project Management'],
					(object)['id' => 6, 'skill' => 'Curriculum Development'],
					(object)['id' => 7, 'skill' => 'Event Management'],
					(object)['id' => 8, 'skill' => 'IT Consulting'],
					(object)['id' => 9, 'skill' => 'Teaching']
				]),
				'focus' => ResearchFocus::hydrate([
					(object)['id' => 1, 'name' => 'Readability Assessment'],
					(object)['id' => 2, 'name' => 'AI for Education'],
					(object)['id' => 3, 'name' => 'Natural Language Processing'],
					(object)['id' => 4, 'name' => 'Computational Linguistics']
				])
			],
			(object) [
				'id' => 4,
				'avatar' => 'user4.jpg',
				'first_name' => 'Arlene O.',
				'last_name' => 'Trillanes',
				'title' => 'Dr.',
				'suffix' => null,
				'name' => 'Dr. Arlene O. Trillanes',
				'department' => 'College of Computing and Information Technology (CCIT)',
				'position' => 'Dean, National University',
				'description' => 'Dr. Arlese Trillanes is the Dean of the College of Computing and Information Technologies at National University, Manila.',
				'contact_no' => null,
				'email' => 'aotrillanes@national-u.edu.ph',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Business Management'],
					(object)['id' => 2, 'skill' => 'Consultancy'],
					(object)['id' => 3, 'skill' => 'Curriulum Development'],
					(object)['id' => 4, 'skill' => 'Event Management'],
					(object)['id' => 5, 'skill' => 'Higher Education'],
					(object)['id' => 6, 'skill' => 'Hosting Events'],
					(object)['id' => 7, 'skill' => 'IT Consulting'],
					(object)['id' => 8, 'skill' => 'MySQL'],
					(object)['id' => 9, 'skill' => 'Programming'],
					(object)['id' => 10, 'skill' => 'Project Management'],
					(object)['id' => 11, 'skill' => 'Software Quality Assurance'],
					(object)['id' => 12, 'skill' => 'Teaching']
				]),
				'focus' => null
			],
			(object) [
				'id' => 5,
				'avatar' => 'user5.jpg',
				'first_name' => 'Susan',
				'last_name' => 'Caluya',
				'title' => null,
				'suffix' => null,
				'name' => 'Susan S. Caluya',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => 'Susan S. Caluya is a holder of a degree in Master of Science in Computer Science from AMA Computer College, Makati City. She earned her Bachelor of Science in Computer Science from Eulogio Amang Rodriguez Institute of Technology. Currently, she is the Chair of the Information Technology department of TIP Manila.',
				'contact_no' => null,
				'email' => 'sscaluya@national-u.edu.ph',
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Higher Education'],
					(object)['id' => 2, 'skill' => 'Programming'],
					(object)['id' => 3, 'skill' => 'Hosting Events'],
					(object)['id' => 4, 'skill' => 'Project Management'],
					(object)['id' => 5, 'skill' => 'Curriculum Development'],
					(object)['id' => 6, 'skill' => 'Event Management'],
					(object)['id' => 7, 'skill' => 'IT Consulting'],
					(object)['id' => 8, 'skill' => 'Teaching']
				]),
				'focus' => ResearchFocus::hydrate([
					(object)['id' => 1, 'name' => 'Computing Technology']
				])
			],
			// (object) [
			// 	'id' => 6,
			// 	'avatar' => 'user6.jpg',
			// 	'first_name' => 'Bernie',
			// 	'last_name' => 'Fabito',
			// 	'title' => null,
			// 	'suffix' => null,
			// 	'name' => 'Bernie S. Fabito',
			// 	'department' => 'Computer Science',
			// 	'position' => 'Professor, National University',
			// 	'description' => 'With a decade of strong years of experience in the academe, I had the opportunity to excel in teaching, research and extension which paved the way for my three Faculty Excellence Awards (2015, 2017, 2018) and six Faculty Research Awards from 2015 to 2020 all obtained from National University-Manila.',
			// 		//My experience includes serving as a faculty member dedicated to providing quality outcome-based education, a University Research Coordinator (2020) under the NU Center for Entrepreneurship, an OIC program chair for BSCS (2017), Student Council Adviser (2019), College Research Coordinator (2016 - 2019) , Computing Research Center Coordinator (2017, 2020) under the College of Computing and Information Technologies, Conference Chair and Conference-Vice Chair for the Inter-School Computing Research Conference 2018 and 2019 respectively, a peer-reviewer for the ff: CHED accredited journal (Recoletos Multidisciplinary Research Journal), international conferences, (http://www.icset.org/com.html, http://www.fcce.org/, http://www.iccc.org/committee.html), and national conferences (PSITE-NCR-IRC, PCSC). I am currently an associate member of the National Research Center of the Philippines (NRCP).
			// 		//I have had the opportunity to publish, and present research papers both in national and international venues like Taiwan, Malaysia, USA (recipient of the ACM SIGMIS paper presentation scholarship), Japan, South Korea (won the best paper for IEEE TENCON 2018 - 1st author), Indonesia, Singapore, and Macau all of which were indexed in Scopus. My research interests fall under the Social and Mobile Computing and Human-Computer Interaction (HCI).
			// 		//Presently, I serve as Program Chair of the Graduate Programs of NU-CCIT. I hold a Bachelor’s Degree in Information Technology, MS in Information Technology (MSIT) from the Polytechnic University of the Philippines, and currently pursuing my dissertation for the Doctor in Information Technology degree program of De La Salle University.',
			// 	'contact_no' => null,
			// 	'email' => 'bsfabito@national-u.edu.ph',
			// 	'skills' => Skills::hydrate([
			// 		(object)['id' => 1, 'skill' => 'Higher Education'],
			// 		(object)['id' => 2, 'skill' => 'Programming'],
			// 		(object)['id' => 3, 'skill' => 'Hosting Events'],
			// 		(object)['id' => 4, 'skill' => 'Project Management'],
			// 		(object)['id' => 5, 'skill' => 'Curriculum Development'],
			// 		(object)['id' => 6, 'skill' => 'Event Management'],
			// 		(object)['id' => 7, 'skill' => 'IT Consulting'],
			// 		(object)['id' => 8, 'skill' => 'Teaching']
			// 	]),
			// 	'focus' => ResearchFocus::hydrate([
			// 		(object)['id' => 1, 'name' => 'Social Computing'],
			// 		(object)['id' => 2, 'name' => 'M-Learning'],
			// 		(object)['id' => 3, 'name' => 'Mobile Game Continuance'],
			// 		(object)['id' => 4, 'name' => 'IS Success Theories'],
			// 		(object)['id' => 5, 'name' => 'E-Governance']
			// 	])
			// ],
			(object) [
				'id' => 7,
				'avatar' => 'user7.jpg',
				'first_name' => 'Mark Emmanuel',
				'last_name' => 'Malimban',
				'title' => null,
				'suffix' => null,
				'name' => 'Mark Emmanuel Malimban',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => 'Driven with passion and concrete objectives to meet a high quality and technologically in-lined actions for short and long term goals.',
				'contact_no' => null,
				'email' => null,
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Higher Education'],
					(object)['id' => 2, 'skill' => 'Programming'],
					(object)['id' => 3, 'skill' => 'Teaching']
				]),
				'focus' => null
			],
			(object) [
				'id' => 8,
				'avatar' => null,
				'first_name' => 'Rogel',
				'last_name' => 'Labanan',
				'title' => null,
				'suffix' => null,
				'name' => 'Rogel M. Labanan',
				'department' => 'Computer Science',
				'position' => 'Professor, National University',
				'description' => null,
				'contact_no' => null,
				'email' => null,
				'skills' => Skills::hydrate([
					(object)['id' => 1, 'skill' => 'Higher Education'],
					(object)['id' => 2, 'skill' => 'Programming'],
					(object)['id' => 3, 'skill' => 'Teaching']
				]),
				'focus' => null
			]
		]);

		return $staff;
	}

	public static function getSkillList() {
		$skill = Skills::hydrate([
			(object)['id' => 1, 'skill' => 'Business Management'],
			(object)['id' => 2, 'skill' => 'Business Process Management'],
			(object)['id' => 3, 'skill' => 'Consultancy'],
			(object)['id' => 4, 'skill' => 'Curriulum Development'],
			(object)['id' => 5, 'skill' => 'Event Management'],
			(object)['id' => 6, 'skill' => 'Emphatic Computing'],
			(object)['id' => 7, 'skill' => 'E-Business'],
			(object)['id' => 8, 'skill' => 'Higher Education'],
			(object)['id' => 9, 'skill' => 'Hosting Events'],
			(object)['id' => 10, 'skill' => 'Information Technology'],
			(object)['id' => 11, 'skill' => 'Information System Management'],
			(object)['id' => 12, 'skill' => 'Information Management'],
			(object)['id' => 13, 'skill' => 'Information Technology Management'],
			(object)['id' => 14, 'skill' => 'IT Consulting'],
			(object)['id' => 15, 'skill' => 'IT Project Management'],
			(object)['id' => 16, 'skill' => 'Knowledge Management'],
			(object)['id' => 17, 'skill' => 'MySQL'],
			(object)['id' => 18, 'skill' => 'Programming'],
			(object)['id' => 19, 'skill' => 'Project Management'],
			(object)['id' => 20, 'skill' => 'Software Quality Assurance'],
			(object)['id' => 21, 'skill' => 'Teaching']
		]);

		return $skill;
	}

	public static function getAnnouncements() {
		$announcements = Announcements::hydrate([
			(object)[
				'id' => 1,
				'image' => 'announcement1.jpg',
				'title' => 'Payment Options',
				'content' => '
					<p>Good news, Nationalians!</p>
					<p>Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.</p>
					<p>You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.</p>',
				'source' => 'https://www.national-u.edu.ph/payment-options/',
				'created_at' => \Carbon\Carbon::parse('2021-03-18')
			],
			(object)[
				'id' => 2,
				'image' => 'announcement2.jpg',
				'title' => 'BDO EasyPay Cash Tuition Program',
				'content' => '<p>EASYPAY-CASH-TUITION-PROMO-MECHANICS-v121620</p>',
				'source' => 'https://www.national-u.edu.ph/payment-options',
				'created_at' => \Carbon\Carbon::parse('2021-02-15')
			],
			(object)[
				'id' => 3,
				'image' => 'announcement3.jpg',
				'title' => 'NU Manila’s COE hosts REFOREST 2020: For Vivid Solutions',
				'content' => '
					<p>The National University Manila’s College of Engineering along with PICE and PSSE student chapters of NU successfully hosted the virtual REFOREST 2020: For Vivid Solutions, last January 29 with 1500 global crowd in attendance.</p>
					<p>Research Forum and Exhibition on Environmental Sustainability and Technologies (REFOREST) aims to produce solutions that will address relevant environmental crises both for present and in the future.</p>
					<p>Reputable plenary speakers, forum discussants and presenters were present to share their knowledge and experience in the significance of wise environmental decision-making in a well-functioning ecosystem.</p>
					<p>To top off the event, National-U’s Electronics and Communications Engineering alumnus, Jayvee Boy H. Agustin, was awarded the Best Paper Presenter for the topic: “Development of Subsystems for a Web-based Survey Tool Using Automatic Speech and Optical Character Recognition with Geotagging Features.”</p>
					<p>With the mission to combat emerging natural and environmental conflicts, REFOREST 2020 will indeed help us attain a sustainable environment.</p>',
				'source' => 'https://www.national-u.edu.ph/payment-options/',
				'created_at' => \Carbon\Carbon::parse('2021-01-31')
			],
			(object)[
				'id' => 4,
				'image' => 'announcement4.jpg',
				'title' => 'Enrollment for 1st Term AY 2021-2022 is ongoing.',
				'content' => '
					<p>
						The NU Manila ENROLLMENT for 1st Term AY 2021-2022 is ONGOING.<br>
						Applicants may register online via <a href="bit.ly/NUManilaOnlineApplication">bit.ly/NUManilaOnlineApplication</a>.
					</p>
					
					<p>To all ENROLLEES of 1st Term AY 2021-2022 (Freshmen, Transferee, 2nd Degree, Graduate Studies, and Cross Enrollee) kindly upload your requirements here:</p>
					
					<p>For FRESHMEN Online Enrollment: <a href="http://bit.ly/NUMNLFreshmenEnrollment">http://bit.ly/NUMNLFreshmenEnrollment</a></p>
					
					<p>For Transferee, 2nd Degree, Graduate Studies and Cross Enrollees:<br><a href="http://bit.ly/NUMNLOnlineEnrollment">http://bit.ly/NUMNLOnlineEnrollment</a></p>
					
					<p>Should you have any questions, please don\'t hesitate to reach us at: </p>
					
					<p>
						📧 : <a href="mailto:admissions@national-u.edu.ph">admissions@national-u.edu.ph</a><br>
						📞 : 09479961932 and 09479961933 (Smart) / 09223016192 (Sun)<br>
						☎️ : 8712-1900 local 1201 | 8743-7951
					</p>
					<p>Or send us a personal message here at NU Admissions Office-Manila\'s official Facebook Page account.</p>
					<p>
						Keep safe and we hope to see all of you here at NU!<br>
						#EducationThatWorks
					</p>',
					'source' => 'https://www.facebook.com/nuadmissionsmnl/posts/282474563481754',
					'created_at' => \Carbon\Carbon::parse('2021-04-28')
			]
		]);

		return $announcements;
	}

	public static function getFocus() {
		$focus = ResearchFocus::hydrate([
			(object)['id' => 1, 'name' => 'e-government & e-governance'],
			(object)['id' => 2, 'name' => 'disaster preparedness'],
			(object)['id' => 3, 'name' => 'android technology'],
			(object)['id' => 4, 'name' => 'data mining'],
			(object)['id' => 5, 'name' => 'artificial intelligence'],
			(object)['id' => 6, 'name' => 'e-learning'],
			(object)['id' => 7, 'name' => 'adaptive learning'],
			(object)['id' => 8, 'name' => 'emphatic coding'],
			(object)['id' => 9, 'name' => 'machine learning'],
			(object)['id' => 10, 'name' => 'readability assessment'],
			(object)['id' => 11, 'name' => 'ai for education'],
			(object)['id' => 12, 'name' => 'natural language processing'],
			(object)['id' => 13, 'name' => 'computational linguistics'],
			(object)['id' => 14, 'name' => 'computing technology'],
			(object)['id' => 15, 'name' => 'social computing'],
			(object)['id' => 16, 'name' => 'm-learning'],
			(object)['id' => 17, 'name' => 'mobile game continuance'],
			(object)['id' => 18, 'name' => 'is success theories'],
		]);

		return $focus;
	}

	public static function getUser($id=1) {
		$user = TmpController::getStaff()->get($id-1);
		return $user;
	}

	public static function getResearchList() {
		$research = Research::hydrate([
			(object) [
				'id' => 1,
				'title' => 'Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance',
				'url' => 'https://scholar.google.com/scholar?oi=bibs&cluster=13452525736665322785&btnI=1&hl=en',
				'date_published' => \Carbon\Carbon::parse('2020-8-15'),
				'authors' => 'Angelique D. Lacasandile, Mideth B. Abisado, Rogel M. Labanan, Lalaine P. Abad',
				'description' => 'The need to address societal issues of every community is a salient aspect that demands attention from the people in authority. These are important responsibilities of every barangay and its official in the Philippines. Profiling each household in the community using information and communication technology could achieve good governance through E-government as its core. Once profile data is aggregated, essential information could provide statistics in labor and employment, family income and expenditures, demography by (population) and (age), water and sanitation, type of housing and education. The focus is based on the profiling of Zone 42 and adding other facets as mentioned above was initiated, with the idea that educational institution around the barangay can help towards the areas included. This paper intends to aid barangay official in budget allocation and decision making in their respective governed …',
				'posted_by' => 1,
				'is_file' => 0,
				'date_added' => \Carbon\Carbon::parse('2021-5-4'),
				'is_viewable' => 0,
				'is_downloadable' => 0,
				'focus' => 1

			],
			(object) [
				'id' => 2,
				'title' => 'Barriers and challenges of computing students in an online learning environment: Insights from one private university in the Philippines',
				'url' => 'https://arxiv.org/abs/2012.02121',
				'date_published' => \Carbon\Carbon::parse('2020-11-20'),
				'authors' => 'Bernie S. Fabito, Arlene O. Trillanes, Jeshnile R. Sarmiento',
				'description' => 'While the literature presents various advantages of using blended learning, policymakers must identify the barriers and challenges faced by students that may cripple their online learning experience. Understanding these barriers can help academic institutions craft policies to advance and improve the students\' online learning experience. This study was conducted to determine the challenges of computing students in one private University in the Philippines during the period where the entire Luzon region was placed under the Enhanced Community Quarantine (ECQ) as a response to the COVID-19 pandemic. A survey through MS Forms Pro was performed to identify the experiences of students in online learning. The survey ran from March 16 to March 18, 2020, which yielded a total of 300 responses. Descriptive statistics revealed that the top three barriers and challenges encountered by students were 1. the difficulty of clarifying topics or discussions with the professors, 2. the lack of study or working area for doing online activities, and 3. the lack of a good Internet connection for participating in online activities. It can be concluded that both students and faculty members were not fully prepared to undergo full online learning. More so, some faculty members may have failed to adapt to the needs of the students in an online learning environment. While the primary data of the study mainly came from the students, it would also be an excellent addition to understand the perspective of the faculty members in terms of their experiences with their students. Their insights could help validate the responses in the survey and provide other barriers that may …',
				'posted_by' => 4,
				'is_file' => 0,
				'date_added' => \Carbon\Carbon::parse('2021-5-4'),
				'is_viewable' => 0,
				'is_downloadable' => 0,
				'focus' => 6
			],
			(object) [
				'id' => 3,
				'title' => 'Exploring Hybrid Linguistic Feature Sets to Measure Filipino Text Readability',
				'url' => 'https://ieeexplore.ieee.org/abstract/document/9310473',
				'date_published' => \Carbon\Carbon::parse('2020-12-4'),
				'authors' => 'Joseph Marvin Imperial, Ethel Ong',
				'description' => 'Proper identification of the difficulty level of materials prescribed as required readings in an educational setting is key towards effective learning in children. Educators and publishers have relied on readability formulas in predicting text readability. While these formulas abound in the English language, limited work has been done on automatic readability assessment for the Filipino language. In this study, we build upon the previous works using traditional (TRAD) and lexical (LEX) linguistic features by incorporating language model (LM) features for possible improvement in identifying readability levels of Filipino storybooks. Results showed that combining LM predictors to TRAD and LEX, forming a hybrid feature set, increased the performances of readability models trained using Logistic Regression and Support Vector Machines by up to ≈ 25% – 32%. From the results of performing feature selection using …',
				'posted_by' => 3,
				'is_file' => 0,
				'date_added' => \Carbon\Carbon::parse('2021-5-4'),
				'is_viewable' => 0,
				'is_downloadable' => 0,
				'focus' => 12
			],
			(object) [
				'id' => 4,
				'title' => 'Sample PDF Upload',
				'url' => 'sample_pdf.pdf',
				'date_published' => \Carbon\Carbon::parse('2021-5-4'),
				'authors' => 'これは例です。',
				'description' => 'A sample pdf upload for testing and presentation purposes.',
				'posted_by' => 1,
				'is_file' => 1,
				'date_added' => \Carbon\Carbon::parse('2021-5-4'),
				'is_viewable' => 1,
				'is_downloadable' => 1,
				'focus' => 6
			]
		]);

		return $research;
	}

	public static function getResearch($id) {
		$research = TmpController::getResearchList()->get($id-1);

		return $research;
	}
}