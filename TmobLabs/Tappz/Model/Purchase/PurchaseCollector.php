<?php

namespace TmobLabs\Tappz\Model\Purchase;

use Magento\Store\Model\StoreManagerInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Basket\BasketCollector as Basket;

class PurchaseCollector extends PurchaseFill
{

	protected $helper;
	protected $addressRepository;
	protected $basketRepository;
	protected $objectManager;

	public function __construct(
		RequestHandler $requestHandler,
		Basket $basketRepository
	) {
		$this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$this->helper = $requestHandler;
		$this->basketRepository = $basketRepository;
	}

	public function getPurchase($quoteId, $method)
	{
		exit;
		switch ($method) {
			case "card":
				exit;
				$result = $this->purchaseCreditCards($quoteId);
				break;
			case "threeD":
				$result = $this->purchaseThreeD($quoteId);
				break;
			case "moneyTransfer":
				$result = $this->purchaseMoneyTransfer($quoteId);
				break;
			case "cashOnDelivery":
				$result = $this->purchaseCashOnDelivery($quoteId);
				break;
			case "paypal":
				$result = $this->purchasePaypal();
				break;
			case "applepay":
				$result = $this->purchaseApplePay();
				break;
			default:
				$result = array();
				break;
		}

		return $result;

	}

	public function purchaseCreditCards($quoteId)
	{

	}

	public function purchaseThreeD($quoteId)
	{

	}

	public function purchaseMoneyTransfer($quoteId)
	{

	}

	public function purchaseCashOnDelivery($quoteId)
	{
		exit;
		$quote = $this->basketRepository->getBasketQuoteById($quoteId);
		$quoteManagement = $this->objectManager
			->get('\Magento\Quote\Model\QuoteManagement');

		$order = $quoteManagement->submit($quote);

		exit;
	}

	public function purchasePaypal()
	{

	}

	public function purchaseApplePay()
	{

	}

	public function setPurchase()
	{

		$this->setPurchaseId();
		$this->setTrackingNumber();
		$this->setOrderDate();
		$this->setShippingStatus();
		$this->setPaymentStatus();
		$this->setIpAddress();
		$this->setLines();
		$this->setDelivery();
		$this->setPayment();
		$this->setCurrency();
		$this->setItemsPriceTotal();
		$this->setDiscountTotal();
		$this->setSubtotal();
		$this->setShippingTotal();
		$this->setTotal();
		$this->setTaxTotalValue();
		$this->setShippingTotalValue();
		$this->setTotalValue();
		$this->setCanChangeAddress();
		$this->setErrorCode();
		$this->setMessage();
		$this->setUserFriendly();

	}

}
