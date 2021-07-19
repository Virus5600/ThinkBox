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
	}
}