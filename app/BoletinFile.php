<?php namespace urialc;

use Illuminate\Database\Eloquent\Model;


class BoletinFile extends Model {
	
	public function langs()
	{
		return $this->belongsTo('urialc\Language','lang_id');
	}
	public function boletin()
	{
		return $this->belongsTo('urialc\Boletin','boletin_id');
	}
}