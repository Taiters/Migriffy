<?php namespace Taiters\Migriffy\Parsers\Nodes;

class Many extends BaseNodeParser {

	public function parse( $object ) {

		$from = $object->constraints->startConstraint->StartPositionConstraint->nodeId;
		$to   = $object->constraints->endConstraint->EndPositionConstraint->nodeId;

		return array(
			'type' => 'relationship',
			'from' => array(
				'type'   => 'hasMany',
				'nodeId' => $from
			),
			'to' => array(
				'type'   => 'belongsTo',
				'nodeId' => $to
			)
		);
	}
}