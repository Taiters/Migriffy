<?php namespace Taiters\Migriffy\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Taiters\Migriffy\Parser;
use Taiters\Migriffy\Generators\ModelGenerator;
use Taiters\Migriffy\Generators\MigrationGenerator;
use File;

class Generate extends Command {

	protected static $MIGRATIONS_PATH;
	protected static $MODELS_PATH;
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
	protected $migrationGenerator;
	protected $filesystem;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Parser $parser, 
		ModelGenerator $modelGenerator, 
		MigrationGenerator $migrationGenerator,
		Filesystem $filesystem)
	{
		parent::__construct();

		self::$MIGRATIONS_PATH = app_path().DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations';
		self::$MODELS_PATH     = app_path().DIRECTORY_SEPARATOR.'models';

		$this->parser = $parser;
		$this->modelGenerator = $modelGenerator;
		$this->migrationGenerator = $migrationGenerator;
		$this->filesystem = $filesystem;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		
		$nodes = $this->parseData();

		$this->generateModels( $nodes );
		$this->generateMigrations( $nodes );

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


	protected function generateMigrations( $nodes ) {

		$this->info('Generating migrations...');

		foreach( $nodes as $node ) {

			$migrationTemplate = $this->migrationGenerator->generate( $node );
			
			$filename = self::$MIGRATIONS_PATH.DIRECTORY_SEPARATOR.sprintf(
				'%s_create_%s_table.php',
				date('Y_m_d_His'),
				$migrationTemplate->table
			);

			$this->filesystem->put( $filename, $migrationTemplate );

			$this->info('Created: '.$filename);
		}
	}

	protected function generateModels( $nodes ) {

		$this->info('Generating models...');

		foreach( $nodes as $node ) {

			$modelTemplate = $this->modelGenerator->generate( $node );

			$filename = self::$MODELS_PATH.DIRECTORY_SEPARATOR.$modelTemplate->name.'.php';
			$this->filesystem->put( $filename, $modelTemplate );

			$this->info('Created: '.$filename);
		}
	}

	protected function parseData() {

		$this->info('Reading Gliffy file data...');

		$filename = getcwd().DIRECTORY_SEPARATOR.$this->argument('filename');
		$data = json_decode(File::get( $filename ));

		$this->info('Parsing Gliffy data...');

		return $this->parser->parse( $data );
	}


}
