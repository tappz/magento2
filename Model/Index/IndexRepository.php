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
    private $_indexCollector;

    /**
     * IndexRepository constructor.
     *
     * @param IndexCollector $indexCollector
     */
    public function __construct(
        IndexCollector $indexCollector
    ) {
        $this->_indexCollector = $indexCollector;
    }

    /**
     * @return array
     */
    public function getIndex()
    {
        $result = $this->_indexCollector->getIndex();
        return $result;
    }
}
