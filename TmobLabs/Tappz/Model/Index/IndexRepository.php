<?php

namespace TmobLabs\Tappz\Model\Index;

use TmobLabs\Tappz\API\IndexRepositoryInterface;

class IndexRepository implements IndexRepositoryInterface
{

	private $indexCollector;

	public function __construct(
		IndexCollector $indexCollector

	) {
		$this->indexCollector = $indexCollector;

	}

	public function getIndex()
	{


		$result = $this->indexCollector->getIndex();

		return $result;
	}

}
