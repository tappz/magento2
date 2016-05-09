<?php

namespace TmobLabs\Tappz\Model\Basket;

use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Shipping\Model\Config as CarrierConfig;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Address\AddressRepository as AddressRepository;
use TmobLabs\Tappz\Model\Product\ProductRepository as ProductRepository;

class BasketCollector extends BasketFill
{

	protected $objectManager;
	protected $store;
	protected $productRepository;
	protected $addressRepository;
	protected $methodList;
	protected $configBasket;
	protected $shippingMethodConfig;
	protected $carrierConfig;

	public function __construct(
		RequestHandler $requestHandler,
		ProductRepository $productRepository,
		AddressRepository $addressRepository,
		\Magento\Payment\Model\MethodList $methodList,
		ScopeConfig $configBasket,
		\Magento\Shipping\Model\Config $shippingMethodConfig,
		CarrierConfig $carrierConfig
	) {
		$this->helper = $requestHandler;
		$this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$this->store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface');
		$this->productRepository = $productRepository;
		$this->addressRepository = $addressRepository;
		$this->methodList = $methodList;
		$this->configBasket = $configBasket;
		$this->shippingMethodConfig = $shippingMethodConfig;
		$this->carrierConfig = $carrierConfig;
	}

	public function merge()
	{
		$result = $this->helper->convertJson($this->helper->getHeaderJson());
		$anonymousBasketId = "";
		if (!empty($result)) {
			$anonymousBasketId = $result->basketId;
		}
		$userId = $this->helper->getAuthorization();
		$store = $this->store->getStore();
		if ($anonymousBasketId == "null" || empty($anonymousBasketId)) {
			return $this->getUserBasket();
		}

		$anonymousQuote = $this->objectManager
			->get('Magento\Quote\Model\Quote')
			->setStore($store)
			->load($anonymousBasketId);
		$quoteObject = $this->objectManager->get('Magento\Quote\Model\Quote')->setStore($store);
		$customer = $this->objectManager
			->get('Magento\Customer\Model\Customer')
			->setStore($store)
			->load($userId);
		$quote = $quoteObject->loadByCustomer($customer);
		if (is_null($quote->getId())) {
			$quote = $quote->setStoreId($store)
				->setIsActive(false)
				->setIsMultiShipping(false)
				->setCustomer($customer)
				->save();
		}
		$quote = $quote->merge($anonymousQuote);
		$quote = $quote->collectTotals()->save();

		return $this->getBasketById($quote->getId());
	}

	public function setAddress($quoteId)
	{

		$userId = $this->helper->getAuthorization();
		$result = $this->helper->convertJson($this->helper->getHeaderJson());
		$shippingAddressId = isset($result->shippingAddress->id) ? $result->shippingAddress->id : null;
		$billingAddressId = isset($result->billingAddress->id) ? $result->billingAddress->id : null;
		$shippingMethodId = isset($result->shippingMethod[0]->id) ? $result->shippingMethod[0]->id : null;

		$store = $this->store->getStore();
		$quote = $this->objectManager
			->get('Magento\Quote\Model\Quote')
			->setStore($store)
			->load($quoteId);
		if (!is_null($billingAddressId)) {
			$userAddress = $this->objectManager->get('Magento\Customer\Model\Address')->load($billingAddressId);
			$address = $this->objectManager->get('Magento\Quote\Model\Quote\Address')->setCustomerAddressData($userAddress);
			$quote->setBillingAddress($address);
		}
		if (!is_null($shippingAddressId)) {
			$userAddress = $this->objectManager->get('Magento\Customer\Model\Address')->load($shippingAddressId);
			$address = $this->objectManager->get('Magento\Quote\Model\Quote\Address')->setCustomerAddressData($userAddress);
			$quote->setShippingAddress($address)
				->setCollectShippingRates(true);
		}
		if (!is_null($shippingMethodId)) {

			$quoteShippingAddress = $quote->getShippingAddress();
			$rate = $quoteShippingAddress->collectShippingRates()->getShippingRateByCode($shippingMethodId);
			if (!$rate) {
				/**
				 * @todo dzgok set here dynamic error
				 */
			}
			$userAddress = $this->objectManager->get('Magento\Customer\Model\Address')->load($shippingAddressId);
			$address = $this->objectManager->get('Magento\Quote\Model\Quote\Address')->setCustomerAddressData($userAddress);
			$rate = $this->objectManager->get('Magento\Quote\Model\Quote\Address\Rate');
			$rate->setCode($shippingMethodId);
			$quote->setShippingAddress($address)->setShippingMethod($shippingAddressId)
				->setCollectShippingRates(true);

			$quote->getShippingAddress()->setShippingMethod($shippingMethodId);
			$quote->getShippingAddress()->getShippingMethod();



		}
		$quote->setTotalsCollectedFlag(false)->collectTotals()->save();
		return $this->getBasketById($quote->getId());

	}

	public function getLines($basketId)
	{
		$updateList = $this->helper->convertJson($this->helper->getHeaderJson());
		$store = $this->store->getStore();
		$quote = $this->objectManager
			->get('Magento\Quote\Model\Quote')
			->setStore($store)
			->load($basketId);
		foreach ($updateList->product as $item) {
			$productId = $item->productId;
			$qty = $item->quantity;
			$products[] = $qty;
			$product = $this->objectManager->get('Magento\Catalog\Model\Product')->load($productId);
			$quoteItem = $quote->getItemByProduct($product);
			if (!$quoteItem) {
				$quote->addProduct($product, $qty);
			} elseif ($qty == 0) {
				$quote->removeItem($quoteItem->getId());
			} else {
				$buyRequest = new \Magento\Framework\DataObject(array('qty' => $qty));
				$quote->updateItem($quoteItem->getId(), $buyRequest);
			}
		}
		$this->setAddress($quote->getID());
		$quote = $quote->collectTotals()->save();
		return $this->getBasketById($quote->getID());
	}

	public function getBasketById($basketId)
	{
		$store = $this->store->getStore();
		$quote = $this->objectManager
			->get('Magento\Quote\Model\Quote')
			->setStore($store)
			->load($basketId);
		return $this->setBasketByQuote($quote);
	}

	public function getBasketQuoteById($basketId)
	{
		$store = $this->store->getStore();
		$quote = $this->objectManager
			->get('Magento\Quote\Model\Quote')
			->setStore($store)
			->load($basketId);
		return $quote;
	}

	public function getUserBasket()
	{
		$userId = $this->helper->getAuthorization();

		$store = $this->store->getStore();
		$quoteObject = $this->objectManager->get('Magento\Quote\Model\Quote')->setStore($store);

		if (is_numeric($userId)) {
			$customer = $this->objectManager
				->get('Magento\Customer\Model\Customer')
				->setStore($store)
				->load($userId);
			$quote = $quoteObject->loadByCustomer($customer);
		} else {
			$quote = $quoteObject->save();
		}

		if (is_null($quote->getId())) {

			try {
				if (isset($userId) && $userId !== '') {
					$quote = $quoteObject->setCustomerId($userId);
				}
				$quote = $quote->save();
			} catch (Mage_Core_Exception $e) {
				$this->_fault('invalid_data', $e->getMessage());
			}
		}

		return $this->setBasketByQuote($quote);
	}

	public function setBasketByQuote($quote)
	{


		$this->setBasket((object)(array()));
		$this->setId($quote->getId());
		$this->setShippingMethods($this->getShippingsMethodByBasket());
		$this->setShippingMethod($this->getShippingByBasket($quote));
		$this->setCurrency($this->store->getStore()->getCurrentCurrency()->getCode());
		$this->setLine($this->getLinesByBasket($quote));
		$this->setDelivery($this->getDeliveryByBasket($quote));
		$this->setShippingTotal($this->getShippingTotalByBasket($quote));
		$this->setDiscountTotal($this->getDiscountTotalByBasket($quote));
		$this->setPaymentOptions($this->getPaymentMethodsByBasket($quote));
		$this->setPayment($this->getPaymentByBasket($quote));
		$this->setItemsPriceTotal($this->getItemPriceTotalByBasket($quote));
		$this->setSubTotal($this->getItemSubTotalByBasket($quote));
		$this->setBeforeTaxTotal($this->getBeforeTaxTotalByBasket($quote));
		$this->setTaxTotal($this->getTaxTotalByBasket($quote));
		$this->setTotal($this->getTotalByBasket($quote));
		$this->setErrors($this->getErrorsByBasket());
		$this->setGiftCheques($this->getGiftChequesByBasket());
		$this->setSpentGiftChequeTotal($this->getSpentGiftChequeByBasket($quote));
		$this->setDiscounts($this->getDiscountsByBasket($quote));
		$this->setUsedPoints($this->getUsedPointsBasket());
		$this->setUsedPointsAmount($this->getUsedPointsAmountByBasket());
		$this->setRewardPoints($this->getRewardPointsByBasket());
		$this->setPaymentFee($this->getPaymentFeeByBasket());
		$this->setEstimatedSupplyDate($this->getEstimatedSupplyDateByBasket());
		$this->setIsGiftWrappingEnabled(false);
		$this->setGiftWrapping(null);
		$this->setExpirationTime(0);
		$this->setErrorCode(null);
		$this->setMessage(null);
		$this->setUserFriendly(false);
		return $this->fillBasket();
	}

	public function getDiscountsByBasket($quote)
	{
		$result = array();
		$amountDiscount = $this->getDiscountAmountByBasket($quote);
		if ($amountDiscount > 0) {
			$this->setDiscountDisplayName(null);
			$this->setDiscountTotal($this->getDiscountAmountByBasket($quote));
			$this->setDiscountPromoCode($amountDiscount);
			$result[] = ($this->fillDiscounts());
		}
		return $result;
	}

	public function getIsGiftWrappingEnabledByBasket($isGiftWrapping = false)
	{
		return $isGiftWrapping;
	}

	public function getEstimatedSupplyDateByBasket($supplyDate = null)
	{
		return $supplyDate;
	}

	public function getPaymentFeeByBasket($fee = 0)
	{
		return $fee;
	}

	public function getRewardPointsByBasket($points = 0)
	{
		return $points;
	}

	public function getUsedPointsBasket($points = 0)
	{
		return $points;
	}

	public function getUsedPointsAmountByBasket($pointsAmount = 0)
	{
		return $pointsAmount;
	}

	public function getDiscountAmountByBasket($quote)
	{
		$result = $quote->getShippingAddress()->getData('discount_amount');
		if (empty($result) == 0) {
			$result = floatval($quote->getData('subtotal')) - floatval($quote->getData('subtotal_with_discount'));
		}
		return number_format($result, 2);
	}

	public function getSpentGiftChequeByBasket($quote)
	{
		$giftCardsAmounts = $quote->getData('gift_cards_amount');
		return $giftCardsAmounts == null ? 0 : $giftCardsAmounts;

	}

	public function getGiftChequesByBasket($cheques = array())
	{
		return $cheques;
	}

	public function getErrorsByBasket($errors = array())
	{
		return $errors;
	}

	public function getTotalByBasket($quote)
	{
		$grandTotal = $quote->getData('grand_total');
		return $grandTotal == null ? 0 : number_format($grandTotal, 2);
	}

	public function getTaxTotalByBasket($quote)
	{
		return 0;
	}

	public function getBeforeTaxTotalByBasket($quote)
	{
		return 0;
	}

	public function getItemPriceTotalByBasket($quote)
	{
		$baseTotal = number_format($quote->getData('base_subtotal'), 2);
		return $baseTotal == null ? 0 : $baseTotal;
	}

	public function getItemSubTotalByBasket($quote)
	{

		$subTotal = $quote->getData('subtotal');
		return $subTotal == null ? 0 : number_format($subTotal, 2);
	}

	public function getPaymentMethodsByBasket($quote)
	{
		$paymentOptions = array();
		$methods = $this->methodList->getAvailableMethods($quote);
		foreach ($methods as $method) {
			$code = $method->getCode();
			/**
			 * @todo dzgok I already wrote setters and getters
			 */

			if (($code == 'creditCard')) {
				$paymentOptions['creditCard'] = array();
				$paymentOptions['creditCard'][0]['image'] = null;
				$paymentOptions['creditCard'][0]['displayName'] = 'Default Credit Card';
				$paymentOptions['creditCard'][0]['type'] = "creditcards";
				$paymentOptions['creditCard'][0]['installmentNumber'] = 0;
				$paymentOptions['creditCard'][0]['installments'] = array();
			} elseif ($code == 'checkmo') {
				$paymentOptions['moneyTransfer'] = array();
				$paymentOptions['moneyTransfer'][0]['id'] = $code;
				$paymentOptions['moneyTransfer'][0]['displayName'] = $method->getTitle();
				$paymentOptions['moneyTransfer'][0]['code'] = $code;
				$paymentOptions['moneyTransfer'][0]['branch'] = ' ';
				$paymentOptions['moneyTransfer'][0]['accountNumber'] = ' ';
				$paymentOptions['moneyTransfer'][0]['iban'] = ' ';
				$paymentOptions['moneyTransfer'][0]['imageUrl'] = '';

			} elseif ($code == 'cashondelivery') {

				$paymentOptions['cashOnDelivery'][0]['type'] = null;
				$paymentOptions['cashOnDelivery'][0]['displayName'] = null;
				$paymentOptions['cashOnDelivery'][0]['additionalFee'] = null;
				$paymentOptions['cashOnDelivery'][0]['description'] = null;
				$paymentOptions['cashOnDelivery'][0]['isSMSVerification'] = false;
				$paymentOptions['cashOnDelivery'][0]['SMSCode'] = null;
				$paymentOptions['cashOnDelivery'][0]['PhoneNumber'] = null;
				$paymentOptions['cashOnDelivery'][0]['type'] = $code;
				$paymentOptions['cashOnDelivery'][0]['displayName'] = $method->getTitle();
				$paymentOptions['cashOnDelivery'][0]['additionalFee'] = '0';
				$paymentOptions['cashOnDelivery'][0]['description'] = 'Cash on delivery description text';
				$paymentOptions['cashOnDelivery'][0]['isSMSVerification'] = false;
				$paymentOptions['cashOnDelivery'][0]['SMSCode'] = null;
				$paymentOptions['cashOnDelivery'][0]['PhoneNumber'] = null;
			} elseif ($code == 'paypal_express') {
				$paymentOptions['paypal'] = array();
				$paymentOptions['paypal']['clientId'] = null;
				$paymentOptions['paypal']['displayName'] = null;
				$paymentOptions['paypal']['isSandbox'] = 'true';
				$paymentOptions['paypal']['clientId'] = null;
				$paymentOptions['paypal']['displayName'] = $method->getTitle();
				$paymentOptions['paypal']['isSandbox'] = (bool)$this->configBasket->getValue('tappzpaypal/tappzpaypalmethod/paypalSandbox/');
			}

		}

		return $paymentOptions;
	}

	public function getBasketContract($quote)
	{
		$this->setContract(null);

		$this->setBasket((object)(array()));
		$this->setContractData("Set Your Contract Here");
		$this->setShippingContract("Set Your Shipping  Contract Here");
		$this->setErrorCode(null);
		$this->setMessage(null);
		$this->setUserFriendly(false);
		return $this->fillContract();
	}

	public function getPaymentByBasket($quote)
	{
		$result = null;
		$payment = $quote->getPayment();
		if (isset($payment)) {
			$paymentData = array();
			$paymentData['cashOnDelivery'] = null;
			$paymentData['creditCard'] = null;
			$method = $payment->getData('method');
			if (empty($method)) {
				return $result;
			}
			if ($method == 'checkmo') {
				$paymentData['methodType'] = 'MoneyTransfer';
				$paymentData['type'] = $method;
				$paymentData['displayName'] = 'Check / Money Order';
				$paymentData['bankCode'] = null;
				$paymentData['installment'] = null;
				$paymentData['accountNumber'] = '123456'; // TODO
				$paymentData['branch'] = '321'; // TODO
				$paymentData['iban'] = 'TR12 3456 7890 1234 5678 9012 00';
			} else {
				if ($method == "creditcard") {
					$paymentData['methodType'] = 'CreditCard';
					$paymentData['type'] = $payment->getData('cc_type');
					$paymentData['displayName'] = 'Credit Card';
					$paymentData['bankCode'] = null;
					$paymentData['installment'] = null;
					$paymentData['accountNumber'] = '**** **** **** ' . $payment->getData('cc_last4');
					$paymentData['branch'] = null;
					$paymentData['iban'] = null;
					$paymentData['creditCard'] = array();
					$paymentData['creditCard']['owner'] = null;
					$paymentData['creditCard']['number'] = '**** **** **** ' . $payment->getData('cc_last4');
					$paymentData['creditCard']['month'] = null;
					$paymentData['creditCard']['year'] = null;
					$paymentData['creditCard']['cvv'] = null;
					$paymentData['creditCard']['type'] = $payment->getData('cc_type');
				} else {
					if ($method == 'cashondelivery') {
						$paymentData['methodType'] = 'CashOnDelivery';
						$paymentData['type'] = $method;
						$paymentData['displayName'] = 'Cash on Delivery';
						$paymentData['bankCode'] = null;
						$paymentData['installment'] = null;
						$paymentData['accountNumber'] = null;
						$paymentData['branch'] = null;
						$paymentData['iban'] = null;
						$paymentData['cashOnDelivery'] = array();
						$paymentData['cashOnDelivery']['type'] = $method;
						$paymentData['cashOnDelivery']['displayName'] = 'Cash on Delivery';
						$paymentData['cashOnDelivery']['additionalFee'] = null;
						$paymentData['cashOnDelivery']['description'] = 'Cash on delivery description.'; // TODO
						$paymentData['cashOnDelivery']['isSMSVerification'] = false;
						$paymentData['cashOnDelivery']['SMSCode'] = null;
						$paymentData['cashOnDelivery']['PhoneNumber'] = null;
					} else {
						if ($method == 'paypal_express') {
							$paymentData['methodType'] = 'PayPal';
							$paymentData['type'] = $method;
							$paymentData['displayName'] = 'PayPal';
							$paymentData['bankCode'] = null;
							$paymentData['installment'] = null;
							$paymentData['accountNumber'] = null;
							$paymentData['branch'] = null;
							$paymentData['iban'] = null;
						} else {
							if ($method == 'stripe') {
								$paymentData['methodType'] = 'ApplePay';
								$paymentData['type'] = $method;
								$paymentData['displayName'] = 'Apple Pay';
								$paymentData['bankCode'] = null;
								$paymentData['installment'] = null;
								$paymentData['accountNumber'] = null;
								$paymentData['branch'] = null;
								$paymentData['iban'] = null;
							}
						}
					}
				}
			}

		}

		return $paymentData;
	}

	public function getBasketPayment($quoteId)
	{

		$result = $this->helper->convertJson($this->helper->getHeaderJson());
		$store = $this->store->getStore();
		$quote = $this->objectManager
			->get('Magento\Quote\Model\Quote')
			->setStore($store)
			->load($quoteId);
		$paymentMethod = "";
		switch ($result->methodType) {
			case "CreditCards":

				break;
			case "CashOnDelivery":
				$paymentMethod = "cashondelivery";
				break;

			case "PayPal":
				$paymentMethod = "paypal_express";
				break;
			case "MoneyTransfer":
				$paymentMethod = "checkmo";
				break;

			case "ApplePay":
				$paymentMethod = "stripe";
				break;
		}

		if ($quote->isVirtual()) {
			if (is_null($quote->getBillingAddress()->getId())) {
				$this->_fault('invalid_data', 'billing_address_is_not_set');
			}
			$quote->getBillingAddress()->setPaymentMethod(
				isset($paymentData['method']) ? $paymentData['method'] : null
			);
		} else {
			if (is_null($quote->getShippingAddress()->getId())) {
				$this->_fault('invalid_data', 'shipping_address_is_not_set');
			}
			$quote->getShippingAddress()->setPaymentMethod(
				isset($paymentData['method']) ? $paymentData['method'] : null
			);
		}
		if (!$quote->isVirtual() && $quote->getShippingAddress()) {
			$quote->getShippingAddress()->setCollectShippingRates(true);
		}
		if (!$quote->isVirtual() && $quote->getShippingAddress()) {
			$quote->getShippingAddress()->setCollectShippingRates(true);
		}

		$total = number_format($quote->getBaseSubtotal(), 2);
		$methods = Mage::helper('payment')->getStoreMethods($quote->getStoreId(), $quote);
		foreach ($methods as $method) {
			if ($method->getCode() == $paymentData['method']) {
				/** @var $method Mage_Payment_Model_Method_Abstract */
				if (!($this->_canUsePaymentMethod($method, $quote)
					&& ($total != 0
						|| $method->getCode() == 'free'
						|| ($quote->hasRecurringItems() && $method->canManageRecurringProfiles())))
				) {
					$this->_fault('invalid_data', "method_not_allowed");
				}
			}
		}
		try {
			$payment = $quote->getPayment();
			$payment->importData($paymentData);
			$quote = $quote->setIsActive(true)
				->setTotalsCollectedFlag(false)
				->collectTotals()
				->save();
		} catch (Mage_Core_Exception $e) {
			$this->_fault('invalid_data', $e->getMessage());
		}
		$payment = $quote->getPayment();
		$method = array("method" => $paymentMethod);
		$payment->importData($method);
		$quote = $quote->setIsActive(true)
			->setTotalsCollectedFlag(false)
			->collectTotals()
			->save();


		return $this->setBasketByQuote($quote);
	}

	/**
	 * @param $quote
	 * @return mixed
	 */
	public function getDeliveryByBasket($quote)
	{
		$quoteBillingAddress = $quote->getBillingAddress();
		$quoteShippingAddress = $quote->getShippingAddress();

		if ($quoteBillingAddress) {
			$delivery['billingAddress'] = $this->addressRepository->getAddress($quoteShippingAddress->getID());
		}
		if ($quoteShippingAddress) {
			$delivery['shippingAddress'] = $this->addressRepository->getAddress($quoteShippingAddress->getID());
			$method = $quoteShippingAddress->getData('shipping_method');
			if (!empty($method)) {
				$delivery['shippingMethod'][0]['id'] = $quoteShippingAddress->getData('shipping_method');
				$delivery['shippingMethod'][0]['displayName'] = $quoteShippingAddress->getData('shipping_description');
				$delivery['shippingMethod'][0]['trackingAddress'] = null;
				$delivery['shippingMethod'][0]['price'] = $quoteShippingAddress->getData('shipping_incl_tax');
				$delivery['shippingMethod'][0]['priceForYou'] = null;
				$delivery['shippingMethod'][0]['shippingMethodType'] = $quoteShippingAddress->getData('shipping_method');
				$delivery['shippingMethod'][0]['imageUrl'] = null;
			}
		}

		if (is_null($delivery['shippingAddress']['id'])) {
			$delivery = (object)array();
		}

		return $delivery;
	}

	public function getDiscountTotalByBasket($quote)
	{
		$quoteShippingAddress = $quote->getShippingAddress();
		$result = $quoteShippingAddress->getData('discount_amount');
		return $result == null ? 0 : $result;
	}

	public function getShippingTotalByBasket($quote)
	{
		$quoteShippingAddress = $quote->getShippingAddress();
		$result = $quoteShippingAddress->getData('discount_amount');
		return $result == null ? 0 : $result;
	}

	public function getShippingByBasket($quote)
	{
		$shipping = array();
		$quoteShippingAddress = $quote->getShippingAddress();
		if ($quoteShippingAddress) {
			$method = $quoteShippingAddress->getData('shipping_method');
			if (!empty($method)) {
				$shipping[0]['id'] = $quoteShippingAddress->getData('shipping_method');
				$shipping[0]['displayName'] = $quoteShippingAddress->getData('shipping_description');
				$shipping[0]['trackingAddress'] = null;
				$shipping[0]['price'] = $quoteShippingAddress->getData('shipping_incl_tax');
				$shipping[0]['priceForYou'] = null;
				$shipping[0]['shippingMethodType'] = $quoteShippingAddress->getData('shipping_method');
				$shipping[0]['imageUrl'] = null;
			}
		}
		return $shipping;
	}
	public function getShippingsMethodByBasket()
	{

		$carriers = $this->carrierConfig->getActiveCarriers();
		$shippingMethods = array();
		foreach ($carriers as $carrierCode => $carrierModel) {
			$carrierTitle = $this->configBasket->getValue(
				'carriers/' . $carrierCode . '/title',
				\Magento\Store\Model\ScopeInterface::SCOPE_STORE
			);
			$carrierPrice = $this->configBasket->getValue(
				'carriers/' . $carrierCode . '/price',
				\Magento\Store\Model\ScopeInterface::SCOPE_STORE
			);
			$rateItem['id'] = $carrierCode;
			$rateItem['displayName'] = $carrierTitle;
			$rateItem['trackingAddress'] = null;
			$rateItem['price'] = is_null($carrierPrice) ? 0 : $carrierPrice;
			$rateItem['priceForYou'] = null;
			$rateItem['shippingMethodType'] = $carrierCode;
			$rateItem['imageUrl'] = null;
			$shippingMethods[] = $rateItem;
		}
		return $shippingMethods;

	}

	public function getLinesByBasket($quote)
	{
		$lines = array();

		foreach ($quote->getAllVisibleItems() as $item) {

			$this->setProductId($item->getData('product_id'));
			$this->setProduct($this->productRepository->getById($item->getData('product_id')));
			$this->setQuantity($item->getData('qty'));
			$this->setPlacedPrice(number_format($item->getData('price'), 2));
			$this->setPlacedPriceTotal(number_format($item->getData('row_total'), 2));
			$this->setExtendedPrice(number_format($item->getData('price'), 2));
			$this->setExtendedPriceValue(number_format($item->getData('price'), 2));
			$this->setExtendedPriceTotal(number_format($item->getData('price'), 2));
			$this->setExtendedPriceTotalValue(number_format($item->getData('price'), 2));
			$this->setStatus(0);
			$this->setStrikeoutPrice($this->getProduct()['strikeoutPrice']);
			$this->setAverageDeliveryDays("");
			$this->setVariants($this->getProduct()['variants']);
			$lines[] = $this->fillLines();
		}

		return $lines;
	}

}
