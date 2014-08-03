<?php namespace Taiters\Migriffy\Generators;

use Taiters\Migriffy\Translators\NodeTranslator;
use Taiters\Migriffy\Template;

class ModelGenerator {

	private $nodeTranslator;
	private $modelString;

	public function __construct(NodeTranslator $nodeTranslator) {

		$this->nodeTranslator = $nodeTranslator;
	}

	public function generate( $node ) {

		$template = new Template('model');

		$tableName = $this->nodeTranslator->toTable( $node );

		$template->name  = $node->name;
		$template->table = $tableName;

		$relationships = '';

		foreach( $node->relationships as $type => $typeRelationships ) {

			foreach( $typeRelationships as $relation ) {

				$name = $this->nodeTranslator->toRelation( $relation, $type );

				$relationships .= sprintf(
						"public function %s() {\n"
					.	"\n"
					.	"\t\treturn \$this->%s('%s');\n"
					.	"\t}\n\n\t", $name, $type, $relation->name);

			}
		}

		$template->relationships = $relationships;

		return $template;
	}

}