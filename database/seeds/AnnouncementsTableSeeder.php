<?php

use Illuminate\Database\Seeder;

use App\Announcements as A;
class AnnouncementsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		A::create([
			'id' => 1,
			'image' => 'announcement1.jpg',
			'title' => 'Payment Options',
			'source' => 'https://www.national-u.edu.ph/payment-options/',
			'content' => '
				<p>Good news, Nationalians!</p>
				<p>Now you can pay your tuition, miscellaneous, and other school fees via our nominated payment channels and centers nationwide.</p>
				<p>You may process your payment via credit card, online banking, 7-Eleven, Cebuana, SM Bills payment and many more.</p>',
			'author_id' => null,
			'created_at' => \Carbon\Carbon::parse('2021-03-18')
		]);

		A::create([
			'id' => 2,
			'image' => 'announcement2.jpg',
			'title' => 'BDO EasyPay Cash Tuition Program',
			'source' => 'https://www.national-u.edu.ph/payment-options',
			'content' => '<p>EASYPAY-CASH-TUITION-PROMO-MECHANICS-v121620</p>',
			'author_id' => null,
			'created_at' => \Carbon\Carbon::parse('2021-02-15')
		]);

		A::create([
			'id' => 3,
			'image' => 'announcement3.jpg',
			'title' => 'NU Manila’s COE hosts REFOREST 2020: For Vivid Solutions',
			'source' => 'https://www.national-u.edu.ph/payment-options/',
			'content' => '
				<p>The National University Manila’s College of Engineering along with PICE and PSSE student chapters of NU successfully hosted the virtual REFOREST 2020: For Vivid Solutions, last January 29 with 1500 global crowd in attendance.</p>
				<p>Research Forum and Exhibition on Environmental Sustainability and Technologies (REFOREST) aims to produce solutions that will address relevant environmental crises both for present and in the future.</p>
				<p>Reputable plenary speakers, forum discussants and presenters were present to share their knowledge and experience in the significance of wise environmental decision-making in a well-functioning ecosystem.</p>
				<p>To top off the event, National-U’s Electronics and Communications Engineering alumnus, Jayvee Boy H. Agustin, was awarded the Best Paper Presenter for the topic: “Development of Subsystems for a Web-based Survey Tool Using Automatic Speech and Optical Character Recognition with Geotagging Features.”</p>
				<p>With the mission to combat emerging natural and environmental conflicts, REFOREST 2020 will indeed help us attain a sustainable environment.</p>',
			'author_id' => null,
			'created_at' => \Carbon\Carbon::parse('2021-01-31')
		]);

		A::create([
			'id' => 4,
			'image' => 'announcement4.jpg',
			'title' => 'Enrollment for 1st Term AY 2021-2022 is ongoing.',
			'source' => 'https://www.facebook.com/nuadmissionsmnl/posts/282474563481754',
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
			'author_id' => null,
			'created_at' => \Carbon\Carbon::parse('2021-04-28')
		]);
	}
}