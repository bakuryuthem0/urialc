<?php namespace urialc\Http\Middleware;

use Closure;


use Libraries\LangController as LangController;
use Illuminate\Support\Facades\Session;


class ChangeLang {

	 /**
     * The availables languages.
     *
     * @array $languages
     */
    protected $languages = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Session::has('locale'))
        {
            Session::put('locale', LangController::getDefaultLang());

        }
        app()->setLocale(Session::get('locale'));


        return $next($request);
    }

}
