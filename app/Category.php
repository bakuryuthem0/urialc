<?php namespace urialc;

use Libraries\LangController as LangController;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	//
	public function slugs()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','slug');
	}
	public function names()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','name');
	}
	public function subcats()
	{
		return $this->hasMany('urialc\SubCategory','cat_id');
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
