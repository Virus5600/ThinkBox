<?php

use Illuminate\Database\Seeder;

use App\ResearchFile as RF;

class ResearchFilesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		RF::create([
			'research_id' => 4,
			'original_name' => 'sample_pdf.pdf',
			'file' => 'sample_pdf.pdf'
		]);

		RF::create([
			'research_id' => 5,
			'original_name' => 'Development-of-Load-Moment-Control-and-Monitoring-System_Dimaculangan_IEEE-1.pdf',
			'file' => 'Development-of-Load-Moment-Control-and-Monitoring-System_Dimaculangan_IEEE-1.pdf'
		]);
	}
}