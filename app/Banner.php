<?php namespace urialc;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {
	public function langs()
	{
		return $this->belongsTo('urialc\Language','lang_id');
	}
}