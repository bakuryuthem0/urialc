<?php namespace urialc;

use Libraries\LangController as LangController;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	//
	public function slugs()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','slug');
	}
	public function titles()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','title');
	}
	public function descriptions()
	{
		return $this->hasMany('urialc\TranslationEntry','translation_id','description');
	}
	public function images()
	{
		return $this->hasMany('urialc\ArticleFile','article_id')
		->where('slug','=','image');
	}
	public function documents()
	{
		return $this->hasMany('urialc\ArticleFile','article_id')
		->where('slug','=','document');
	}
	public function fillData($data, $langs)
	{
		$langCtrl = new LangController;
		$translation      = $langCtrl::newTranslation();
		$langCtrl::newEntry($langs, $translation, $data, 'title');
		$this->title       = $translation;

		$translation      = $langCtrl::newTranslation();
		$langCtrl::newSlug($langs, $translation, $data, 'title');
		$this->slug       = $translation;

		$translation      = $langCtrl::newTranslation();
		$langCtrl::newEntry($langs, $translation, $data, 'desc');
		$this->description       = $translation;

		$this->cat_id = $data['cat'];
		
		if (isset($data['subcat'])) {
			$this->subcat_id = $data['subcat'];		
		}
		if (isset($data['date'])) {
			$this->date = $data['date'];
		}
	}
}
