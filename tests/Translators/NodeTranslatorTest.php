<?php

use Taiters\Migriffy\Translators\NodeTranslator;
use Mockery as m;

class NodeTranslatorTest extends PHPUnit_Framework_TestCase {

	public function testToTable() {

		$node = $this->getNode([
			'name' => 'Animal'
		]);

		$this->assertEquals('animals', $this->getTranslator()->toTable( $node ));
	}

	public function testToTableWithCamelCaseName() {

		$node = $this->getNode([
			'name' => 'BigCat'
		]);

		$this->assertEquals('big_cats', $this->getTranslator()->toTable( $node ));
	}

	public function testToTableWithUnusualPluralization() {

		$node = $this->getNode([
			'name' => 'Person'
		]);

		$this->assertEquals('people', $this->getTranslator()->toTable( $node ));
	}

	public function testToTableWithUnusualPluralizationAndCamelCase() {

		$node = $this->getNode([
			'name' => 'StrangeUnusualPerson'
		]);

		$this->assertEquals('strange_unusual_people', $this->getTranslator()->toTable( $node ));
	}

	public function testToId() {

		$node = $this->getNode([
			'name' => 'Cougar'
		]);

		$this->assertEquals('cougar_id', $this->getTranslator()->toId( $node ));
	}

	public function testToIdWithCamelCase() {

		$node = $this->getNode([
			'name' => 'BigBurlyBear'
		]);

		$this->assertEquals('big_burly_bear_id', $this->getTranslator()->toId( $node ));
	}

	public function testToMigrationClass() {

		$node = $this->getNode([
			'name' => 'Blog'
		]);

		$this->assertEquals('CreateBlogsTable', $this->getTranslator()->toMigrationClass( $node ));
	}

	public function testToMigrationClassWithCamelCase() {

		$node = $this->getNode([
			'name' => 'SuperPost'
		]);

		$this->assertEquals('CreateSuperPostsTable', $this->getTranslator()->toMigrationClass( $node ));
	}

	public function testToMigrationClassWithUnusualPluralization() {

		$node = $this->getNode([
			'name' => 'Virus'
		]);

		$this->assertEquals('CreateViriTable', $this->getTranslator()->toMigrationClass( $node ));
	}

	public function testToMigrationClassWithUnusualPluralizationAndCamelCase() {

		$node = $this->getNode([
			'name' => 'ThisIsSomeCrazyPerson'
		]);

		$this->assertEquals('CreateThisIsSomeCrazyPeopleTable', $this->getTranslator()->toMigrationClass( $node ));
	}

	public function testToRelationHasMany() {

		$node = $this->getNode([
			'name' => 'Cat'
		]);

		$this->assertEquals('cats', $this->getTranslator()->toRelation( $node, 'hasMany' ));
	}

	public function testToRelationHasManyWithCamelCase() {

		$node = $this->getNode([
			'name' => 'BigCat'
		]);

		$this->assertEquals('bigCats', $this->getTranslator()->toRelation( $node, 'hasMany' ));
	}

	public function testToRelationHasManyWithUnusualPluralization() {

		$node = $this->getNode([
			'name' => 'Person'
		]);

		$this->assertEquals('people', $this->getTranslator()->toRelation( $node, 'hasMany' ));
	}

	public function testToRelationHasManyWithUnusualPluralizationAndCamelCase() {

		$node = $this->getNode([
			'name' => 'BigPerson'
		]);

		$this->assertEquals('bigPeople', $this->getTranslator()->toRelation( $node, 'hasMany' ));
	}



	public function testToRelation() {

		$node = $this->getNode([
			'name' => 'Cat'
		]);

		$this->assertEquals('cat', $this->getTranslator()->toRelation( $node ));
	}

	public function testToRelationWithCamelCase() {

		$node = $this->getNode([
			'name' => 'BigCat'
		]);

		$this->assertEquals('bigCat', $this->getTranslator()->toRelation( $node ));
	}

	public function testToRelationWithUnusualPluralization() {

		$node = $this->getNode([
			'name' => 'Person'
		]);

		$this->assertEquals('person', $this->getTranslator()->toRelation( $node ));
	}

	public function testToRelationWithUnusualPluralizationAndCamelCase() {

		$node = $this->getNode([
			'name' => 'BigPerson'
		]);

		$this->assertEquals('bigPerson', $this->getTranslator()->toRelation( $node ));
	}

	private function getTranslator() {

		return new NodeTranslator();
	}

	private function getNode($values = []) {

		$node = m::mock('Taiters\Migriffy\Node');

		foreach( $values as $name => $value ) {

			$node->$name = $value;
		}

		return $node;
	}

	protected function tearDown() {

		m::close();
	}

}