<?php

namespace TmobLabs\Tappz\Model\Purchase;

use TmobLabs\Tappz\API\PurchaseRepositoryInterface;

class PurchaseRepository implements PurchaseRepositoryInterface {

    private $purchaseCollector;

    public function __construct(
    PurchaseCollector $purchaseCollector
    ) {
        $this->purchaseCollector = $purchaseCollector;
    }



}
