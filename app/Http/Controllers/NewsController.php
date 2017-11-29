<?php namespace urialc\Http\Controllers;

use urialc\Article as Article;
use urialc\ArticleFile as ArticleFile;
use urialc\Language as Language;
use urialc\Category as Category;
use urialc\SubCategory as SubCategory;
use urialc\Translation as Translation;
use urialc\TranslationEntry as TranslationEntry;

use Libraries\LangController as LangController;
use Libraries\FileController as FileController;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use Illuminate\Filesystem\Filesystem as File;

class NewsController extends Controller {

	public function getNewArticle()
	{
		$cats  = Category::with('names')->get();
		$langs = Language::with('names')->get();
		$title = "Nuevo articulo | Urialc";
		return view('admin.articles.new')
		->with('langs',$langs)
		->with('cats',$cats)
		->with('title',$title);	
	}
	public function postNewArticle(Request $request)
	{
		$langs = Language::with('names')->get();

		$data = $request->all();
		$rules = [
			'title'	=> 'required|min:1',
			'desc'	=> 'required|min:1',
			'date'	=> 'sometimes|date',
			'cat'	=> 'required|exists:categories,id',
		];
		$msg   = [];
		$attr  = [
			'title' => 'idiomas',
			'desc' 	=> 'idiomas',
			'cat'	=> 'categoría',
		];

		foreach ($langs as $l) {
			$rules['title.'.$l->id] = 'sometimes|min:1';
			$rules['desc.'.$l->id]  = 'sometimes|min:1';
			$attr['title.'.$l->id]  = 'título ('.$l->names->first()->text.')';
			$attr['desc.'.$l->id]   = 'descripción ('.$l->names->first()->text.')';
				
		}
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$langCtrl = new LangController;

		$art = new Article;
		$art->fillData($data, $langs);

		$art->date = $data['date'];
		$art->save();

		if ($request->hasFile('files')) {
			$files = $request->file('files');
			foreach($files as $f)
			{
				$img = new ArticleFile;
				if(substr($f->getMimeType(), 0, 5) == 'image') {
				    $type = "image";
				}else
				{
				    $type = "document";
				}
					$img->slug 		  = $type;
					$img->file 	      = FileController::upload_image($f, $f->getClientOriginalName(), 'images/noticias/'.$art->id.'/', $type, 1440, 800);
					$img->article_id  = $art->id;
					$img->save();
			}
		}
		Session::flash('success', 'Se ha guardado el nuevo articulo satisfactoriamente.');
		return redirect('administrador/ver-noticias');
	}
	public function getShowArticles()
	{
		$title 		= "Ver categorías| Urialc";
		$articles 	= Article::with('slugs')
		->with('titles')
		->with('descriptions')
		->get();
		return view('admin.articles.show')
		->with('title',$title)
		->with('articles',$articles);
	}
	public function getMdfArticle($id)
	{
		$cats  = Category::with('names')->get();

		$file = new File;
		$fileCtrl = new FileController;
		$langs = Language::with('names')->get();

		$title 	 = "Modificar noticia | Urialc";
		$article = Article::with(['titles' => function($titles){
			$titles->with(['langs' => function($langs){
				$langs->with('names');
			}]);
		}])
		->with(['descriptions' => function($descriptions){
			$descriptions->with(['langs' => function($langs){
				$langs->with('names');
			}]);
		}])

		->with('images')
		->with('documents')
		->find($id);
		return view('admin.articles.mdf')
		->with('title',$title)
		->with('langs',$langs)
		->with('file',$file)
		->with('cats',$cats)
		->with('fileCtrl',$fileCtrl)
		->with('article',$article);
	}
	public function postMdfArticle($id, Request $request)
	{
		$langs = Language::with('names')->get();

		$data = $request->all();
		$langCtrl = new LangController;
		$art = Article::find($id);
		$langCtrl::mdfEntry($langs, $data, 'title');
		$langCtrl::mdfSlug($langs, $data, 'title', $art);
		$langCtrl::mdfEntry($langs, $data, 'desc');
		$art->cat_id = $data['cat'];
		
		if (isset($data['subcat'])) {
			$art->subcat_id = $data['subcat'];		
		}
		if (isset($data['date'])) {
			$art->date = $data['date'];
		}
		$art->save();

		if ($request->hasFile('files')) {
			$files = $request->file('files');
			foreach($files as $f)
			{
				$img = new ArticleFile;
				if(substr($f->getMimeType(), 0, 5) == 'image') {
				    $type = "image";
				}else
				{
				    $type = "document";
				}
					$img->slug 		  = $type;
					$img->file 	      = FileController::upload_image($f, $f->getClientOriginalName(), 'images/noticias/'.$art->id.'/', $type, 1440, 800);
					$img->article_id  = $art->id;
					$img->save();
			}
		}

		Session::flash('success', 'Se ha modificado la noticia satisfactoriamente.');
		return redirect()->back();
	}
	public function postElimArticle(Request $request)
	{
		$file = new File;
		$id = $request->input('id');

		$art = Article::find($id);
		if ($file->deleteDirectory(public_path('images/noticias/'.$art->id.'/'))) {
			ArticleFile::where('article_id','=',$art->id)->delete();
		}
		LangController::deleteEntry($art->slug);
		LangController::deleteEntry($art->title);
		LangController::deleteEntry($art->description);

		$art->delete();

		return response()->json([
			'type' => 'success',
			'msg'  => 'Se ha eliminado la noticia satisfactoriamente.'
		]);

	}
	public function postElimFile($id, Request $request)
	{
		$file = new File;
		$article_id  = $request->input('id');
		$article 	 = Article::find($article_id);
		$img 	 	 = ArticleFile::find($id);
		$file->delete(public_path('images/noticias/'.$article->id.'/'.$img->file));
		$img->delete();
		return response()->json([
			'type' => 'success',
			'msg'  => 'Se ha eliminado la imagen satisfactoriamente'
		]);
	}
	public function checkImages()
	{
		
		return  response()->json([
			'type' => 'success',
			'msg'  => 'llego'
		]);
	}
	public function loadSubcats(Request $request)
	{
		$id = $request->input('id');

		$subcat = SubCategory::with('names')
		->where('cat_id','=',$id)
		->get();

		return view('partials.options')
		->with('collection',$subcat);
	}
}