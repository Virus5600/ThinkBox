<?php

use Illuminate\Database\Seeder;

use App\Material as M;

class MaterialsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		M::create([
			'topic_id' => 1,
			'faculty_staff_id' => 2,
			'material_name' => 'Logo Documentation',
			'description' => 'In this course material, I will be discussing on how to create a documentation for a logo or brand. This material would include the important information that should be in the documentation, formatting the document and detailed user instruction.',
		]);

		M::create([
			'topic_id' => 2,
			'faculty_staff_id' => 2,
			'material_name' => 'Basics of MS Powerpoint',
			'description' => 'PowerPoint presentations work like slide shows. To convey a message or a story, you break it down into slides. Think of each slide as a blank canvas for the pictures and words that help you tell your story. In this course material, I would be teaching you on how to',
		]);

        M::create([
            'topic_id' => 3,
            'faculty_staff_id' => 2,
            'material_name' => 'Getting started with GitLab',
            'description' => 'In this course material, I will be discussing on how to get started with GitLab to practice version control on all programming related projects. This course materials includes introduction to GitLab, setting up, creating a repository, etc.',
        ]);

        M::create([
            'topic_id' => 3,
            'faculty_staff_id' => 2,
            'material_name' => 'Object-Oriented Programming',
            'description' => 'In this course material, I would be teaching object-oriented programming. It is used to structure a software program into simple, reusable pieces of code blueprints (usually called classes), which are used to create individual instances of objects',
        ]);

        M::create([
            'topic_id' => 4,
            'faculty_staff_id' => 2,
            'material_name' => 'Developers Timeline',
            'description' => 'In this course material, I will be discussing on how to create a developer\'s timeline to track project timeline using Microsoft Excel. This material includes formatting of document and creating a Gantt chart. This material would ensure to increase productivity.',
        ]);
	}
}
