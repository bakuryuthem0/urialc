<?php namespace urialc;
use Libraries\LangController as LangController;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model {
	public function category()
	{
		return $this->belongsTo('urialc\Category','cat_id');
	}
	public function slugs()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','slug');
	}
	public function names()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','name');
	}
	public function fillData($data, $langs)
	{
		$langCtrl = new LangController;
		$translation      = $langCtrl::newTranslation();
		$langCtrl::newEntry($langs, $translation, $data, 'name');
		$this->name       = $translation;

		$translation      = $langCtrl::newTranslation();
		$langCtrl::newSlug($langs, $translation, $data, 'name');
		$this->slug       = $translation;

		if (isset($data['active'])) {
			$this->in_menu = 1;
		}else
		{
			$this->in_menu = 0;
		}
	}
}