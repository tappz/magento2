<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Basket;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\BasketInterface;

/**
 * Class Basket.
 */
class Basket extends AbstractExtensibleObject implements BasketInterface
{
    /**
     * @var
     */
    protected $_basket;
    /**
     * @var
     */
    protected $_payment;
    /**
     * @var
     */
    protected $_contract;
    /**
     * @var
     */
    protected $_purchase;

    /**
     * @return mixed
     */
    public function getBasket()
    {
        return $this->product;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setBasket($data)
    {
        $this->_basket = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAverageDeliveryDays()
    {
        return $this->_basket->averageDeliveryDays;
    }

    /**
     * @return mixed
     */
    public function getBeforeTaxTotal()
    {
        return $this->_basket->beforeTaxTotal;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->_basket->currency;
    }

    /**
     * @return mixed
     */
    public function getDelivery()
    {
        return $this->_basket->delivery;
    }

    /**
     * @return mixed
     */
    public function getDiscounts()
    {
        return $this->_basket->discounts;
    }

    /**
     * @return mixed
     */
    public function getDiscountTotal()
    {
        return $this->_basket->discountTotal;
    }

    /**
     * @return mixed
     */
    public function getDiscountDisplayName()
    {
        return $this->_basket->discountDisplayName;
    }

    /**
     * @return mixed
     */
    public function getDiscountPromoCode()
    {
        return $this->_basket->discountPromoCode;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->_basket->errorCode;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->_basket->errors;
    }

    /**
     * @return mixed
     */
    public function getEstimatedSupplyDate()
    {
        return $this->_basket->estimatedSupplyDate;
    }

    /**
     * @return mixed
     */
    public function getExpirationTime()
    {
        return $this->_basket->expirationTime;
    }

    /**
     * @return mixed
     */
    public function getExtendedPrice()
    {
        return $this->_basket->extendedPrice;
    }

    /**
     * @return mixed
     */
    public function getExtendedPriceTotal()
    {
        return $this->_basket->extendedPriceTotal;
    }

    /**
     * @return mixed
     */
    public function getExtendedPriceTotalValue()
    {
        return $this->_basket->extendedPriceTotalValue;
    }

    /**
     * @return mixed
     */
    public function getExtendedPriceValue()
    {
        return $this->_basket->extendedPriceValue;
    }

    /**
     * @return mixed
     */
    public function getGiftCheques()
    {
        return $this->_basket->giftCheques;
    }

    /**
     * @return mixed
     */
    public function getGiftWrapping()
    {
        return $this->_basket->giftWrapping;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_basket->id;
    }

    /**
     * @return mixed
     */
    public function getIsGiftWrappingEnabled()
    {
        return $this->_basket->isGiftWrappingEnabled;
    }

    /**
     * @return mixed
     */
    public function getItemsPriceTotal()
    {
        return $this->_basket->itemsPriceTotal;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->_basket->lines;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_basket->message;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->_basket->payment;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPayment($data)
    {
        $this->_basket->payment = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentFee()
    {
        return $this->_basket->paymentFee;
    }

    /**
     * @return mixed
     */
    public function getPaymentOptions()
    {
        return $this->_basket->paymentOptions;
    }

    /**
     * @return mixed
     */
    public function getPlacedPrice()
    {
        return $this->_basket->placedPrice;
    }

    /**
     * @return mixed
     */
    public function getPlacedPriceTotal()
    {
        return $this->_basket->placedPriceTotal;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->_basket->product;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->_basket->productId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        $quantity = $this->_basket->quantity;
        $result = empty($quantity) ? 0 : $quantity;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getRewardPoints()
    {
        return $this->_basket->rewardPoints;
    }

    /**
     * @return mixed
     */
    public function getShippingMethods()
    {
        return $this->_basket->shippingMethods;
    }

    /**
     * @return mixed
     */
    public function getShippingMethod()
    {
        return $this->_basket->shippingMethod;
    }

    /**
     * @return mixed
     */
    public function getShippingTotal()
    {
        return $this->_basket->shippingTotal;
    }

    /**
     * @return mixed
     */
    public function getSpentGiftChequeTotal()
    {
        return $this->_basket->spentGiftChequeTotal;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_basket->status;
    }

    /**
     * @return mixed
     */
    public function getStrikeoutPrice()
    {
        return $this->_basket->strikeoutPrice;
    }

    /**
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->_basket->subtotal;
    }

    /**
     * @return mixed
     */
    public function getTaxTotal()
    {
        return $this->_basket->taxTotal;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->_basket->total;
    }

    /**
     * @return mixed
     */
    public function getUsedPoints()
    {
        return $this->_basket->usedPoints;
    }

    /**
     * @return mixed
     */
    public function getUsedPointsAmount()
    {
        return $this->_basket->usedPointsAmount;
    }

    /**
     * @return mixed
     */
    public function getUserFriendly()
    {
        return $this->_basket->userFriendly;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getLines($id)
    {
        $id;
        return $this->_basket->lines;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setAverageDeliveryDays($data)
    {
        $this->_basket->averageDeliveryDays = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setBeforeTaxTotal($data)
    {
        $this->_basket->beforeTaxTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCurrency($data)
    {
        $this->_basket->currency = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDelivery($data)
    {
        $this->_basket->delivery = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDiscounts($data)
    {
        $this->_basket->discounts = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setErrorCode($data)
    {
        $this->_basket->errorCode = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setErrors($data)
    {
        $this->_basket->errors = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setEstimatedSupplyDate($data)
    {
        $this->_basket->estimatedSupplyDate = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setExpirationTime($data)
    {
        $this->_basket->expirationTime = $data;

        return $this;
    }

    /**
     * @param string $data
     *
     * @return $this
     */
    public function setExtendedPrice($data = '')
    {
        $this->_basket->extendedPrice = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setExtendedPriceTotal($data)
    {
        $this->_basket->extendedPriceTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setExtendedPriceTotalValue($data)
    {
        $this->_basket->extendedPriceTotalValue = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setExtendedPriceValue($data)
    {
        $this->_basket->extendedPriceValue = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setGiftCheques($data)
    {
        $this->_basket->giftCheques = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setGiftWrapping($data)
    {
        $this->_basket->giftWrapping = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setId($data)
    {
        $this->_basket->id = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setIsGiftWrappingEnabled($data)
    {
        $this->_basket->isGiftWrappingEnabled = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setItemsPriceTotal($data)
    {
        $this->_basket->itemsPriceTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setLine($data)
    {
        $this->_basket->lines = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setMessage($data)
    {
        $this->_basket->message = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPaymentFee($data)
    {
        $this->_basket->paymentFee = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPaymentOptions($data)
    {
        $this->_basket->paymentOptions = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPlacedPrice($data)
    {
        $this->_basket->placedPrice = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPlacedPriceTotal($data)
    {
        $this->_basket->placedPriceTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setProduct($data)
    {
        $this->_basket->product = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setProductId($data)
    {
        $this->_basket->productId = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setQuantity($data)
    {
        $this->_basket->quantity = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setRewardPoints($data)
    {
        $this->_basket->rewardPoints = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingMethods($data)
    {
        $this->_basket->shippingMethods = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingMethod($data)
    {
        $this->_basket->shippingMethod = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotal($data)
    {
        $this->_basket->shippingTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setSpentGiftChequeTotal($data)
    {
        $this->_basket->spentGiftChequeTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setStatus($data)
    {
        $this->_basket->status = $data;

        return $this;
    }

    /**
     * @param $data
     */
    public function setStrikeoutPrice($data)
    {
        $this->_basket->strikeoutPrice = $data;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setSubTotal($data)
    {
        $this->_basket->subtotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTaxTotal($data)
    {
        $this->_basket->taxTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotal($data)
    {
        $this->_basket->total = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUsedPoints($data)
    {
        $this->_basket->usedPoints = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUsedPointsAmount($data)
    {
        $this->_basket->usedPointsAmount = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUserFriendly($data)
    {
        $this->_basket->userFriendly = $data;

        return $this;
    }

    /**
     * @param $lines
     *
     * @return $this
     */
    public function setLines($lines)
    {
        $this->_basket->lines = $lines;

        return $this;
    }

    /**
     * @param $discountTotal
     *
     * @return $this
     */
    public function setDiscountTotal($discountTotal)
    {
        $this->_basket->discountTotal = $discountTotal;

        return $this;
    }

    /**
     * @param $displayName
     *
     * @return $this
     */
    public function setDiscountDisplayName($displayName)
    {
        $this->_basket->discountDisplayName = $displayName;

        return $this;
    }

    /**
     * @param $promeCode
     *
     * @return $this
     */
    public function setDiscountPromoCode($promeCode)
    {
        $this->_basket->discountPromoCode = $promeCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariants()
    {
        return $this->_basket->variants;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setVariants($data)
    {
        $this->_basket->variants = $data;

        return $this;
    }

    /****/
    /**
     * @param $data
     *
     * @return $this
     */
    public function setMethodType($data)
    {
        $this->_payment->methodType = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setType($data)
    {
        $this->_payment->type = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDisplayName($data)
    {
        $this->_payment->displayName = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setBankCode($data)
    {
        $this->_payment->bankCode = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setInstallment($data)
    {
        $this->_payment->installment = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setAccountNumber($data)
    {
        $this->_payment->accountNumber = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setBranch($data)
    {
        $this->_payment->branch = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setIban($data)
    {
        $this->_payment->iban = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCard($data)
    {
        $this->_payment->creditCard = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardOwner($data)
    {
        $this->_basket->creditCard->owner = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardNumber($data)
    {
        $this->_basket->creditCard->number = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardMonth($data)
    {
        $this->_basket->creditCard->month = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardYear($data)
    {
        $this->_basket->creditCard->year = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardCvv($data)
    {
        $this->_basket->creditCard->ccv = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardCvvType($data)
    {
        $this->_basket->creditCard->ccvType = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDelivery($data)
    {
        $this->_basket->cashOnDelivery = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryType($data)
    {
        $this->_basket->cashOnDelivery->type = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryDisplayName($data)
    {
        $this->_basket->cashOnDelivery->displayName = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryAdditionalFee($data)
    {
        $this->_basket->cashOnDelivery->additionalFee = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryDescription($data)
    {
        $this->_basket->cashOnDelivery->description = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryIsSMSVerification($data)
    {
        $this->_basket->cashOnDelivery->isSMSVerification = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliverySMSCode($data)
    {
        $this->_basket->cashOnDelivery->SMSCode = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryPhoneNumber($data)
    {
        $this->_basket->cashOnDelivery->phoneNumber = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setClientId($data)
    {
        $this->_basket->cashOnDelivery->phoneNumber = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethodType()
    {
        return $this->_payment->methodType;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_payment->type;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->_payment->displayName;
    }

    /**
     * @return mixed
     */
    public function getBankCode()
    {
        return $this->_payment->bankCode;
    }

    /**
     * @return mixed
     */
    public function getInstallment()
    {
        return $this->_payment->installment;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->_payment->accountNumber;
    }

    /**
     * @return mixed
     */
    public function getBranch()
    {
        return $this->_payment->branch;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return $this->_payment->iban;
    }

    /**
     * @return mixed
     */
    public function getCreditCard()
    {
        return $this->_payment->creditCard;
    }

    /**
     * @return mixed
     */
    public function getCreditCardOwner()
    {
        return $this->_basket->creditCard->owner;
    }

    /**
     * @return mixed
     */
    public function getCreditCardNumber()
    {
        return $this->_payment->creditCard->number;
    }

    /**
     * @return mixed
     */
    public function getCreditCardMonth()
    {
        return $this->_payment->creditCard->month;
    }

    /**
     * @return mixed
     */
    public function getCreditCardYear()
    {
        return $this->_payment->creditCard->year;
    }

    /**
     * @return mixed
     */
    public function getCreditCardCvv()
    {
        return $this->_payment->creditCard->ccv;
    }

    /**
     * @return mixed
     */
    public function getCreditCardCvvType()
    {
        return $this->_payment->creditCard->ccvType;
    }

    /**
     * @return mixed
     */
    public function getCashOnDelivery()
    {
        return $this->_payment->cashOnDelivery;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryType()
    {
        return $this->_payment->cashOnDelivery->type;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryDisplayName()
    {
        return $this->_payment->cashOnDelivery->displayName;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryAdditionalFee()
    {
        return $this->_payment->cashOnDelivery->additionalFee;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryDescription()
    {
        return $this->_payment->cashOnDelivery->description;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryIsSMSVerification()
    {
        return $this->_payment->cashOnDelivery->isSMSVerification;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliverySMSCode()
    {
        return $this->_payment->cashOnDelivery->SMSCode;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryPhoneNumber()
    {
        return $this->_payment->cashOnDelivery->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getPaypal()
    {
        return $this->_payment->paypal;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->_payment->clienId;
    }

    /**
     * @return mixed
     */
    public function getContract()
    {
        return $this->_contract;
    }

    /**
     * @param $data
     *
     * @return object
     */
    public function setContract($data)
    {
        $data;
        $result = $this->_contract = (object)[];

        return $result;
    }

    /**
     * @return mixed
     */
    public function getContractData()
    {
        return $this->_contract->data;
    }

    /**
     * @return mixed
     */
    public function getShippingContract()
    {
        return $this->_contract->shippingContract;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function setContractData($data)
    {
        $result = $this->_contract->data = $data;

        return $result;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function setShippingContract($data)
    {
        $result = $this->_contract->shippingContract = $data;

        return $result;
    }
}
