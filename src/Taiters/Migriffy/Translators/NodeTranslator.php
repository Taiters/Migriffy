<?php namespace Taiters\Migriffy\Translators;

use Doctrine\Common\Inflector\Inflector;

class NodeTranslator {

	public function toTable( $node ) {

		return Inflector::tableize( Inflector::pluralize( $node->name ) );
	}

	public function toId( $node ) {

		return Inflector::tableize( $node->name ).'_id';
	}

	public function toMigrationClass( $node ) {

		return sprintf('Create%sTable', Inflector::classify( $this->toTable($node) ));
	}

	public function toRelation( $node, $type ) {

		$name = $node->name;

		if( $type == 'hasMany' ) {

			$name = Inflector::pluralize( $name );
		}

		return Inflector::camelize( $name );
	}
}