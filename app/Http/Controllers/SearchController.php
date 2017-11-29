<?php namespace urialc\Http\Controllers;

use urialc\Article as Article;
use urialc\Language as Language;
use urialc\Category as Category;


use Libraries\LangController as LangController;
use Libraries\ProjectController as ProjectController;

use Illuminate\Http\Request;

class SearchController extends Controller {
	public function __construct()
	{
		$this->middleware('changeLang');
	}
	public function getSearch($type, $opt = null)
	{
		$project = new ProjectController;
		$lang = LangController::getActiveLang();

		$cat = Category::with(['names' => function($names) use ($lang)
		{
			$names->where('lang_id','=',$lang->id);
		}])
		->with(['subcats' => function($subcats) use ($lang)
		{
			$subcats->with(['names' => function($names) use ($lang)
			{
				$names->where('lang_id','=',$lang->id);
			}])
			->with(['slugs' => function($slugs) use ($lang)
			{
				$slugs->where('lang_id','=',$lang->id);
			}]);
		}])
		->with(['slugs' => function($slugs) use ($lang)
		{
			$slugs->where('lang_id','=',$lang->id);
		}])
		->whereHas('slugs',function($slugs) use ($type){
			$slugs->where('text','LIKE','%'.$type.'%');
		})

		->first();
		
		$articles = Article::with(['titles' => function($titles) use($lang){
			$titles->where('lang_id','=',$lang->id);
		}])
		->with(['descriptions' => function($descriptions) use($lang){
			$descriptions->where('lang_id','=',$lang->id);
		}])
		->with(['slugs' => function($slugs) use($lang){
			$slugs->where('lang_id','=',$lang->id);
		}])
		->with('images')
		->whereHas('titles',function($titles) use ($lang){
			$titles->where('lang_id','=',$lang->id);
		})
		->where('cat_id','=',$cat->id)
		->paginate(10);

		$pagination = $project::getPaginateData($articles);

		$title = $cat->names->first()->text.' | urialc';

		return view('search.search')
		->with('title',$title)
		->with('project',$project)
		->with('cat',$cat)
		->with('lang',$lang)
		->with('articles',$articles)
		->with('pagination',$pagination);
	}
	public function getSelf($slug, Request $request)
	{
		$project = new ProjectController;
		$lang = LangController::getActiveLang();
		$article = Article::with(['titles' => function($titles) use($lang){
			$titles->where('lang_id','=',$lang->id);
		}])
		->with(['descriptions' => function($descriptions) use($lang){
			$descriptions->where('lang_id','=',$lang->id);
		}])
		->with(['slugs' => function($slugs) use($lang){
			$slugs->where('lang_id','=',$lang->id);
		}])
		->with('images')
		->with('documents')
		->whereHas('slugs',function($slugs) use ($slug) {
			$slugs->where('text','=',$slug);
		})
		->first();

		$title = $article->titles->first()->text.' | urialc';
		$cat = Category::with(['names' => function($names) use ($lang){
			$names->where('lang_id','=',$lang->id);
		}])
		->with('slugs')
		->find($article->cat_id);
		switch ($cat->slugs->first()->text) {
		 	case 'noticias':
				$view = view('search.noticias');
		 		break;
		 	case 'circulos-de-cooperación-1510258835':
				$view = view('search.circulos');
		 		break;
		 	default:
				$view = view('search.noticias');
		 		break;
		 }
		return $view
		->with('self','self')
		->with('request',$request)
		->with('title',$title)
		->with('lang',$lang)
		->with('article',$article)
		->with('project',$project);
	}
}