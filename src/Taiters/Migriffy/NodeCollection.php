<?php namespace Taiters\Migriffy;

use Illuminate\Support\Collection;

class NodeCollection extends Collection {

	public function __construct( $nodes ) {

		foreach( $nodes as $i => $node ) {

			if( $node['type'] == 'model' ) {

				$this->items[ $node['id'] ] = new Node( $node['name'], $node['attributes'] );

				unset( $nodes[ $i ] );
			}
		}

		foreach( $nodes as $i => $node ) {

			if( $node['type'] == 'relationship' ) {

				$from = $this->items[ $node['from']['nodeId'] ];
				$to   = $this->items[ $node['to']['nodeId'] ];

				$from->addRelationship( $to, $node['from']['type'] );
				$to->addRelationship( $from, $node['to']['type'] );

				unset($node[ $i ]);
			}
		}
	}
}