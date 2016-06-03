<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Basket;

use TmobLabs\Tappz\API\BasketRepositoryInterface;
use TmobLabs\Tappz\Model\Purchase\PurchaseCollector;

/**
 * Class BasketRepository.
 */
class BasketRepository implements BasketRepositoryInterface
{
    /**
     * @var BasketCollector
     */
    private $_basketCollector;
    /**
     * @var PurchaseCollector
     */
    private $_purchaseCollector;

    /**
     * BasketRepository constructor.
     *
     * @param BasketCollector   $basketCollector
     * @param PurchaseCollector $purchaseCollector
     */
    public function __construct(
        BasketCollector $basketCollector,
        PurchaseCollector $purchaseCollector
    ) {
        $this->_basketCollector = $basketCollector;
        $this->_purchaseCollector = $purchaseCollector;
    }

    /**
     * @param $basketId
     *
     * @return array
     */
    public function getByBasketById($basketId)
    {
        $result = $this->_basketCollector->getBasketById($basketId);

        return $result;
    }

    /**
     * @return array
     */
    public function getUserBasket()
    {
        $result = $this->_basketCollector->getUserBasket();

        return $result;
    }

    /**
     * @param $quoteId
     *
     * @return array
     */
    public function getPayment($quoteId)
    {
        $result = $this->_basketCollector->getBasketPayment($quoteId);

        return $result;
    }

    /**
     * @param null $quoteId
     *
     * @return array
     */
    public function getLines($quoteId = null)
    {
        $result = $this->_basketCollector->getLines($quoteId);

        return $result;
    }

    /**
     * @param null $quoteId
     *
     * @return array
     */
    public function getAddress($quoteId = null)
    {
        $result = $this->_basketCollector->setAddress($quoteId);

        return $result;
    }

    /**
     * @param null $quoteId
     *
     * @return array
     */
    public function getContract($quoteId = null)
    {
        $result = $this->_basketCollector->getBasketContract($quoteId);

        return $result;
    }

    /**
     * @param $quoteId
     * @param $method
     *
     * @return array|void
     */
    public function getPurchase($quoteId, $method)
    {
        $result = $this->_purchaseCollector->getPurchase($quoteId, $method);

        return $result;
    }

    /**
     * @return array
     */
    public function merge()
    {
        $result = $this->_basketCollector->merge();

        return $result;
    }
}
