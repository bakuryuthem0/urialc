<?php namespace urialc;
use Illuminate\Database\Eloquent\Model;

class Boletin extends Model {
	public function titles()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','title');
	}
	public function files()
	{
		return $this->hasMany('urialc\BoletinFile','boletin_id');
	}
}