<?php namespace urialc\Http\Controllers;

use urialc\Language as Language;
use urialc\Banner as Banner;

use Libraries\FileController as FileController;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
	use Illuminate\Filesystem\Filesystem as File;

class BannerController extends Controller {
	public function getNewBanner()
	{
		$langs = Language::with('names')->get();
		$title = "Nuevo banner principal | urialc";

		return view('admin.banners.new')
		->with('title',$title)
		->with('langs',$langs);
	}
	public function postNewBanner(Request $request)
	{
		$data  = $request->all();
		$rules = [
			'file' 	 		=> 'required|image',
			'file_mobil'	=> 'sometimes|image',
			'url'	 		=> 'sometimes|url',
			'title'  		=> 'sometimes|max:100',
			'lang'	 		=> 'required|exists:languages,id'
		];
		$msg  = [];
		$attr = [
			'title'			=> 'titulo',
			'lang'  		=> 'idioma',
			'file'			=> 'banner',
			'file_mobil'	=> 'banner mobil',
		];

		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$banner = new Banner;
		if ($request->has('url')) {
			$banner->url = $data['url'];	
		}
		if ($request->has('title')) {
			$banner->title = $data['title'];
		}
		$file = $request->file('file');
		$banner->desktop   = FileController::upload_image($file, $file->getClientOriginalName(), 'images/banners/', 'image', 1440, 800);
		if ($request->hasFile('file_mobil')) {
			$file = $request->file('file_mobil');
			$banner->phone   = FileController::upload_image($file, $file->getClientOriginalName(), 'images/banners/phone/', 'image', 480, 740);
		}
		$banner->lang_id = $data['lang'];
		$banner->is_active = 1;
		$banner->save();
		$count = Banner::where('is_active','=',1)->count();
		if ($count > 6) {
			$last = Banner::where('is_active','=',1)->orderBy('id','ASC')->first();
			$last->is_active = 0;
			$last->save();
		}
		Session::flash('success', 'Se ha cargado el banner satisfactoriamente.');
		return redirect('administrador/ver-banners');
	}
	public function getShowBanners()
	{
		$title = "Ver banners | urialc";
		$banners = Banner::with(['langs' => function($langs){
			$langs->with('names');
		}])->get();
		return view('admin.banners.show')
		->with('title',$title)
		->with('banners',$banners);
	}
	public function getMdfBanner($id)
	{
		$title = "Modificar banner | urialc";
		$langs = Language::with('names')->get();
		$banner = Banner::find($id);

		return view('admin.banners.mdf')
		->with('langs',$langs)
		->with('title',$title)
		->with('banner',$banner);
	}
	public function postMdfBanner($id, Request $request)
	{
		$data  = $request->all();
		$rules = [
			'file' 	 => 'sometimes|image',
			'url'	 => 'sometimes|url',
			'title'  => 'sometimes|max:100',
			'lang'	 => 'required|exists:languages,id'
		];
		$msg  = [];
		$attr = [
			'title'	=> 'titulo',
			'lang'  => 'idioma',
			'file'	=> 'banner',
		];

		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$banner = Banner::find($id);
		if ($request->has('url')) {
			$banner->url = $data['url'];	
		}
		if ($request->has('title')) {
			$banner->title = $data['title'];
		}
		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$banner->desktop   = FileController::upload_image($file, $file->getClientOriginalName(), 'images/banners/', 'image',1440, 800);
		}
		if ($request->hasFile('file_mobil')) {
			$file = $request->file('file_mobil');
			$banner->phone   = FileController::upload_image($file, $file->getClientOriginalName(), 'images/banners/phone/', 'image', 480, 740);
		}
		$banner->lang_id = $data['lang'];
		$banner->save();
		Session::flash('success', 'Se ha modificado el banner satisfactoriamente.');
		return redirect()->back();
	}
	public function postElimBanner(Request $request)
	{
		$id = $request->input('id');
		$file = new File;
		$banner = Banner::find($id);
		$file->delete(public_path('images/banners/'.$banner->image));
		$banner->delete();
		return response()->json([
			'type' => 'success',
			'msg'  => 'Se ha eliminado el banner satisfactoriamente.'
		]);

	}
}