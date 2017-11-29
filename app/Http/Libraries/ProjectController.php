<?php
	namespace Libraries;

	use urialc\Category as Category;

	use \stdClass;
	use Libraries\LangController as LangController;

	Class ProjectController
	{
		function __construct() {

		}
		public static function getMenuLinks()
		{
			$lang 	  	= LangController::getActiveLang();
			return Category::with(['slugs' => function($slugs) use ($lang){
				$slugs->where('lang_id','=',$lang->id);
			}])
			->with(['names' => function($names) use ($lang){
				$names->where('lang_id','=',$lang->id);
			}])
			->with(['subcats' => function($subcats) use ($lang){
				$subcats->with('names')
				->where('in_menu','=',1);
			}])
			->where(function($query) use ($lang){
				$query->whereHas('names',function($names) use($lang){
					$names->where('lang_id','=',$lang->id);
				});
			})
			->where('in_menu','=',1)
			->orderBy('id','ASC')
			->get();
		}
		public static function getPaginateData($collection)
		{
			$pagination = new StdClass;

			$pagination->beforeAndAfter = 3;
			//Página actual
			$pagination->currentPage = $collection->currentPage();
			$pagination->previousUrl = $collection->url($pagination->currentPage-1);
			$pagination->nextsUrl 	 = $collection->url($pagination->currentPage+1);
			//Última página
			$pagination->lastPage 	= $collection->lastPage();
			$pagination->lastUrl 	= $collection->url($pagination->lastPage);

			//Comprobamos si las páginas anteriores y siguientes de la actual existen
			$pagination->start 		= $pagination->currentPage - $pagination->beforeAndAfter;
			$pagination->startUrl 	= $collection->url(1);
				
		  	//Comprueba si la primera página en la paginación está por debajo de 1
		  	//para saber como colocar los enlaces
			if($pagination->start < 1)
			{
				$pos = $pagination->start - 1;
				$pagination->start = $pagination->currentPage - ($pagination->beforeAndAfter + $pos);
			}
			//Último enlace a mostrar
			$pagination->end = $pagination->currentPage + $pagination->beforeAndAfter;

			if($pagination->end > $pagination->lastPage)
			{
				$pos = $pagination->end - $pagination->lastPage;
				$pagination->end = $pagination->end - $pos;
			}

		   $pagination->pages = [];
			//Rango de enlaces desde el principio al final, 3 delante y 3 detrás
			for($i = $pagination->start; $i<=$pagination->end;$i++)
			{
				$pagination->pages[$i] = new StdClass;
				if ($pagination->currentPage == $i) {
					$pagination->pages[$i]->link  = "#!";
					$pagination->pages[$i]->class = "active";
					$pagination->pages[$i]->html  = $i;
				}else
				{
					$pagination->pages[$i]->link  = $collection->url($i);
					$pagination->pages[$i]->class = "";
					$pagination->pages[$i]->html  = $i;
				}
			}
			
			return $pagination;
		}
	}