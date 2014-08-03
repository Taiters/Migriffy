<?php namespace Taiters\Migriffy\Generators;

use Taiters\Migriffy\Translators\NodeTranslator;

class MigrationRelationshipGenerator {

	private $name;
	private $type;
	private $attributes = [];

	private $nodeTranslator;

	public function __construct( NodeTranslator $nodeTranslator ) {

		$this->nodeTranslator = $nodeTranslator;
	}

	public function generate( $relationship ) {

		$relationString = sprintf("\$table->integer('%s')->unsigned()", $this->nodeTranslator->toId( $relationship ));

		return $relationString.";\n\t\t\t";
	}

}