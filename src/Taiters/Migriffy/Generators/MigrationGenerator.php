<?php namespace Taiters\Migriffy\Generators;

use Taiters\Migriffy\Translators\NodeTranslator;
use Taiters\Migriffy\Template;

class MigrationGenerator {

	private $nodeTranslator;
	private $migrationAttributeGenerator;
	private $migrationRelationshipGenerator;

	public function __construct( NodeTranslator $nodeTranslator, 
		MigrationAttributeGenerator $migrationAttributeGenerator,
		MigrationRelationshipGenerator $migrationRelationshipGenerator ) {

		$this->nodeTranslator = $nodeTranslator;
		$this->migrationAttributeGenerator = $migrationAttributeGenerator;
		$this->migrationRelationshipGenerator = $migrationRelationshipGenerator;
	}

	public function generate( $node ) {

		$template = new Template('migration');

		$template->name = $node->name;
		$template->table = $this->nodeTranslator->toTable( $node );
		$template->migration = $this->nodeTranslator->toMigrationClass( $node );

		$template->attributes = '';
		foreach( $node->attributes as $attribute ) {

			$template->attributes .= $this->migrationAttributeGenerator->generate( $attribute );
		}

		$template->relationships = '';

		foreach( $node->relationships as $type => $relationships ) {

			if( $type == 'belongsTo' ) {

				foreach( $relationships as $relationship ) {

					$template->relationships .= $this->migrationRelationshipGenerator->generate( $relationship );
				}
			}
		}

		return $template;
	}
}