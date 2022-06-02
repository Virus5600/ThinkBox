<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use App\User;

class RemoveExpiredUser extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'remove_expired_user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Removes temporary users that has expired.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
    	User::where('expiration_date', '>=', \Carbon\Carbon::now())->get()->delete();
	}
}
