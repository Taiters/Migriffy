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

		foreach( $data->stage->objects as $object ) {

			$this->parseObject( $object );
		}
	}

	public function parseObject( $object ) {

		$parserName = $this->translator->toBinding( $object->uid );

	}
}