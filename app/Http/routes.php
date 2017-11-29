<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');
Route::get('inicio/que-es-uri','HomeController@getWhatsUri');
Route::get('noticias/ver-noticias/{slug}','SearchController@getSelf');
Route::get('noticias/busqueda/{type}','SearchController@getSearch');
Route::get('noticias/busqueda/{type}/{subcat}','SearchController@getSearch');
Route::get('inicio/contactenos','HomeController@getContact');
Route::get('inicio/festival','HomeController@getFestival');

Route::get('cambiar-lenguaje/{lang}',function($lang){
	Session::put('locale', $lang);
	return redirect()->back();
});

Route::get('administrador/login','AuthController@getLogin');
Route::group(['middleware' => ['NoAuth']],function(){
	Route::post('administrador/login/enviar','AuthController@postLogin');

});

Route::group(['middleware' => ['auth']],function(){
	Route::get('administrador','AdminController@getIndex');
	//categorias
	Route::get('administrador/nueva-categoria','AdminController@getNewCat');
	Route::get('administrador/ver-categorias','AdminController@getShowCat');
	Route::get('administrador/ver-categorias/{id}','AdminController@getMdfCat');
	Route::get('administrador/categoria/mostrar-en-menu','AdminController@getChangeCatStatus');
	Route::post('administrador/nueva-categoria/enviar','AdminController@postNewCat');
	Route::post('administrador/ver-categorias/{id}/enviar','AdminController@postMdfCat');
	Route::post('administrador/ver-categorias/eliminar','AdminController@postElimCat');
	//subcategorias
	Route::get('administrador/nueva-subcategoria', 'AdminController@getNewSubCat');
	Route::get('administrador/ver-subcategorias', 'AdminController@getShowSubCat');
	Route::get('administrador/ver-subcategorias/{id}','AdminController@getMdfSubCat');
	Route::get('administrador/sub-categoria/mostrar-en-menu','AdminController@getChangeSubCatStatus');
	Route::post('administrador/nueva-subcategoria/enviar','AdminController@postNewSubCat');
	Route::post('administrador/modificar-subcategoria/{id}/enviar','AdminController@postMdfSubCat');
	Route::post('administrador/ver-subcategorias/eliminar','AdminController@postElimSubCat');
	//articulos
	Route::get('administrador/nueva-noticia','NewsController@getNewArticle');
	Route::get('administrador/ver-noticias','NewsController@getShowArticles');
	Route::get('administrador/ver-noticias/{id}','NewsController@getMdfArticle');
	Route::get('administrador/cargar-subcategorias','NewsController@loadSubcats');
	Route::post('administrador/nueva-noticia/enviar','NewsController@postNewArticle');
	Route::post('administrador/modificar-noticia/{id}/enviar','NewsController@postMdfArticle');
	Route::post('administrador/ver-noticias/eliminar-archivo/{id}','NewsController@postElimFile');
	Route::post('administrador/ver-noticias/eliminar','NewsController@postElimArticle');
	//banners
	Route::get('administrador/nuevo-banner','BannerController@getNewBanner');
	Route::get('administrador/ver-banners','BannerController@getShowBanners');
	Route::get('administrador/ver-banners/{id}','BannerController@getMdfBanner');
	Route::post('administrador/nuevo-banner/enviar','BannerController@postNewBanner');
	Route::post('administrador/modificar-banner/{id}/enviar','BannerController@postMdfBanner');
	Route::post('administrador/ver-banners/eliminar','BannerController@postElimBanner');
	Route::get('admin/ver-imagen','NewsController@checkImages');
	//boletin
	Route::get('administrador/nuevo-boletin','BoletinController@getNewBoletin');
	Route::get('administrador/agregar-archivos/{id}','BoletinController@getAddBoletinFile');
	Route::get('administrador/ver-boletines','BoletinController@getShowBoletines');
	Route::get('administrador/ver-boletines/modificar/{id}','BoletinController@getMdfBoletin');

	Route::post('administrador/agregar-archivos/{id}/enviar','BoletinController@postAddBoletinFile');
	Route::post('administrador/nuevo-boletin/enviar','BoletinController@postNewBoletin');
	Route::post('administrador/ver-boletines/modificar/{id}/enviar','BoletinController@postMdfBoletin');
	Route::post('administrador/ver-boletines/eliminar','BoletinController@postElimBoletin');
});