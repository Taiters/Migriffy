<?php namespace Taiters\Migriffy\Translators;

interface ParserTranslator {

	public function toBinding( $string );
	public function toClass( $string );
}