<?php namespace Taiters\Migriffy;

use Illuminate\Foundation\Application;
use Taiters\Migriffy\Translators\UidTranslator;

class Parser {

	private $translator;
	private $app;

	public function __construct( UidTranslator $translator, Application $app ) {

		$this->translator = $translator;
		$this->app 	      = $app;
	}

	public function parse( $data ) {

		$gliffyNodes = array();

		foreach( $data->stage->objects as $object ) {

			array_push( $gliffyNodes, $this->parseObject( $object ) );
		}

		dd( $gliffyNodes );
	}

	private function parseObject( $object ) {

		$parser = $this->getParser( $object->uid );

		return $parser->parse( $object );

	}

	private function getParser( $uid ) {

		return $this->app->make( $this->translator->toBinding( $uid ) );
	}
}