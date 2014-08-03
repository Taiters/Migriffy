<?php namespace Taiters\Migriffy;

class Template {

	protected $templateString;

	protected $values = [];

	public function __construct( $name ) {

		$this->templateString = file_get_contents( __DIR__.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$name);
	}

	public function __get( $name ) {

		return $this->values[ $name ];
	}

	public function __set( $name, $value ) {

		$this->set( $name, $value );
	}

	public function set( $identifier, $value ) {

		$this->values[ $identifier ] = $value;

		return $this;
	}

	public function setArray( $values = [] ) {

		foreach( $values as $identifier => $value ) {

			$this->set( $identifier, $value);
		}

		return $this;
	}

	public function compile($values = []) {

		$this->setArray( $values );

		$compiledTemplate = $this->templateString;

		foreach( $this->values as $identifier => $value ) {
			
			$compiledTemplate = str_replace(
				sprintf('{{ %s }}', $identifier),
				$value,
				$compiledTemplate
			);
		}
		
		return $compiledTemplate;
	}

	public function __toString() {

		return $this->compile();
	}
}