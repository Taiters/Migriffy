<?php

use Taiters\Migriffy\Generators\MigrationAttributeGenerator;

class MigrationAttributeGeneratorTest extends PHPUnit_Framework_TestCase {

	public function testSimpleAttribute() {

		$attribute = ['name' => 'message', 'type' => 'string'];

		$this->assertEquals( $this->attributeString("\$table->string('message');"), $this->getGenerator()->generate( $attribute ));
	}

	public function testAttributeWithNullable() {

		$attribute = ['name' => 'type', 'type' => 'integer',
			'attributes' => ['nullable']];

		$this->assertEquals( $this->attributeString("\$table->integer('type')->nullable();"), $this->getGenerator()->generate( $attribute ));
	}

	public function testAttributeWithMultipleAttributes() {
		$attribute = ['name' => 'type', 'type' => 'integer',
			'attributes' => ['nullable', 'unsigned']];

		$this->assertEquals( $this->attributeString("\$table->integer('type')->nullable()->unsigned();"), $this->getGenerator()->generate( $attribute ));
	}

	public function attributeString( $string ) {

		return sprintf("%s\n\t\t\t", $string);
	}

	public function getGenerator() {

		return new MigrationAttributeGenerator();
	}

}