<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Purchase;

use TmobLabs\Tappz\API\PurchaseRepositoryInterface;

/**
 * Class PurchaseRepository.
 */
class PurchaseRepository implements PurchaseRepositoryInterface
{
    /**
     * @var PurchaseCollector
     */
    private $purchaseCollector;

    /**
     * PurchaseRepository constructor.
     *
     * @param PurchaseCollector $purchaseCollector
     */
    public function __construct(
        PurchaseCollector $purchaseCollector
    ) {
        $this->purchaseCollector = $purchaseCollector;
    }
}
