<?php namespace Taiters\Migriffy\Generators;

class MigrationAttributeGenerator {

	private $name;
	private $type;
	private $attributes = [];

	public function generate( $attribute ) {

		$attributeString = sprintf("\$table->%s('%s')", $attribute['type'], $attribute['name']);

		if( isset( $attribute['attributes'] ) ) {
		
			foreach( $attribute['attributes'] as $attributeName ) {

				$attributeString .= '->'.$attributeName.'()';
			}
		}

		return $attributeString.";\n\t\t\t";
	}

}