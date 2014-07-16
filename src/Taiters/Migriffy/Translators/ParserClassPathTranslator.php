<?php namespace Taiters\Migriffy\Translators;

use Doctrine\Common\Inflector\Inflector;

class ParserClassPathTranslator implements Translator{

	public function toBinding( $classPath ) {

		$class = $this->getClass( $classPath );

		return Inflector::camelize( $class );
	}

	public function toClass( $classPath ) {

		$class = $this->getClass( $classPath );

		return sprintf( '%s\%s', 'Taiters\Migriffy\Parsers', Inflector::classify( $class ) );
	}

	private function getClass( $uid ) {

		$filename = substr( $uid, strrpos( $uid, '/' ) + 1 );

		return substr( $filename, 0, strpos( $filename, '.' ) );
	}

}