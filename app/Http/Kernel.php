<?php namespace urialc\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'urialc\Http\Middleware\ChangeLang',
		'urialc\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' 		 => 'urialc\Http\Middleware\Authenticate',
		'NoAuth'	 => 'urialc\Http\Middleware\NoAuth',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' 	 => 'urialc\Http\Middleware\RedirectIfAuthenticated',
		'changeLang' => 'urialc\Http\Middleware\ChangeLang',
	];

}
