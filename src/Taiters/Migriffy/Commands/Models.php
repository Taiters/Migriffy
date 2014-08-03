<?php namespace Taiters\Migriffy\Commands;

class Models extends Generate {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'migriffy:models';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate models only from a gliffy file.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		
		$nodes = $this->parseData();

		$this->generateModels( $nodes );

	}
	
}
