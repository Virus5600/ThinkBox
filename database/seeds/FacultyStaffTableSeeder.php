<?php

use Illuminate\Database\Seeder;

use App\FacultyStaff as FS;

class FacultyStaffTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		FS::create([
			'id' => 1,
			'user_id' => 1,
			'department' => 1,
			'position' => 4,
			'location' => 'National University',
			'description' => 'Dr. Angelique D. Lacasandile is the Department Chair of the Computer Science Department at National University, Manila. She is also the Academe and Industry Linkage Coordinator, and a recipient of CHED Scholarship for Graduate Studies that enjoys full-privileges to earn doctorate degree. She graduated at Technological Institute of the Philippines – Manila with a degree of Doctor in Information Technology (DIT), her current research papers and system developed focused on the projects about the government.'
		]);

		FS::create([
			'id' => 2,
			'user_id' => 2,
			'department' => 1,
			'position' => 5,
			'location' => 'National University',
			'description' => null
		]);

		FS::create([
			'id' => 3,
			'user_id' => 3,
			'department' => 1,
			'position' => 5,
			'location' => 'National University',
			'description' => 'A graduate student at De La Salle University under the MS Computer Science program. I am also a full-time faculty member of the Computer Science Department at National University-Manila. My research works are focused on applying Natural Language Processing (NLP) on Philippine languages using Machine Learning and Deep Learning methods.',
		]);

		FS::create([
			'id' => 4,
			'user_id' => 4,
			'department' => 1,
			'position' => 3,
			'location' => 'National University',
			'description' => 'Dr. Arlene Trillanes is the Dean of the College of Computing and Information Technologies at National University, Manila.',
		]);

		FS::create([
			'id' => 5,
			'user_id' => 5,
			'department' => 1,
			'position' => 5,
			'location' => 'National University',
			'description' => 'Susan S. Caluya is a holder of a degree in Master of Science in Computer Science from AMA Computer College, Makati City. She earned her Bachelor of Science in Computer Science from Eulogio Amang Rodriguez Institute of Technology. Currently, she is the Chair of the Information Technology department of TIP Manila.',
		]);

		FS::create([
			'id' => 6,
			'user_id' => 6,
			'department' => 2,
			'position' => 5,
			'location' => 'National University',
			'description' => 'With a decade of strong years of experience in the academe, I had the opportunity to excel in teaching, research and extension which paved the way for my three Faculty Excellence Awards (2015, 2017, 2018) and six Faculty Research Awards from 2015 to 2020 all obtained from National University-Manila.',
				//My experience includes serving as a faculty member dedicated to providing quality outcome-based education, a University Research Coordinator (2020) under the NU Center for Entrepreneurship, an OIC program chair for BSCS (2017), Student Council Adviser (2019), College Research Coordinator (2016 - 2019) , Computing Research Center Coordinator (2017, 2020) under the College of Computing and Information Technologies, Conference Chair and Conference-Vice Chair for the Inter-School Computing Research Conference 2018 and 2019 respectively, a peer-reviewer for the ff: CHED accredited journal (Recoletos Multidisciplinary Research Journal), international conferences, (http://www.icset.org/com.html, http://www.fcce.org/, http://www.iccc.org/committee.html), and national conferences (PSITE-NCR-IRC, PCSC). I am currently an associate member of the National Research Center of the Philippines (NRCP).
				//I have had the opportunity to publish, and present research papers both in national and international venues like Taiwan, Malaysia, USA (recipient of the ACM SIGMIS paper presentation scholarship), Japan, South Korea (won the best paper for IEEE TENCON 2018 - 1st author), Indonesia, Singapore, and Macau all of which were indexed in Scopus. My research interests fall under the Social and Mobile Computing and Human-Computer Interaction (HCI).
				//Presently, I serve as Program Chair of the Graduate Programs of NU-CCIT. I hold a Bachelor’s Degree in Information Technology, MS in Information Technology (MSIT) from the Polytechnic University of the Philippines, and currently pursuing my dissertation for the Doctor in Information Technology degree program of De La Salle University.',
		]);

		FS::create([
			'id' => 7,
			'user_id' => 7,
			'department' => 2,
			'position' => 4,
			'location' => 'National University',
			'description' => null
			// 'description' => 'Driven with passion and concrete objectives to meet a high quality and technologically in-lined actions for short and long term goals.',
		]);

		FS::create([
			'id' => 8,
			'user_id' => 8,
			'department' => 1,
			'position' => 5,
			'location' => 'National University',
			'description' => null
		]);

		FS::create([
			'id' => 9,
			'user_id' => 9,
			'department' => 3,
			'position' => 2,
			'location' => 'National University',
			'description' => 'Dr. Ria Liza C. Canlas is an engineer, technologist and Intellectual Property expert. She obtained her degrees in Bachelor of Science in Civil Engineering at the Mapua Institute of Technology, Master of Engineering Management major in Construction Management at the Pamantasan ng Lungsod ng Maynila, and Doctor of Technology at the Technological University of the Philippines. She had researches published and several completed studies, as project leader, including Grant-in-aid studies funded by the Commission on Higher Education (CHED), Department of Science and Technology (DOST), and various institutional research projects. Her expertise is in research, project management, engineering and technology, and intellectual property. Presently, she is one of the Consultants at Strategic Research and Development, Inc (STRAND, Inc) and the Principal at Po-lite Technology Incorporated, RPM Business Solutions and CACTech Construction. Futhermore, she is into innovations through engagement in various experimental researches, mentoring and Intellectual Property concept trainings. She is a licensed Civil Engineer, Certified Materials Engineer 1 and Registered Patent Agent. She is presently the Assistant Research Director at National University. Also connected as independent Patent Consultant and Technical Expert of Intellectual Property Office of the University of the Philippines, Diliman. She has ongoing inventions under different stages (for development, for patent drafting, and filed).'
		]);

		FS::create([
			'id' => 10,
			'user_id' => 10,
			'department' => 3,
			'position' => 5,
			'location' => 'National University',
			'description' => 'Experienced Technical Consultant with a demonstrated history of working in the education management industry. Skilled in Management, Training, Instrumentation, Leadership, and Programmable Logic Controller (PLC). Strong sales professional with a Masters of Engineering focused in Electrical and Electronics Engineering from Technological University of the Philippines.'
		]);

		// DEV ACCOUNT FOR LOCAL TESTING
		if (env('APP_ENV') == 'local') {
			FS::create([
				'user_id' => 0,
				'department' => 1,
				'position' => 4,
				'location' => 'National University',
				'description' => 'ADMIN ACCOUNT'
			]);
		}
	}
}