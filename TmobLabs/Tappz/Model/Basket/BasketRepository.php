<?php

namespace TmobLabs\Tappz\Model\Basket;

use TmobLabs\Tappz\API\BasketRepositoryInterface;

class BasketRepository implements BasketRepositoryInterface {

    private $basketCollector;

    public function __construct(
    BasketCollector $basketCollector
    ) {
        $this->basketCollector = $basketCollector;
    }

    public function getByBasketById($basketId) {
        $result = $this->basketCollector->getBasketById($basketId);
        return $result;
    }

    public function getUserBasket() {
        $result = $this->basketCollector->getUserBasket();
        return $result;
    }

    public function getLines($quoteId = null) {
        $result = $this->basketCollector->getLines($quoteId);
        return $result;
    }
    public function getAddress($quoteId = null) {
        $result = $this->basketCollector->setAddress($quoteId);
        return $result;
    }
    public function merge() {
        $result = $this->basketCollector->merge();
        return $result;
    }
}
