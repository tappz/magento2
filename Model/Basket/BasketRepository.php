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
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
/**
 * Class BasketRepository.
 */
class BasketRepository implements BasketRepositoryInterface
{
    /**
     * @var BasketCollector
     */
    private $basketCollector;
    /**
     * @var PurchaseCollector
     */
    private $purchaseCollector;

    /**
     * BasketRepository constructor.
     *
     * @param BasketCollector $basketCollector
     * @param PurchaseCollector $purchaseCollector
     */
    public function __construct(
        BasketCollector $basketCollector,
        PurchaseCollector $purchaseCollector,
        RequestHandler $helper
    ) {
        $this->basketCollector = $basketCollector;
        $this->purchaseCollector = $purchaseCollector;
        $this->helper = $helper;
    }

    /**
     * @param $basketId
     *
     * @return array
     */
    public function getByBasketById($basketId)
    {

        $result = $this->basketCollector->getBasketById($basketId);

        return $result;
    }

    /**
     * @return array
     */
    public function getUserBasket()
    {
        $result = $this->basketCollector->getUserBasket();



        return $result;
    }

    /**
     * @param $quoteId
     *
     * @return array
     */
    public function getPayment($quoteId)
    {
        $result = [];
        $method = $this->helper->getRequestMethod();
        switch ($method) {
            case 'GET':
                $result = $this->basketCollector->getBasketPayment($quoteId);
                break;
            case 'POST':
                $result = $this->basketCollector->setBasketPayment($quoteId);
                break;
            default:
                break;
        }
        return $result;
    }
    /**
     * @param $quoteId
     *
     * @return array
     */
    public function getPay($quoteId)
    {
        $result = $this->helper->convertJson($this->helper->getHeaderJson());

        $result = [];
        $method = $this->helper->getRequestMethod();
        switch ($method) {
            case 'GET':
                $result = $this->basketCollector->getBasketPayment($quoteId);
                break;
            case 'POST':
                $result = $this->getPurchase($quoteId);
                // $result = $this->basketCollector->setBasketPay($quoteId);
                break;
            default:
                break;
        }
        return $result;
    }
    /**
     * @param null $quoteId
     *
     * @return array
     */
    public function getLines($quoteId = null)
    {

        $result = $this->basketCollector->getLines($quoteId);

        return $result;
    }

    /**
     * @param null $quoteId
     *
     * @return array
     */
    public function getAddress($quoteId = null)
    {
        $result = $this->basketCollector->setAddress($quoteId);

        return $result;
    }

    /**
     * @param null $quoteId
     *
     * @return array
     */
    public function getContract()
    {
        $result = $this->basketCollector->getBasketContract();

        return $result;
    }
    public function getGiftWrapping($basketId){
        $result = $this->basketCollector->getBasketById($basketId);

        return $result;


    }
    /**
     * @param $quoteId
     * @param $method
     *
     * @return array|void
     */
    public function getPurchase($quoteId)
    {

        $quote = $this->basketCollector->getQuoteById($quoteId);
        $methodTypes = $this->basketCollector->getPaymentByBasket($quote);
        $method  = $methodTypes['methodType'];

        $result = $this->purchaseCollector->getPurchase($quoteId, $method);
        return $result;
    }

    /**
     * @return array
     */
    public function merge()
    {
        $result = $this->basketCollector->merge();

        return $result;
    }
    public function getShipment($quoteId = null){
        $method = $this->helper->getRequestMethod();
        $result = [];
        switch ($method) {
            case 'GET':
                $result['shippingMethods']  = $this->basketCollector->getShippingsMethodByBasket();
                break;
            case 'POST':
                $result = $this->basketCollector->setAddressToBasket($quoteId);
                break;
            default:
                break;
        }
        return $result;
    }
}
