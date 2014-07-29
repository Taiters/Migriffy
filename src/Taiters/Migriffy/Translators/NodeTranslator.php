<?php namespace Taiters\Migriffy\Translators;

use Doctrine\Common\Inflector\Inflector;

class NodeTranslator {

	public function toTable( $node ) {

		return Inflector::tableize( Inflector::pluralize( $node->name ) );
	}

	public function toRelation( $node, $type ) {

		$name = $node->name;

		if( $type == 'hasMany' ) {

			$name = Inflector::pluralize( $name );
		}

		return Inflector::camelize( $name );
	}
}