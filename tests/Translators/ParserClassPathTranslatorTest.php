<?php

use Taiters\Migriffy\Translators\ParserClassPathTranslator;

class ParserClassPathTranslatorTest extends PHPUnit_Framework_TestCase {

	public function testToBindingWithSnakeCaseFilename() {

		$string = 'hello_world.php';
		$this->assertEquals('helloWorld', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithSnakeCaseFilenameAndRelativePath() {

		$string = 'this/is_a/path_this_way.php';
		$this->assertEquals('pathThisWay', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithSnakeCaseFilenameAndNoExtension() {

		$string = 'hello_world';
		$this->assertEquals('helloWorld', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithSnakeCaseFilenameAndNoExtensionAndRelativePath() {

		$string = 'this/is_a/path_this_way';
		$this->assertEquals('pathThisWay', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithSnakeCaseFilenameAndAbsolutePath() {

		$string = '/this/is_a/path_this_way.php';
		$this->assertEquals('pathThisWay', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithSnakeCaseFilenameAndNoExtensionAndAbsolutePath() {

		$string = '/this/is_a/path_this_way';
		$this->assertEquals('pathThisWay', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithCamelCaseFilename() {

		$string = 'helloWorld.php';
		$this->assertEquals('helloWorld', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithCamelCaseFilenameAndRelativePath() {

		$string = 'this/isA/pathThisWay.php';
		$this->assertEquals('pathThisWay', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithCamelCaseFilenameAndNoExtension() {

		$string = 'helloWorld';
		$this->assertEquals('helloWorld', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithCamelCaseFilenameAndNoExtensionAndRelativePath() {

		$string = 'this/isA/pathThisWay';
		$this->assertEquals('pathThisWay', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithCamelCaseFilenameAndAbsolutePath() {

		$string = '/this/isA/pathThisWay.php';
		$this->assertEquals('pathThisWay', $this->getTranslatedBinding( $string ));
	}

	public function testToBindingWithCamelCaseFilenameAndNoExtensionAndAbsolutePath() {

		$string = '/this/isA/pathThisWay';
		$this->assertEquals('pathThisWay', $this->getTranslatedBinding( $string ));
	}



	public function testToClassWithSnakeCaseFilename() {

		$string = 'hello_world.php';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\HelloWorld', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithSnakeCaseFilenameAndRelativePath() {

		$string = 'this/is_a/path_this_way.php';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\PathThisWay', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithSnakeCaseFilenameAndNoExtension() {

		$string = 'hello_world';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\HelloWorld', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithSnakeCaseFilenameAndNoExtensionAndRelativePath() {

		$string = 'this/is_a/path_this_way';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\PathThisWay', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithSnakeCaseFilenameAndAbsolutePath() {

		$string = '/this/is_a/path_this_way.php';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\PathThisWay', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithSnakeCaseFilenameAndNoExtensionAndAbsolutePath() {

		$string = '/this/is_a/path_this_way';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\PathThisWay', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithCamelCaseFilename() {

		$string = 'helloWorld.php';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\HelloWorld', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithCamelCaseFilenameAndRelativePath() {

		$string = 'this/isA/pathThisWay.php';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\PathThisWay', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithCamelCaseFilenameAndNoExtension() {

		$string = 'helloWorld';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\HelloWorld', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithCamelCaseFilenameAndNoExtensionAndRelativePath() {

		$string = 'this/isA/pathThisWay';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\PathThisWay', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithCamelCaseFilenameAndAbsolutePath() {

		$string = '/this/isA/pathThisWay.php';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\PathThisWay', $this->getTranslatedClass( $string ));
	}

	public function testToClassWithCamelCaseFilenameAndNoExtensionAndAbsolutePath() {

		$string = '/this/isA/pathThisWay';
		$this->assertEquals('Taiters\Migriffy\Parsers\Nodes\PathThisWay', $this->getTranslatedClass( $string ));
	}




	private function getParser() {

		return new ParserClassPathTranslator();
	}

	private function getTranslatedBinding( $string ) {

		return $this->getParser()->toBinding( $string );
	}

	private function getTranslatedClass( $string ) {

		return $this->getParser()->toClass( $string );
	}
}