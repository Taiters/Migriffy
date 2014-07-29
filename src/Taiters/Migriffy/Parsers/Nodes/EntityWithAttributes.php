<?php namespace Taiters\Migriffy\Parsers\Nodes;

use Sunra\PhpSimple\HtmlDomParser;
use Taiters\Migriffy\Parsers\AttributeParser;

class EntityWithAttributes extends BaseNodeParser {

	private $attributeParser;

	public function __construct( AttributeParser $attributeParser ) {

		$this->attributeParser = $attributeParser;
	}

	public function parse( $object ) {

		$nameHtml = $object->children[0]->children[0]->graphic->Text->html;
		$name = strip_tags( $nameHtml );

		$attributesHtml = $object->children[1]->children[0]->graphic->Text->html;

		$dom = HtmlDomParser::str_get_html( $attributesHtml );

		$attributes = [];

		foreach( $dom->find('p') as $element ) {

			$result = $this->attributeParser->parse( html_entity_decode( $element->plaintext ) );

			array_push( $attributes, $result );
		}

		return array(
			'id' => $object->id,
			'name' => $name,
			'attributes' => $attributes
		);
	}
}