<?php
	namespace Libraries;
	
	use urialc\Language as Language;
	use urialc\Translation as Translation;
	use urialc\TranslationEntry as TranslationEntry;

	Class LangController{
		public static function getLangs()
		{
			return Language::with('names')->get();
		}
		public static function getActiveLang()
		{
			return Language::with('names')->where('code','=',app()->getLocale())->first();
		}
		public static function getDefaultLang()
		{
			return Language::where('is_default','=',1)->first()->code;
		}
		public static function newTranslation()
		{
			$translation = new Translation;
			$translation->save();
			return $translation->id;	
		}
		public static function newEntry($langs, $translation,$data, $field)
		{
			foreach ($langs as $l) {
				$entry = new TranslationEntry;
				$entry->translation_id = $translation;
				$entry->lang_id 	   = $l->id;
				$entry->text           = $data[$field][$l->id];
				$entry->save();	
			}
		}
		public static function newSlug($langs, $translation, $data, $field)
		{
			foreach ($data[$field] as $key => $val) {
				$slugs[$field][$key] = str_replace(' ','-',strtolower($val)).'-'.time();
			}
			LangController::newEntry($langs, $translation,$slugs, $field);
		}
		public static function mdfEntry($langs, $data, $field)
		{
			foreach ($data[$field] as $key => $data_val) {
				$entry = TranslationEntry::find($key);
				$entry->text = $data_val;
				$entry->save();
			}
		}
		public static function mdfSlug($langs, $data, $field, $table)
		{
			$slugs      = array();
			foreach($data[$field] as $key => $t)
			{
				$entry 			= TranslationEntry::find($key);
				$table_slugs 	= TranslationEntry::where('translation_id','=',$table->slug)->get();
				foreach ($table_slugs as $s) {
					if ($entry->lang_id == $s->lang_id) {
						$slugs[$field][$s->id] = str_replace(' ','-',strtolower($t));
					}
				}
			}
			LangController::mdfEntry($langs, $slugs, $field);
		}
		public static function deleteEntry($translation_id)
		{
			Translation::find($translation_id)->delete();
			TranslationEntry::where('translation_id','=',$translation_id)->delete();
		}
	}
?>