<?php namespace Taiters\Migriffy;

use Taiters\Migriffy\Translators\NodeTranslator;
use Doctrine\Common\Inflector\Inflector;

class ModelGenerator {

	private $nodeTranslator;
	private $template;

	public function __construct(NodeTranslator $nodeTranslator) {

		$this->nodeTranslator = $nodeTranslator;
		$this->template = file_get_contents( __DIR__.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'model');
	}

	public function generate( $node ) {

		$modelFile = $this->template;

		$tableName = $this->nodeTranslator->toTable( $node );

		$modelFile = str_replace('{{ table }}', $tableName, $modelFile);

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

		$modelFile = str_replace('{{ relationships }}', $relationships, $modelFile);
		$modelFile = str_replace('{{ name }}', $node->name, $modelFile);

		return $modelFile;
	}
}