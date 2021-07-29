<?php

use Illuminate\Database\Seeder;

use App\Innovation as I;

class InnovationTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->addInnovation(
			'Development of an Information-Based Dashboard: Automation of Barangay Information Profiling System (BIPS) for Decision Support towards e-Governance',
			array('Lalaine P. Abad'),
			'The need to address societal issues of every community is a salient aspect that demands attention from the people in authority. These are important responsibilities of every barangay and its official in the Philippines. Profiling each household in the community using information and communication technology could achieve good governance through E-government as its core. Once profile data is aggregated, essential information could provide statistics in labor and employment, family income and expenditures, demography by (population) and (age), water and sanitation, type of housing and education. The focus is based on the profiling of Zone 42 and adding other facets as mentioned above was initiated, with the idea that educational institution around the barangay can help towards the areas included. This paper intends to aid barangay official in budget allocation and decision making in their respective governed …',
			1,
			'https://scholar.google.com/scholar?oi=bibs&cluster=13452525736665322785&btnI=1&hl=en',
			\Carbon\Carbon::parse('2020-8-15'),
			1,
			1
		);

		$this->addInnovation(
			'Barriers and challenges of computing students in an online learning environment: Insights from one private university in the Philippines',
			array('Jeshnile R. Sarmiento'),
			'While the literature presents various advantages of using blended learning, policymakers must identify the barriers and challenges faced by students that may cripple their online learning experience. Understanding these barriers can help academic institutions craft policies to advance and improve the students\' online learning experience. This study was conducted to determine the challenges of computing students in one private University in the Philippines during the period where the entire Luzon region was placed under the Enhanced Community Quarantine (ECQ) as a response to the COVID-19 pandemic. A survey through MS Forms Pro was performed to identify the experiences of students in online learning. The survey ran from March 16 to March 18, 2020, which yielded a total of 300 responses. Descriptive statistics revealed that the top three barriers and challenges encountered by students were 1. the difficulty of clarifying topics or discussions with the professors, 2. the lack of study or working area for doing online activities, and 3. the lack of a good Internet connection for participating in online activities. It can be concluded that both students and faculty members were not fully prepared to undergo full online learning. More so, some faculty members may have failed to adapt to the needs of the students in an online learning environment. While the primary data of the study mainly came from the students, it would also be an excellent addition to understand the perspective of the faculty members in terms of their experiences with their students. Their insights could help validate the responses in the survey and provide other barriers that may …',
			4,
			'https://arxiv.org/abs/2012.02121',
			\Carbon\Carbon::parse('2020-11-20'),
			1,
			1
		);

		$this->addInnovation(
			'Exploring Hybrid Linguistic Feature Sets to Measure Filipino Text Readability',
			array('Ethel Ong'),
			'Proper identification of the difficulty level of materials prescribed as required readings in an educational setting is key towards effective learning in children. Educators and publishers have relied on readability formulas in predicting text readability. While these formulas abound in the English language, limited work has been done on automatic readability assessment for the Filipino language. In this study, we build upon the previous works using traditional (TRAD) and lexical (LEX) linguistic features by incorporating language model (LM) features for possible improvement in identifying readability levels of Filipino storybooks. Results showed that combining LM predictors to TRAD and LEX, forming a hybrid feature set, increased the performances of readability models trained using Logistic Regression and Support Vector Machines by up to ≈ 25% – 32%. From the results of performing feature selection using …',
			3,
			'https://ieeexplore.ieee.org/abstract/document/9310473',
			\Carbon\Carbon::parse('2020-12-4'),
			1
		);

		$this->addInnovation(
			'Sample PDF Upload',
			'これは例です。',
			'A sample pdf upload for testing and presentation purposes.',
			1,
			null,
			\Carbon\Carbon::parse('2021-5-4'),
			1,
			1
		);

		$this->addInnovation(
			'SYSTEM AND METHODS FOR INTEGRATED TRACKING OF PUBLIC TRANSIT VEHICLES AND REAL-TIME TRAFFIC CONGESTION',
			'Leonila B. Valdez',
			'The object of the present invention is to provide consolidated mobile/web applications for train passengers in order to aid them in finding the best route to their destinations and their connectivity like alternative mode of transportation per stations for train administrators to manage passenger congestion. Furthermore, the present invention enables the train passengers to view the following integrated information from trains: (a) fare matrix, (b) time matrix, (c) data analytics of passenger congestion, (d) video streaming per stations, (e) incident alerts, and (f) PWD assistance and other services and announcements from commuters and train management.',
			9,
			'http://121.58.254.45/PatGazette/IPASJournal/V24N4_Inv_1st.pdf',
			\Carbon\Carbon::parse('2019-3-6'),
			1,
		);

		// $this->addInnovation();
	}

	/**
	 * Adds a new entry to innovation table. The $authors allows an array of authors or plain string value.
	 * @param $title The title of the Innovation.
	 * @param $authors A variable that can either be a string variable or an string array variable. Plugging an array let's the function add multiple authors to a innovation in a single go.
	 * @param $desc The abstract or description of the innovation.
	 * @param $posted_by The faculty_staff ID of who posted this. Uses the id of that faculty_staff.
	 * @param $url Represents the innovation link.
	 * @param $date_published Uses the \Carbon\Carbon to define a date. The date provided to this parameter defines when the innovation was provided.
	 * @param $is_file_requestable An optional boolean parameter. Determines if the innovation paper can be requested from the authors. By default, its value is set to 0, which means that a request button won't be available.
	 * @param $is_featured An optional boolean parameter. Determines if the innovation is featured. Allowing so allows the non-authenticated users to see the innovation as well. By default, its value is set to 0, which means it is not viewable publicly.
	 */
	private function addInnovation($title, $authors, $desc, $posted_by, $url, $date_published, $is_file_requestable=0, $is_featured=0) {
		if ($is_file_requestable)
			$is_file_requestable = 1;
		else if (!$is_file_requestable)
			$is_file_requestable = 0;

		if ($is_featured)
			$is_featured = 1;
		else if (!$is_featured)
			$is_featured = 0;

		$this->addInnovationWithID($title, $authors, $desc, $posted_by, $url, $date_published, $is_file_requestable, $is_featured);
	}

	/**
	 * Adds a new entry to innovation table. The $authors allows an array of authors or plain string value.
	 * @param $title The title of the Innovation.
	 * @param $authors A variable that can either be a string variable or an string array variable. Plugging an array let's the function add multiple authors to a innovation in a single go.
	 * @param $desc The abstract or description of the innovation.
	 * @param $posted_by The faculty_staff ID of who posted this. Uses the id of that faculty_staff.
	 * @param $url Represents the innovation link.
	 * @param $date_published Uses the \Carbon\Carbon to define a date. The date provided to this parameter defines when the innovation was provided.
	 * @param $is_file_requestable An optional boolean parameter. Determines if the innovation paper can be requested from the authors. By default, its value is set to 0, which means that a request button won't be available.
	 * @param $is_featured An optional boolean parameter. Determines if the innovation is featured. Allowing so allows the non-authenticated users to see the innovation as well. By default, its value is set to 0, which means it is not viewable publicly.
	 * @param $id Another optional parameter. The $id parameter defines what fixed ID the innovation will use. This can be left out and let the auto increment do its work, as by default, the value is set to null.
	 */
	private function addInnovationWithID($title, $authors, $desc, $posted_by, $url, $date_published, $is_file_requestable=0, $is_featured=0, $id=null) {
		if ($is_file_requestable)
			$is_file_requestable = 1;
		else if (!$is_file_requestable)
			$is_file_requestable = 0;

		if ($is_featured)
			$is_featured = 1;
		else if (!$is_featured)
			$is_featured = 0;

		if (is_array($authors))
			$authors = implode(',', $authors);

		if ($id == null) {
			I::create([
				'title' => $title,
				'authors' => $authors,
				'description' => $desc,
				'posted_by' => $posted_by,
				'url' => $url,
				'date_published' => $date_published,
				'is_file_requestable' => $is_file_requestable,
				'is_featured' => $is_featured
			]);
		}
		else {
			I::create([
				'id' => $id,
				'title' => $title,
				'authors' => $authors,
				'description' => $desc,
				'posted_by' => $posted_by,
				'url' => $url,
				'date_published' => $date_published,
				'is_file_requestable' => $is_file_requestable,
				'is_featured' => $is_featured
			]);
		}
	}
}