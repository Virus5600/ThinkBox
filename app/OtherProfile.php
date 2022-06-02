<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherProfile extends Model
{
	protected $fillable = [
		'user_id',
		'website',
		'url'
	];

	public $timestamps = false;

	protected function user() {
		return $this->belongsTo('App\User');
	}

	protected function website() {
		return $this->belongsTo('App\Website');
	}

	public function getWebsites() {
		$type = DB::select(DB::raw('SHOW COLUMNS FROM pages WHERE Field = "website"'))[0]->Type;
		preg_match('/^enum\((.*)\)$/', $type, $matches);
		$values = array();
		foreach(explode(',', $matches[1]) as $value){
			$values[] = trim($value, "'");
		}
		return $values;
	}
}