<?php namespace urialc\Http\Controllers;

use urialc\Banner as Banner;
use urialc\Article as Article;
use urialc\Language as Language;
use urialc\Category as Category;


use Libraries\LangController as LangController;
use Libraries\ProjectController as ProjectController;
use Libraries\YoutubeVideos as YoutubeVideos;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller {
	public function __construct()
	{
		$this->middleware('changeLang');
	}
	public function getIndex()
	{
		$project = new ProjectController;
		$lang 		= LangController::getActiveLang(); 
		$news_order = ['two-third','one-third','one-third','two-third'];

		 /* configuracion */
	    $key = 'AIzaSyB5mrymfvtiUlgIJAAg-9QhZVhg668erIU';
	    $channelId = 'UCGLib-7ScPCZl3iD5vyyMhg';

	    $videos = new YoutubeVideos;
	    $videos = $videos->getChannelVideos($key,$channelId );

		$lang 	  	= LangController::getActiveLang();
		$title 	  	= trans('lang.index_title')." | Uri america latina y el caribe";
		//gettin cats
		$news_cat = Category::whereHas('slugs',function($slugs){
			$slugs->where('text','LIKE','%noticias%');
		})
		->first();
		$circles_cat = Category::whereHas('slugs',function($slugs){
			$slugs->where('text','LIKE','%circulos-de-cooperación%');
		})
		->first();
		$banners  = Banner::where('lang_id','=',$lang->id)->get();

		//getting those who are news
		$news    = Article::with(['titles' => function($titles) use($lang){
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
		->where('cat_id','=',$news_cat->id)
		->take(4)
		->get();

		//getting those who are circles
		$circles = Article::with(['titles' => function($titles) use($lang){
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
		->where('cat_id','=',$circles_cat->id)
		->take(3)
		->get();
		return view('home.index')
		->with('title',$title)
		->with('lang',$lang)
		->with('project',$project)
		->with('news_order',$news_order)
		->with('banners',$banners)
		->with('news',$news)
		->with('circles',$circles)
		->with('videos',$videos);
	}

	public function getWhatsUri()
	{
		$lang 		= LangController::getActiveLang(); 

		$title = trans('lang.whatsuri_title')." | urialc";
		$project = new ProjectController;

		return view('home.about.whats')
		->with('title',$title)
		->with('lang',$lang)
		->with('project',$project);
	}
	public function getContact()
	{
		$title = trans('lang.menu_btn7').' | urialc';
		$lang 		= LangController::getActiveLang(); 

		$project = new ProjectController;

		return view('home.contact')
		->with('lang',$lang)
		->with('project',$project)
		->with('title',$title);
	}
	public function getFestival()
	{
		$title = trans('lang.menu_btn7').' | urialc';
		$lang 		= LangController::getActiveLang(); 

		$project = new ProjectController;

		return view('home.festival')
		->with('lang',$lang)
		->with('project',$project)
		->with('title',$title);
	}
}
