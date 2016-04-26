<?php

namespace TmobLabs\Tappz\Model\Basket;

use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Product\ProductRepository as ProductRepository;
use TmobLabs\Tappz\Model\Address\AddressRepository as AddressRepository;

class BasketCollector extends BasketFill {

    protected $objectManager;
    protected $store;
    protected $productRepository;
    protected $addressRepository;

    public function __construct(
    RequestHandler $requestHandler, ProductRepository $productRepository, AddressRepository $addressRepository
    ) {
        $this->helper = $requestHandler;
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $this->productRepository = $productRepository;
        $this->addressRepository = $addressRepository;
    }

    public function merge() {

        $userId = $this->helper->getAuthorization();
        $store = $this->store->getStore();
        $result = $this->helper->convertJson($this->helper->getHeaderJson());
        $anonymousBasketId = $result->basketId;
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
        $customer = $this->objectManager
                ->get('Magento\Customer\Model\Customer')
                ->setStore($store)
                ->load($userId);
        if (is_numeric($userId)) {
            $quote = $quoteObject->loadByCustomer($customer);
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
        $this->setExpirationTime(null);
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

    public function getPaymentFeeByBasket($fee = null) {
        return $fee;
    }

    public function getRewardPointsByBasket($points = null) {
        return $points;
    }

    public function getUsedPointsBasket($points = null) {
        return $points;
    }

    public function getUsedPointsAmountByBasket($pointsAmount = null) {
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
        return $quote->getData('gift_cards_amount');
    }

    public function getGiftChequesByBasket($cheques = array()) {
        return $cheques;
    }

    public function getErrorsByBasket($errors = array()) {
        return $errors;
    }

    public function getTotalByBasket($quote) {
        return $quote->getData('grand_total');
    }

    public function getTaxTotalByBasket($quote) {
        return null;
    }

    public function getBeforeTaxTotalByBasket($quote) {
        return null;
    }

    public function getItemPriceTotalByBasket($quote) {
        return $quote->getData('base_subtotal');
    }

    public function getItemSubTotalByBasket($quote) {
        return ( $quote->getData('subtotal'));
    }

    public function getPaymentMethodsByBasket($quote) {
        $result = array();
        return $result;
    }

    public function getPaymentByBasket($quote) {
        $result = array();
        return $result;
    }

    public function getDeliveryByBasket($quote) {
        return array();
        $quoteBillingAddress = $quote->getBillingAddress();

        if ($quoteBillingAddress)
            $delivery['billingAddress'] = $this->addressRepository->getById($quoteBillingAddress->getData('customer_address_id'));
        $quoteShippingAddress = $quote->getShippingAddress();
        if ($quoteShippingAddress) {
            $delivery['shippingAddress'] = $this->addressRepository->getById($quoteShippingAddress->getData('customer_address_id'));
            $delivery['shippingMethod']['id'] = $quoteShippingAddress->getData('shipping_method');
            $delivery['shippingMethod']['displayName'] = $quoteShippingAddress->getData('shipping_description');
            $delivery['shippingMethod']['trackingAddress'] = null;
            $delivery['shippingMethod']['price'] = number_format($quoteShippingAddress->getData('shipping_incl_tax'), 2, $decimalDivider, $thousandDivider);
            $delivery['shippingMethod']['priceForYou'] = null;
            $delivery['shippingMethod']['shippingMethodType'] = $quoteShippingAddress->getData('shipping_method');
            $delivery['shippingMethod']['imageUrl'] = null;
        }
    }

    public function getDiscountTotalByBasket($quote) {
        $quoteShippingAddress = $quote->getShippingAddress();
        return $quoteShippingAddress->getData('discount_amount');
    }

    public function getShippingTotalByBasket($quote) {
        $quoteShippingAddress = $quote->getShippingAddress();
        return $quoteShippingAddress->getData('discount_amount');
    }

    public function getShippingMethodByBasket($quote) {
        $shippingMethods = array();
        $quoteShippingAddress = $quote->getShippingAddress();
        if (isset($quoteShippingAddress)) {
            $quoteShippingAddress->collectShippingRates()->save();
            $groupedRates = $quoteShippingAddress->getGroupedAllShippingRates();
            foreach ($groupedRates as $carrierCode => $rates) {
                foreach ($rates as $rate) {
                    $rateItem = array();
                    $rateItem['id'] = $rate->getData('code');
                    $rateItem['displayName'] = $rate->getData('method_title');
                    $rateItem['trackingAddress'] = null;
                    $rateItem['price'] = $rate->getData('price');
                    $rateItem['priceForYou'] = null;
                    $rateItem['shippingMethodType'] = $rate->getData('code');
                    $rateItem['imageUrl'] = null;
                    $shippingMethods[] = $rateItem;
                }
            }
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
            $this->setExtendedPrice("");
            $this->setExtendedPriceValue("");
            $this->setExtendedPriceTotal("");
            $this->setExtendedPriceTotalValue("");
            $this->setStatus("");
            $this->setStrikeoutPrice($this->getProduct()['strikeoutPrice']);
            $this->setAverageDeliveryDays("");
            $this->setVariants($this->getProduct()['variants']);
            $lines[] = $this->fillLines();
        }
        return $lines;
    }

}
