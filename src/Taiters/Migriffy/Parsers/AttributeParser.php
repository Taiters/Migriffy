<?php namespace Taiters\Migriffy\Parsers;

class AttributeParser {

	public function parse( $attributeString ) {

		$matches = [];
		preg_match( '/(.*)<([^:]+)((?::(?:[^:]+))*)>/', $attributeString, $matches );

		$name = $matches[1];
		$type = $matches[2];

		$attributes = array_filter(explode(':', $matches[3]));

		return [
			'name' => trim($name),
			'type' => trim($type),
			'attributes' => array_filter($attributes, 'trim')
		];

	}
}