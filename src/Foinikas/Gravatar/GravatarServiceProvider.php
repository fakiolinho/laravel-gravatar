<?php namespace Foinikas\Gravatar;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class GravatarServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Gravatar', function($app){
			return new Gravatar;
		});
	}

	public function boot()
	{
		$this->package('foinikas/gravatar');

		AliasLoader::getInstance()->alias('Gravatar', 'Foinikas\Gravatar\Facades\Gravatar');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('Gravatar');
	}

}
