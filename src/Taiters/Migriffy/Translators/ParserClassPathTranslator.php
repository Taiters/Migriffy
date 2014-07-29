<?php namespace Taiters\Migriffy\Translators;

use Doctrine\Common\Inflector\Inflector;

class ParserClassPathTranslator implements Translator{

	public function toBinding( $classPath ) {

		$class = $this->getClass( $classPath );

		return Inflector::camelize( $class );
	}

	public function toClass( $classPath ) {

		$class = $this->getClass( $classPath );

		return sprintf( '%s\%s', 'Taiters\Migriffy\Parsers\Nodes', Inflector::classify( $class ) );
	}

	private function getClass( $filename ) {

		$matches = array();
		$filename = preg_match('/([^\/]+)$/', preg_replace('/\.php$/', '', $filename), $matches);

		return $matches[0];
	}

}