<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
	protected $fillable = [
		'topic_name',
	];

	public $timestamps = false;

	protected function materials() {
		return $this->hasMany('App\Material');
	}

	public function getFirstDateAdded($getSortedCollection = false) {
		$materials = $this->materials->sortByDesc('created_at');
		return $getSortedCollection ? $materials : \Carbon\Carbon::parse($materials[0]->created_at)->format('M d, Y');
	}

	public function getLatestDateUpdate($getSortedCollection = false) {
		$materials = $this->materials->sortByDesc('updated_at');
		return $getSortedCollection ? $materials : \Carbon\Carbon::parse($materials[0]->updated_at)->format('M d, Y');
	}
}