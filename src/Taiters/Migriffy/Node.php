<?php namespace Taiters\Migriffy;

class Node {

	public $name;
	public $attributes;
	public $relationships = [];

	public function __construct( $name, $attributes = [] ) {

		$this->name = $name;
		$this->attributes = $attributes;
	}

	public function addRelationship( $node, $type ) {

		if( !isset( $this->relations[ $type ] ) ) {

			$this->relationships[ $type ] = [];
		}

		array_push( $this->relationships[ $type ], $node );
	}
}