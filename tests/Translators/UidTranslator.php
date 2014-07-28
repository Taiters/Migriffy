<?php

use Taiters\Migriffy\Translators\UidTranslator;

class UidTranslatorTest extends PHPUnit_Framework_TestCase {

	public function testToBindingWithSingleWordLcFirst() {

		$string = 'many';
		$this->assertEquals('many', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithSingleWordUcFirst() {

		$string = 'Many';
		$this->assertEquals('many', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithMultipleWord() {
		
		$string = 'entity_with_multiple_attributes';
		$this->assertEquals('entityWithMultipleAttributes', $this->getTranslatedBinding($string));
	}

	public function testToBindingWithFullUidWithOneWordName() {

		$string = 'com.gliffy.shape.erd.erd_v1.default.many';
		$this->assertEquals('many', $this->getTranslatedBinding($string));
	}

	public function testToBindingWithFullUidWithMultipleWordName() {

		$string = 'com.gliffy.shape.erd.erd_v1.default.entity_with_multiple_attributes';
		$this->assertEquals('entityWithMultipleAttributes', $this->getTranslatedBinding($string));
	}

	public function testToBindingWithFullUidMixedCases() {

		$string = 'com.gliffy.shape.erd.erd_v1.default.Entity_with_Multiple_Attributes';
		$this->assertEquals('entityWithMultipleAttributes', $this->getTranslatedBinding($string));
	}


	public function testToClassWithSingleWordLcFirst() {

		$string = 'many';
		$this->assertEquals('Taiters\Migriffy\Parsers\Many', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithSingleWordUcFirst() {

		$string = 'Many';
		$this->assertEquals('Taiters\Migriffy\Parsers\Many', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithMultipleWord() {
		
		$string = 'entity_with_multiple_attributes';
		$this->assertEquals('Taiters\Migriffy\Parsers\EntityWithMultipleAttributes', $this->getTranslatedClass($string));
	}

	public function testToClassWithFullUidWithOneWordName() {

		$string = 'com.gliffy.shape.erd.erd_v1.default.many';
		$this->assertEquals('Taiters\Migriffy\Parsers\Many', $this->getTranslatedClass($string));
	}

	public function testToClassWithFullUidWithMultipleWordName() {

		$string = 'com.gliffy.shape.erd.erd_v1.default.entity_with_multiple_attributes';
		$this->assertEquals('Taiters\Migriffy\Parsers\EntityWithMultipleAttributes', $this->getTranslatedClass($string));
	}

	public function testToClassWithFullUidMixedCases() {

		$string = 'com.gliffy.shape.erd.erd_v1.default.Entity_with_Multiple_Attributes';
		$this->assertEquals('Taiters\Migriffy\Parsers\EntityWithMultipleAttributes', $this->getTranslatedClass($string));
	}


	private function getParser() {

		return new UidTranslator();
	}

	private function getTranslatedBinding( $string ) {

		return $this->getParser()->toBinding( $string );
	}

	private function getTranslatedClass( $string ) {

		return $this->getParser()->toClass( $string );
	}
}