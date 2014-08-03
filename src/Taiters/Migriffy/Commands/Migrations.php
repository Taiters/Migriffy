<?php namespace Taiters\Migriffy\Commands;

class Migrations extends Generate {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'migriffy:migrations';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate migrations only from a gliffy file.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		
		$nodes = $this->parseData();

		$this->generateMigrations( $nodes );

	}

}
