<?php namespace Taiters\Migriffy\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Taiters\Migriffy\Parser;
use Taiters\Migriffy\ModelGenerator;
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
	protected $modelGenerator;
	protected $filesystem;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Parser $parser, ModelGenerator $modelGenerator, Filesystem $filesystem)
	{
		parent::__construct();

		$this->parser = $parser;
		$this->modelGenerator = $modelGenerator;
		$this->filesystem = $filesystem;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->info('Reading Gliffy file data...');

		$filename = getcwd().DIRECTORY_SEPARATOR.$this->argument('filename');
		$data = json_decode(File::get( $filename ));

		$this->info('Parsing Gliffy data...');

		$nodes = $this->parser->parse( $data );

		$this->info('Generating models...');

		foreach( $nodes as $node ) {

			$model = $this->modelGenerator->generate( $node );

			$filename = $filename = app_path().DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.$node->name.'.php';
			
			$this->filesystem->put($filename, $model);
			$this->info('Created: '.$filename);
		}

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
