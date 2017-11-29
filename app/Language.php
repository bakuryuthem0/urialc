<?php namespace urialc;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

	//
	public function names()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','name');
	}
}
