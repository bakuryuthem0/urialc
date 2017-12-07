<?php namespace urialc;

use Illuminate\Database\Eloquent\Model;

class DonationBanner extends Model {
	public function titles()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','title');
	}
}