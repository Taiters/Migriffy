<?php namespace Taiters\Migriffy\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Taiters\Migriffy\Parser;
use File;

class Generate extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'migriffy:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate migrations and models from a gliffy file.';

	protected $parser;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Parser $parser)
	{
		parent::__construct();

		$this->parser = $parser;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$filename = getcwd().DIRECTORY_SEPARATOR.$this->argument('filename');

		$data = json_decode(File::get( $filename ));

		$this->parser->parse( $data );
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('filename', InputArgument::REQUIRED, 'The gliffy file containing the schema to be imported.'),
		);
	}


}
