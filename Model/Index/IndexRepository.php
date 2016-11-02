<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Index;

use TmobLabs\Tappz\API\IndexRepositoryInterface;

/**
 * Class IndexRepository.
 */
class IndexRepository implements IndexRepositoryInterface
{
    /**
     * @var IndexCollector
     */
    private $indexCollector;

    /**
     * IndexRepository constructor.
     *
     * @param IndexCollector $indexCollector
     */
    public function __construct(
        IndexCollector $indexCollector
    ) {
        $this->indexCollector = $indexCollector;
    }

    /**
     * @return array
     */
    public function getIndex()
    {
        $result = $this->indexCollector->getIndex();
        return $result;
    }
}
