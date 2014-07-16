<?php namespace Taiters\Migriffy\Translators;

interface Translator {

	public function toBinding( $string );
	public function toClass( $string );
}