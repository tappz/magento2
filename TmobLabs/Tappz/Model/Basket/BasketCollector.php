<?php

namespace TmobLabs\Tappz\Model\Basket;

use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Product\ProductRepository as ProductRepository;
use TmobLabs\Tappz\Model\Address\AddressRepository as AddressRepository;
use \Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig ;
use Magento\Shipping\Model\Config as CarrierConfig;

class BasketCollector extends BasketFill {

    protected $objectManager;
    protected $store;
    protected $productRepository;
    protected $addressRepository;
    protected $methodList;
    protected $configBasket ;
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

    public function merge() {
        $result = $this->helper->convertJson($this->helper->getHeaderJson());
        $anonymousBasketId = "";
        if(!empty($result))
        $anonymousBasketId = $result->basketId;
        $userId = $this->helper->getAuthorization();
        $store = $this->store->getStore();
        if($anonymousBasketId == "null" || empty($anonymousBasketId)){
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
    public function setAddress($quoteId){
        $result = $this->helper->convertJson($this->helper->getHeaderJson());
        $shippingAddressId = isset($result->shippingAddress->id)?$result->shippingAddress->id:null ;
        $billingAddressId =  isset($result->billingAddress->id)?$result->shippingAddress->id:null;
        $store = $this->store->getStore();
        $quote = $this->objectManager
            ->get('Magento\Quote\Model\Quote')
            ->setStore($store)
            ->load($quoteId);

        if (!is_null($billingAddressId) ) {
            $userAddress = $this->objectManager->get('Magento\Customer\Model\Address')->load($billingAddressId);

            $address = $this->objectManager->get('Magento\Quote\Model\Quote\Address')->setCustomerAddressData($userAddress);

            $customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store)->load($userAddress->getCustomer()->getId());

            $quote->setBillingAddress($address)
                ->getShippingAddress()
                ->setCollectShippingRates(true);
        }
        if (!is_null($shippingAddressId) ) {
            $userAddress = $this->objectManager->get('Magento\Customer\Model\Address')->load($shippingAddressId);
            $address = $this->objectManager->get('Magento\Quote\Model\Quote\Address')->setCustomerAddressData($userAddress);
            $customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store)->load($userAddress->getCustomer()->getId());

            $quote->setShippingAddress($address);
        }
        $quote->setTotalsCollectedFlag(false)->collectTotals()->save();
        return $this->getBasketById($quote->getId());

    }
    public function getLines($basketId) {
        $updateList = $this->helper->convertJson($this->helper->getHeaderJson());
        $store = $this->store->getStore();
        $quote = $this->objectManager
                ->get('Magento\Quote\Model\Quote')
                ->setStore($store)
                ->load($basketId);
        $i = 0;
        foreach ($updateList as $key => $item) {
            $productId = $item[$i]->productId;
            $qty = $item[$i]->quantity;
            $product = $this->objectManager->get('Magento\Catalog\Model\Product')->load($productId);
            $quoteItem = $quote->getItemByProduct($product);
            if (!$quoteItem) {
                $quote->addProduct($product, $qty);
            } elseif ($qty == 0) {
                $quote->removeItem($quoteItem->getId());
            } else {

                $quote->updateItem($quoteItem->getId(), $qty);
            }
            $i++;
        }
        $quote->setTotalsCollectedFlag(false)->collectTotals()->save();
        return $this->setBasketByQuote($quote);
    }

    public function getBasketById($basketId) {
        $store = $this->store->getStore();
        $quote = $this->objectManager
                ->get('Magento\Quote\Model\Quote')
                ->setStore($store)
                ->load($basketId);
        return $this->setBasketByQuote($quote);
    }

    public function getUserBasket() {
        $userId = $this->helper->getAuthorization();

        $store = $this->store->getStore();
        $quoteObject = $this->objectManager->get('Magento\Quote\Model\Quote')->setStore($store);

        if (is_numeric($userId)) {
            $customer = $this->objectManager
                ->get('Magento\Customer\Model\Customer')
                ->setStore($store)
                ->load($userId);
            $quote = $quoteObject->loadByCustomer($customer);
        }else{
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

    public function setBasketByQuote($quote) {



        $this->setBasket((object) (array()));
        $this->setId($quote->getId());
        $this->setShippingMethods($this->getShippingMethodByBasket($quote));
        $this->setCurrency($this->store->getStore()->getCurrentCurrency()->getCode());
        $this->setLine($this->getLinesByBasket($quote));
        $this->setDelivery($this->getDeliveryByBasket($quote));
        $this->setShippingTotal($this->getShippingTotalByBasket($quote));
        $this->setDiscountTotal($this->getDiscountTotalByBasket($quote));
        $this->setPaymentOptions($this->getPaymentMethodsByBasket($quote));
        $this->setPayment( $this->getPaymentByBasket($quote));
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

    public function getDiscountsByBasket($quote) {
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

    public function getIsGiftWrappingEnabledByBasket($isGiftWrapping = false) {
        return $isGiftWrapping;
    }

    public function getEstimatedSupplyDateByBasket($supplyDate = null) {
        return $supplyDate;
    }

    public function getPaymentFeeByBasket($fee = 0) {
        return $fee;
    }

    public function getRewardPointsByBasket($points = 0) {
        return $points;
    }

    public function getUsedPointsBasket($points = 0) {
        return $points;
    }

    public function getUsedPointsAmountByBasket($pointsAmount = 0) {
        return $pointsAmount;
    }

    public function getDiscountAmountByBasket($quote) {
        $result = $quote->getShippingAddress()->getData('discount_amount');
        if (empty($result) == 0) {
            $result = floatval($quote->getData('subtotal')) - floatval($quote->getData('subtotal_with_discount'));
        }
        return $result;
    }

    public function getSpentGiftChequeByBasket($quote) {
        $giftCardsAmounts = $quote->getData('gift_cards_amount');
        return $giftCardsAmounts== null ? 0: $giftCardsAmounts;

    }

    public function getGiftChequesByBasket($cheques = array()) {
        return $cheques;
    }

    public function getErrorsByBasket($errors = array()) {
        return $errors;
    }

    public function getTotalByBasket($quote) {
        $grandTotal = $quote->getData('grand_total');
        return $grandTotal== null ? 0: $grandTotal;
    }

    public function getTaxTotalByBasket($quote) {
        return 0;
    }

    public function getBeforeTaxTotalByBasket($quote) {
        return 0;
    }

    public function getItemPriceTotalByBasket($quote) {
        $baseTotal = $quote->getData('base_subtotal');
        return $baseTotal== null ? 0: $baseTotal;
    }

    public function getItemSubTotalByBasket($quote) {

        $subTotal = $quote->getData('subtotal');
        return $subTotal== null ? 0: $subTotal;
    }

    public function getPaymentMethodsByBasket($quote) {
        $paymentOptions = array();
        $methods = $this->methodList->getAvailableMethods($quote);
        foreach ($methods as $method) {
            $code = $method->getCode();
            /**
             * @todo dzgok I already wrote setters and getters
             */
            if (($code  == 'creditCard')) {
                $paymentOptions['creditCard'] = array();
                $paymentOptions['creditCard'][0]['image'] = null;
                $paymentOptions['creditCard'][0]['displayName'] = 'Default Credit Card';
                $paymentOptions['creditCard'][0]['type'] = "creditcards";
                $paymentOptions['creditCard'][0]['installmentNumber'] = 0;
                $paymentOptions['creditCard'][0]['installments'] = array();
            }elseif ($code == 'checkmo') {
                $paymentOptions['moneyTransfer'] = array();
                $paymentOptions['moneyTransfer'][0]['id'] = $code;
                $paymentOptions['moneyTransfer'][0]['displayName'] = $method->getTitle();
                $paymentOptions['moneyTransfer'][0]['code'] = $code;
                $paymentOptions['moneyTransfer'][0]['branch'] = ' ';
                $paymentOptions['moneyTransfer'][0]['accountNumber'] = ' ';
                $paymentOptions['moneyTransfer'][0]['iban'] = ' ';
                $paymentOptions['moneyTransfer'][0]['imageUrl'] = '';

            }elseif ($code == 'cashondelivery') {
                $paymentOptions['cashOnDelivery'] = array();
                $paymentOptions['cashOnDelivery']['type'] = null;
                $paymentOptions['cashOnDelivery']['displayName'] = null;
                $paymentOptions['cashOnDelivery']['additionalFee'] = null;
                $paymentOptions['cashOnDelivery']['description'] = null;
                $paymentOptions['cashOnDelivery']['isSMSVerification'] = false;
                $paymentOptions['cashOnDelivery']['SMSCode'] = null;
                $paymentOptions['cashOnDelivery']['PhoneNumber'] = null;
                $paymentOptions['cashOnDelivery']['type'] = $code;
                $paymentOptions['cashOnDelivery']['displayName'] = $method->getTitle();
                $paymentOptions['cashOnDelivery']['additionalFee'] = '0';
                $paymentOptions['cashOnDelivery']['description'] = 'Cash on delivery description text';
                $paymentOptions['cashOnDelivery']['isSMSVerification'] = false;
                $paymentOptions['cashOnDelivery']['SMSCode'] = null;
                $paymentOptions['cashOnDelivery']['PhoneNumber'] = null;
            } elseif ($code == 'paypal_express') {
                $paymentOptions['paypal'] = array();
                $paymentOptions['paypal']['clientId'] = null;
                $paymentOptions['paypal']['displayName'] = null;
                $paymentOptions['paypal']['isSandbox'] = 'true';
                $paymentOptions['paypal']['clientId'] = null;
                $paymentOptions['paypal']['displayName'] = $method->getTitle();
                $paymentOptions['paypal']['isSandbox'] = (bool)$this->configBasket ->getValue('tappzpaypal/tappzpaypalmethod/paypalSandbox/');
            }

        }

        return $paymentOptions;
    }

    public function getPaymentByBasket($quote) {
        $result = null;
        $payment = $quote->getPayment();
        if(isset($payment)){
            $method = $payment->getData('method');
            if ($method == 'checkmo') {

            }elseif($method == 'creditCard'){

            }elseif($method == 'cashondelivery'){

            }elseif($method == 'paypal_express'){

            }elseif($method == 'stripe'){

            }

        }

        return $result;
    }

    public function getBasketPayment($quoteId){
        
    }

	/**
     * @param $quote
     * @return mixed
     */
    public function getDeliveryByBasket($quote) {
            $quoteBillingAddress = $quote->getBillingAddress();
            $quoteShippingAddress = $quote->getShippingAddress();
            if ($quoteBillingAddress)
                $delivery['billingAddress'] = $this->addressRepository->getAddress($quoteBillingAddress->getData('customer_address_id'));
            if ($quoteShippingAddress) {
                $delivery['shippingAddress'] = $this->addressRepository->getAddress($quoteShippingAddress->getData('customer_address_id'));
                $delivery['shippingMethod']['id'] = $quoteShippingAddress->getData('shipping_method');
                $delivery['shippingMethod']['displayName'] = $quoteShippingAddress->getData('shipping_description');
                $delivery['shippingMethod']['trackingAddress'] = null;
                $delivery['shippingMethod']['price'] = $quoteShippingAddress->getData('shipping_incl_tax');
                $delivery['shippingMethod']['priceForYou'] = null;
                $delivery['shippingMethod']['shippingMethodType'] = $quoteShippingAddress->getData('shipping_method');
                $delivery['shippingMethod']['imageUrl'] = null;
            }
        if(is_null($delivery['shippingMethod']['id'])){
            $delivery = (object)array();
        }
        return $delivery;
    }

    public function getDiscountTotalByBasket($quote) {
        $quoteShippingAddress = $quote->getShippingAddress();
        $result =  $quoteShippingAddress->getData('discount_amount');
        return $result== null ? 0: $result;
    }

    public function getShippingTotalByBasket($quote) {
        $quoteShippingAddress = $quote->getShippingAddress();
         $result =  $quoteShippingAddress->getData('discount_amount');
        return $result== null ? 0: $result;
    }

    public function getShippingMethodByBasket($quote) {

        $carriers = $this->carrierConfig->getActiveCarriers();
        $shippingMethods =array();
        foreach ($carriers as $carrierCode => $carrierModel) {
            $carrierTitle = $this->configBasket->getValue(
                'carriers/' . $carrierCode . '/title',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $carrierPrice= $this->configBasket->getValue(
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

    public function getLinesByBasket($quote) {
        $lines = array();

        foreach ($quote->getAllVisibleItems() as $item) {

            $this->setProductId($item->getData('product_id'));
            $this->setProduct($this->productRepository->getById($item->getData('product_id')));
            $this->setQuantity($item->getData('qty'));
            $this->setPlacedPrice($item->getData('price'));
            $this->setPlacedPriceTotal($item->getData('row_total'));
            $this->setExtendedPrice(0);
            $this->setExtendedPriceValue(0);
            $this->setExtendedPriceTotal(0);
            $this->setExtendedPriceTotalValue(0);
            $this->setStatus(0);
            $this->setStrikeoutPrice($this->getProduct()['strikeoutPrice']);
            $this->setAverageDeliveryDays("");
            $this->setVariants($this->getProduct()['variants']);
            $lines[] = $this->fillLines();
        }

        return $lines;
    }

}
