<?php namespace urialc\Http\Controllers;

use urialc\Language as Language;
use urialc\Boletin as Boletin;
use urialc\BoletinFile as BoletinFile;

use Libraries\FileController as FileController;
use Libraries\LangController as LangController;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use Illuminate\Filesystem\Filesystem as File;

class BoletinController extends Controller {
	public function __construct()
	{
	}
	public function getNewBoletin()
	{
		$title = "Nuevo Boletin | Urialc";
		$langs = Language::with('names')->get();
		return view('admin.boletin.new')
		->with('langs',$langs)
		->with('title',$title);
	}
	
	public function postNewBoletin(Request $request)
	{
		$langs = Language::with('names')->get();

		$data = $request->all();
		$rules = [
			'title'		=> 'required|min:1',
		];
		$msg   = [];
		$attr  = [
			'title' 	=> 'idiomas (titulos)',
		];
		foreach ($langs as $l) {
			$rules['title.'.$l->id]	= 'sometimes|min:1|max:100';
			
			$attr['title.'.$l->id]	= 'titulo ('.$l->names->first()->text.')';
		}
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$langCtrl 		  = new LangController;
		$bol 			  = new Boletin;

		$translation      = $langCtrl::newTranslation();
		$langCtrl::newEntry($langs, $translation, $data, 'title');

		$bol->title       = $translation;
		$bol->save();

		Session::flash('success', 'Se ha guardado el nuevo boletin satisfactoriamente.');
		return redirect('administrador/agregar-archivos/'.$bol->id);
	}
	public function getAddBoletinFile($id)
	{
		$title = "Agregar nuevo archivo | urialc";
		$langs = Language::with('names')->get();

		return view('admin.boletin.files')
		->with('id',$id)
		->with('title',$title)
		->with('langs',$langs);
	}
	public function postAddBoletinFile($id, Request $request)
	{
		$data  = $request->all();
		$rules = [
			'lang'	=> 'required|exists:languages,id',
			'file'	=> 'required|mimes:pdf'
		]; 
		$msg   = [];

		$attr  = [
			'lang'	=> 'idioma',
			'file'	=> 'archivo',
		];
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$fileCtrl   = new FileController;
		$file 		= $request->file('file');
		$bolFile 	= new BoletinFile;
		$bolFile->lang_id 	 = $data['lang'];
		$bolFile->boletin_id = $id;
		$bolFile->file 		 = $fileCtrl::upload_image($file, $file->getClientOriginalName(), 'docs/boletines/'.$id.'/', 'document', 1440, 800);
		$bolFile->save();

		Session::flash('success','Se ha cargado el archivo satisfactoriamente.');
		return redirect('administrador/ver-boletines');
	}
	public function getShowBoletines()
	{
		$title = "Ver boletines | Urialc";
		$bol   = Boletin::with('titles')
		->with(['files' => function($files){
			$files->with(['langs' => function($langs){
				$langs->with('names');
			}]);
		}])
		->get();
		return view('admin.boletin.show')
		->with('title',$title)
		->with('bol',$bol);
	}
	public function getMdfBoletin($id)
	{
		$title = "Modificar categoría | Urialc";
		
		$bol   = Boletin::with(['titles' => function($titles){
			$titles->with(['langs' => function($langs){
				$langs->with('names');
			}]);
		}])->find($id);
		return view('admin.boletin.mdf')
		->with('title',$title)
		->with('bol',$bol);
	}
	public function postMdfBoletin($id, Request $request)
	{
		$langs = Language::with('names')->get();

		$data = $request->all();
		$rules = [
			'title'	=> 'required|min:1',
		];
		$msg   = [];
		$attr  = [
			'title' => 'idiomas'
		];

		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}
		$bol = Boletin::find($id);
		LangController::mdfEntry($langs, $data, 'title');

		Session::flash('success', 'Se ha modificado la categoría satisfactoriamente.');
		return redirect()->back();
	}
	public function postElimBoletin(Request $request)
	{
		$file = new File;

		$id 	= $request->input('id');
		$bol 	= Boletin::find($id);
		$files 	= BoletinFile::where('boletin_id','=',$bol->id)->get();
		foreach ($files as $f) {
			$file->delete(public_path('docs/boletines/'.$bol->id.'/'.$f->file));
		}
		BoletinFile::where('boletin_id','=',$bol->id)->delete();
		LangController::deleteEntry($bol->title);
		$bol->delete();

		return response()->json([
			'type' => 'success',
			'msg'  => 'Se ha eliminado el boletin satisfactoriamente.'
		]);

	}
	
}