<?php namespace urialc\Http\Controllers;

use urialc\Language as Language;
use urialc\Category as Category;
use urialc\SubCategory as SubCategory;
use urialc\Translation as Translation;
use urialc\TranslationEntry as TranslationEntry;

use Libraries\LangController as LangController;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class AdminController extends Controller {
	public function __construct()
	{
	}
	public function getIndex()
	{
		$title = "Inicio | Urialc";
		return view('admin.home.index')
		->with('title',$title);
	}
	public function getNewCat()
	{
		$langs = Language::with('names')->get();
		$title = "Nueva categoría | Urialc";
		return view('admin.cats.new')
		->with('langs',$langs)
		->with('title',$title);	
	}
	public function postNewCat(Request $request)
	{
		$langs = Language::with('names')->get();

		$data = $request->all();
		$rules = [
			'name'	=> 'required|min:3',
		];
		$msg   = [];
		$attr  = [
			'name' => 'idiomas'
		];

		foreach ($langs as $l) {
			$rules['name.'.$l->id] = 'required|min:1|max:50';
			$attr['name.'.$l->id]  = 'categoría ('.$l->names->first()->text.')';
				
		}
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$cat = new Category;
		$cat->fillData($data, $langs);
		$cat->save();

		Session::flash('success', 'Se ha guardado la nueva categoría satisfactoriamente.');
		return redirect('administrador/ver-categorias');
	}
	public function getShowCat()
	{
		$title = "Ver categorías| Urialc";
		$cats = Category::with('names')
		->with('slugs')
		->get();

		return view('admin.cats.show')
		->with('title',$title)
		->with('cats',$cats);
	}
	public function getMdfCat($id)
	{
		$title = "Modificar categoría | Urialc";
		$cat = Category::with(['names' => function($names){
			$names->with(['langs' => function($langs){
				$langs->with('names');
			}]);
		}])
		->find($id);
		return view('admin.cats.mdf')
		->with('title',$title)
		->with('cat',$cat);
	}
	public function postMdfCat($id, Request $request)
	{
		$langs = Language::with('names')->get();

		$data = $request->all();
		$rules = [
			'name'	=> 'required|min:3',
		];
		$msg   = [];
		$attr  = [
			'name' => 'idiomas'
		];

		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$cat = Category::find($id);
		LangController::mdfEntry($langs, $data, 'name');
		LangController::mdfSlug($langs, $data, 'name', $cat);

		Session::flash('success', 'Se ha modificado la categoría satisfactoriamente.');
		return redirect()->back();
	}
	public function postElimCat(Request $request)
	{
		$id = $request->input('id');

		$cat = Category::find($id);
		LangController::deleteEntry($cat->slug);
		LangController::deleteEntry($cat->name);
		$cat->delete();

		return response()->json([
			'type' => 'success',
			'msg'  => 'Se ha eliminado la categoría satisfactoriamente.'
		]);

	}
	public function getChangeCatStatus(Request $request)
	{
		$id = $request->input('id');

		$cat = Category::find($id);
		if ($cat->in_menu == 1) {
			$cat->in_menu = 0;
		}else
		{
			$cat->in_menu = 1;
		}
		$cat->save();
		return response()->json([
			'type' => 'success',
			'msg'  => 'Se ha cambiado el status satisfactoriamente',
			'state' => $cat->in_menu
		]);
	}
	public function getNewSubCat()
	{
		$langs = Language::with('names')->get();
		$title = "Nueva Sub-categoría | Urialc";
		$cats  = Category::with('names')->get();

		return view('admin.subcats.new')
		->with('cats',$cats)
		->with('langs',$langs)
		->with('title',$title);	
	}
	public function postNewSubCat(Request $request)
	{
		$langs = Language::with('names')->get();

		$data = $request->all();
		$rules = [
			'cat'	=> 'required|exists:categories,id',
			'name'	=> 'required|min:3',
		];
		$msg   = [];
		$attr  = [
			'cat'  => 'categoría',
			'name' => 'idiomas'
		];
		foreach ($langs as $l) {
			$rules['name.'.$l->id] = 'required|min:1|max:50';
			$attr['name.'.$l->id]  = 'categoría ('.$l->names->first()->text.')';
				
		}
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$cat = new SubCategory;
		$cat->cat_id = $data['cat'];
		$cat->fillData($data, $langs);
		$cat->save();

		Session::flash('success', 'Se ha guardado la nueva Sub-categoría satisfactoriamente.');
		return redirect('administrador/ver-subcategorias');
	}
	public function getShowSubCat()
	{
		$title = "Ver Sub-categorías| Urialc";
		$cats = SubCategory::with('names')
		->with('slugs')
		->with(['category' => function($category){
			$category->with('names');
		}])
		->get();

		return view('admin.subcats.show')
		->with('title',$title)
		->with('cats',$cats);
	}
	public function getMdfSubCat($id)
	{
		$title = "Modificar Sub-categoría | Urialc";
		$cats  = Category::with('names')->get();
		$cat = SubCategory::with(['names' => function($names){
			$names->with(['langs' => function($langs){
				$langs->with('names');
			}]);
		}])
		->with(['category' => function($category){
			$category->with('names');
		}])
		->find($id);
		return view('admin.subcats.mdf')
		->with('title',$title)
		->with('cat',$cat)
		->with('cats',$cats);
	}
	public function postMdfSubCat($id, Request $request)
	{
		$langs = Language::with('names')->get();

		$data = $request->all();
		$rules = [
			'cat'   => 'required|exists:categories,id',
			'name'	=> 'required|min:3',
		];
		$msg   = [];
		$attr  = [
			'cat'	=> 'categoría',
			'name' => 'idiomas'
		];

		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$cat = SubCategory::find($id);
		$cat->cat_id = $data['cat'];
		LangController::mdfEntry($langs, $data, 'name');
		LangController::mdfSlug($langs, $data, 'name', $cat);

		Session::flash('success', 'Se ha modificado la Sub-categoría satisfactoriamente.');
		return redirect()->back();
	}
	public function postElimSubCat(Request $request)
	{
		$id = $request->input('id');

		$cat = SubCategory::find($id);
		LangController::deleteEntry($cat->slug);
		LangController::deleteEntry($cat->name);
		$cat->delete();

		return response()->json([
			'type' => 'success',
			'msg'  => 'Se ha eliminado la Sub-categoría satisfactoriamente.'
		]);

	}
	public function getChangeSubCatStatus(Request $request)
	{
		$id = $request->input('id');

		$cat = SubCategory::find($id);
		if ($cat->in_menu == 1) {
			$cat->in_menu = 0;
		}else
		{
			$cat->in_menu = 1;
		}
		$cat->save();
		return response()->json([
			'type' => 'success',
			'msg'  => 'Se ha cambiado el status satisfactoriamente',
			'state' => $cat->in_menu
		]);
	}
}