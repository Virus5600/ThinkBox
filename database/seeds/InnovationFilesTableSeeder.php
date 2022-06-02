<?php

use Illuminate\Database\Seeder;

use App\InnovationFile as IFI;

class InnovationFilesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		IFI::insert([
			'innovation_id' => 4,
			'original_name' => 'sample_pdf.pdf',
			'file' => 'sample_pdf.pdf'
		]);
	}
}