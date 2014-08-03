<?php namespace Taiters\Migriffy;

use Illuminate\Support\ServiceProvider;
use App, File;

class MigriffyServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('migriffy.generate', 'Taiters\Migriffy\Commands\Generate');
		$this->app->singleton('migriffy.migrations', 'Taiters\Migriffy\Commands\Migrations');
		$this->app->singleton('migriffy.models', 'Taiters\Migriffy\Commands\Models');

		$translator = $this->app->make('Taiters\Migriffy\Translators\ParserClassPathTranslator');
		$parsers    = $this->getParsers();

		foreach( $parsers as $parser ) {

			$binding   = $translator->toBinding( $parser );
			$className = $translator->toClass( $parser );
			
			$this->app->singleton( $binding, $className );
		}
	}

	public function boot() {

		$this->commands('migriffy.generate');
		$this->commands('migriffy.migrations');
		$this->commands('migriffy.models');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	private function getParsers() {

		$dir = __DIR__.DIRECTORY_SEPARATOR.'Parsers'.DIRECTORY_SEPARATOR.'Nodes';

		return File::files($dir);
	}

}
