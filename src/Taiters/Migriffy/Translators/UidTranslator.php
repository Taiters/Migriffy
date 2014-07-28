<?php namespace Taiters\Migriffy\Translators;

use Doctrine\Common\Inflector\Inflector;

class UidTranslator implements Translator{

	public function toBinding( $uid ) {

		$type = $this->getType( $uid );

		return Inflector::camelize( $type );
	}

	public function toClass( $uid ) {
		
		$type = $this->getType( $uid );

		return sprintf( '%s\%s', 'Taiters\Migriffy\Parsers', Inflector::classify( $type ) );
	}

	private function getType( $uid ) {

		$matches = array();
		preg_match('/[^\.]+$/', $uid, $matches);

		return $matches[0];
	}

}