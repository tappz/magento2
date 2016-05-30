<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Purchase;

use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Basket\BasketCollector as Basket;
use TmobLabs\Tappz\Model\Order\OrderCollector as OrderCollector;

/**
 * Class PurchaseCollector.
 */
class PurchaseCollector extends PurchaseFill
{
    /**
     * @var RequestHandler
     */
    protected $helper;
    /**
     * @var
     */
    protected $addressRepository;
    /**
     * @var Basket
     */
    protected $basketRepository;
    /**
     * @var
     */
    protected $objectManager;
    /**
     * @var OrderCollector
     */
    protected $orderCollector;

    /**
     * PurchaseCollector constructor.
     *
     * @param RequestHandler $requestHandler
     * @param Basket         $basketRepository
     * @param OrderCollector $orderCollector
     */
    public function __construct(
        RequestHandler $requestHandler,
        Basket $basketRepository,
        OrderCollector $orderCollector
    ) {
        $this->objectManager =
            \Magento\Framework\App\ObjectManager::getInstance();
        $this->helper = $requestHandler;
        $this->basketRepository = $basketRepository;
        $this->orderCollector = $orderCollector;
    }

    /**
     * @param $quoteId
     * @param $method
     *
     * @return array|void
     */
    public function getPurchase($quoteId, $method)
    {
        switch ($method) {
            case 'card':
                exit;
                $result = $this->purchaseCreditCards($quoteId);
                break;
            case 'threeD':
                $result = $this->purchaseThreeD($quoteId);
                break;
            case 'moneyTransfer':
                $result = $this->purchaseMoneyTransfer($quoteId);
                break;
            case 'cashOnDelivery':
                $result = $this->purchaseCashOnDelivery($quoteId);
                break;
            case 'paypal':
                $result = $this->purchasePaypal();
                break;
            case 'applepay':
                $result = $this->purchaseApplePay();
                break;
            default:
                $result = [];
                break;
        }

        return $result;
    }

    /**
     * @param $quoteId
     */
    public function purchaseCreditCards($quoteId)
    {
    }

    /**
     * @param $quoteId
     */
    public function purchaseThreeD($quoteId)
    {
    }

    /**
     * @param $quoteId
     */
    public function purchaseMoneyTransfer($quoteId)
    {
    }

    /**
     * @param $quoteId
     *
     * @return array
     */
    public function purchaseCashOnDelivery($quoteId)
    {
        $this->helper->getHeaderJson();
        $userId = $this->helper->getAuthorization();
        $quote = $this->basketRepository->getBasketQuoteById($quoteId);
        if ($quote->getCustomerEmail() == null) {
            $customerModel = $this->getUserViaUserId($userId);
            $quote->setCustomerId($userId)
                ->setCustomerEmail($customerModel->getEmail())
                ->setCustomerGroupId($customerModel->getGroupId())
                ->setCustomerFirstname($customerModel->getFirstname())
                ->setCustomerLastname($customerModel->getLastname())
                ->setCustomerIsGuest(false);
        }
        $shippingQuote = $quote->getShippingAddress();
        $shipmentMethod = $shippingQuote->getData('shipping_method');
        $quote->setShippingMethod($shipmentMethod);
        $shippingQuote->setCollectShippingRates(true)
            ->collectShippingRates()
            ->setShippingMethod($shipmentMethod);
        $quote->setPaymentMethod('cashondelivery');
        $quote->getPayment()->importData(['method' => 'cashondelivery']);
        $quote->setIsActive(true)
            ->collectTotals()
            ->save();
        $quote->getShippingMethod();
        $rate = $this->objectManager->get('Magento\Quote\Model\Quote\Address\Rate');
        $rate->setCode($shipmentMethod);
        $quote->getShippingAddress()->addShippingRate($rate);
        $quoteManagement = $this->objectManager
            ->create('\Magento\Quote\Model\QuoteManagement');
        $order = $quoteManagement->submit($quote);
        if ($order) {
            $order->setCustomerIsGuest(false);
            $result = $this->orderCollector->getOrderById($order->getID());

            return $result;
        }
    }

    /**
     * @param $userid
     *
     * @return mixed
     */
    public function getUserViaUserId($userid)
    {
        $store = $this->objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->objectManager->
        get('Magento\Customer\Model\Customer')->setStore($store);
        $customer->load($userid);

        return $customer;
    }

    /**
     *
     */
    public function purchasePaypal()
    {
    }

    /**
     *
     */
    public function purchaseApplePay()
    {
    }
}
