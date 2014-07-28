<?php namespace Taiters\Migriffy\Parsers;

class EntityWithAttributes extends BaseParser {

	public function parse( $object ) {

		$nameHtml = $object->children[0]->children[0]->graphic->Text->html;
		$name = strip_tags( $nameHtml );

		return array(
			'id' => $object->id,
			'name' => $name
		);
	}
}