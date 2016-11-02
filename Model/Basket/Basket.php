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
    public $basket;
    /**
     * @var
     */
    public $payment;
    /**
     * @var
     */
    public $contract;
    /**
     * @var
     */
    public $purchase;

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
        $this->basket = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAverageDeliveryDays()
    {
        return $this->basket->averageDeliveryDays;
    }

    /**
     * @return mixed
     */
    public function getBeforeTaxTotal()
    {
        return $this->basket->beforeTaxTotal;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->basket->currency;
    }

    /**
     * @return mixed
     */
    public function getDelivery()
    {
        return $this->basket->delivery;
    }

    /**
     * @return mixed
     */
    public function getDiscounts()
    {
        return $this->basket->discounts;
    }

    /**
     * @return mixed
     */
    public function getDiscountTotal()
    {
        return $this->basket->discountTotal;
    }

    /**
     * @return mixed
     */
    public function getDiscountDisplayName()
    {
        return $this->basket->discountDisplayName;
    }

    /**
     * @return mixed
     */
    public function getDiscountPromoCode()
    {
        return $this->basket->discountPromoCode;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->basket->errorCode;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->basket->errors;
    }

    /**
     * @return mixed
     */
    public function getEstimatedSupplyDate()
    {
        return $this->basket->estimatedSupplyDate;
    }

    /**
     * @return mixed
     */
    public function getExpirationTime()
    {
        return $this->basket->expirationTime;
    }

    /**
     * @return mixed
     */
    public function getExtendedPrice()
    {
        return $this->basket->extendedPrice;
    }

    /**
     * @return mixed
     */
    public function getExtendedPriceTotal()
    {
        return $this->basket->extendedPriceTotal;
    }

    /**
     * @return mixed
     */
    public function getExtendedPriceTotalValue()
    {
        return $this->basket->extendedPriceTotalValue;
    }

    /**
     * @return mixed
     */
    public function getExtendedPriceValue()
    {
        return $this->basket->extendedPriceValue;
    }

    /**
     * @return mixed
     */
    public function getGiftCheques()
    {
        return $this->basket->giftCheques;
    }

    /**
     * @return mixed
     */
    public function getGiftWrapping()
    {
        return $this->basket->giftWrapping;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->basket->id;
    }

    /**
     * @return mixed
     */
    public function getIsGiftWrappingEnabled()
    {
        return $this->basket->isGiftWrappingEnabled;
    }

    /**
     * @return mixed
     */
    public function getItemsPriceTotal()
    {
        return $this->basket->itemsPriceTotal;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->basket->lines;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->basket->message;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->basket->payment;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPayment($data)
    {
        $this->basket->payment = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentFee()
    {
        return $this->basket->paymentFee;
    }

    /**
     * @return mixed
     */
    public function getPaymentOptions()
    {
        return $this->basket->paymentOptions;
    }

    /**
     * @return mixed
     */
    public function getPlacedPrice()
    {
        return $this->basket->placedPrice;
    }

    /**
     * @return mixed
     */
    public function getPlacedPriceTotal()
    {
        return $this->basket->placedPriceTotal;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->basket->product;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->basket->productId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        $quantity = $this->basket->quantity;
        $result = empty($quantity) ? 0 : $quantity;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getRewardPoints()
    {
        return $this->basket->rewardPoints;
    }

    /**
     * @return mixed
     */
    public function getShippingMethods()
    {
        return $this->basket->shippingMethods;
    }

    /**
     * @return mixed
     */
    public function getShippingMethod()
    {
        return $this->basket->shippingMethod;
    }

    /**
     * @return mixed
     */
    public function getShippingTotal()
    {
        return $this->basket->shippingTotal;
    }

    /**
     * @return mixed
     */
    public function getSpentGiftChequeTotal()
    {
        return $this->basket->spentGiftChequeTotal;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->basket->status;
    }

    /**
     * @return mixed
     */
    public function getStrikeoutPrice()
    {
        return $this->basket->strikeoutPrice;
    }

    /**
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->basket->subtotal;
    }

    /**
     * @return mixed
     */
    public function getTaxTotal()
    {
        return $this->basket->taxTotal;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->basket->total;
    }

    /**
     * @return mixed
     */
    public function getUsedPoints()
    {
        return $this->basket->usedPoints;
    }

    /**
     * @return mixed
     */
    public function getUsedPointsAmount()
    {
        return $this->basket->usedPointsAmount;
    }

    /**
     * @return mixed
     */
    public function getUserFriendly()
    {
        return $this->basket->userFriendly;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getLines($id)
    {
        $id;
        return $this->basket->lines;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setAverageDeliveryDays($data)
    {
        $this->basket->averageDeliveryDays = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setBeforeTaxTotal($data)
    {
        $this->basket->beforeTaxTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCurrency($data)
    {
        $this->basket->currency = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDelivery($data)
    {
        $this->basket->delivery = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDiscounts($data)
    {
        $this->basket->discounts = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setErrorCode($data)
    {
        $this->basket->errorCode = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setErrors($data)
    {
        $this->basket->errors = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setEstimatedSupplyDate($data)
    {
        $this->basket->estimatedSupplyDate = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setExpirationTime($data)
    {
        $this->basket->expirationTime = $data;

        return $this;
    }

    /**
     * @param string $data
     *
     * @return $this
     */
    public function setExtendedPrice($data = '')
    {
        $this->basket->extendedPrice = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setExtendedPriceTotal($data)
    {
        $this->basket->extendedPriceTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setExtendedPriceTotalValue($data)
    {
        $this->basket->extendedPriceTotalValue = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setExtendedPriceValue($data)
    {
        $this->basket->extendedPriceValue = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setGiftCheques($data)
    {
        $this->basket->giftCheques = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setGiftWrapping($data)
    {
        $this->basket->giftWrapping = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setId($data)
    {
        $this->basket->id = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setIsGiftWrappingEnabled($data)
    {
        $this->basket->isGiftWrappingEnabled = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setItemsPriceTotal($data)
    {
        $this->basket->itemsPriceTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setLine($data)
    {
        $this->basket->lines = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setMessage($data)
    {
        $this->basket->message = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPaymentFee($data)
    {
        $this->basket->paymentFee = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPaymentOptions($data)
    {
        $this->basket->paymentOptions = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPlacedPrice($data)
    {
        $this->basket->placedPrice = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPlacedPriceTotal($data)
    {
        $this->basket->placedPriceTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setProduct($data)
    {
        $this->basket->product = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setProductId($data)
    {
        $this->basket->productId = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setQuantity($data)
    {
        $this->basket->quantity = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setRewardPoints($data)
    {
        $this->basket->rewardPoints = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingMethods($data)
    {
        $this->basket->shippingMethods = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingMethod($data)
    {
        $this->basket->shippingMethod = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotal($data)
    {
        $this->basket->shippingTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setSpentGiftChequeTotal($data)
    {
        $this->basket->spentGiftChequeTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setStatus($data)
    {
        $this->basket->status = $data;

        return $this;
    }

    /**
     * @param $data
     */
    public function setStrikeoutPrice($data)
    {
        $this->basket->strikeoutPrice = $data;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setSubTotal($data)
    {
        $this->basket->subtotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTaxTotal($data)
    {
        $this->basket->taxTotal = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotal($data)
    {
        $this->basket->total = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUsedPoints($data)
    {
        $this->basket->usedPoints = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUsedPointsAmount($data)
    {
        $this->basket->usedPointsAmount = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUserFriendly($data)
    {
        $this->basket->userFriendly = $data;

        return $this;
    }

    /**
     * @param $lines
     *
     * @return $this
     */
    public function setLines($lines)
    {
        $this->basket->lines = $lines;

        return $this;
    }

    /**
     * @param $discountTotal
     *
     * @return $this
     */
    public function setDiscountTotal($discountTotal)
    {
        $this->basket->discountTotal = $discountTotal;

        return $this;
    }

    /**
     * @param $displayName
     *
     * @return $this
     */
    public function setDiscountDisplayName($displayName)
    {
        $this->basket->discountDisplayName = $displayName;

        return $this;
    }

    /**
     * @param $promeCode
     *
     * @return $this
     */
    public function setDiscountPromoCode($promeCode)
    {
        $this->basket->discountPromoCode = $promeCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariants()
    {
        return $this->basket->variants;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setVariants($data)
    {
        $this->basket->variants = $data;

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
        $this->payment->methodType = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setType($data)
    {
        $this->payment->type = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDisplayName($data)
    {
        $this->payment->displayName = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setBankCode($data)
    {
        $this->payment->bankCode = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setInstallment($data)
    {
        $this->payment->installment = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setAccountNumber($data)
    {
        $this->payment->accountNumber = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setBranch($data)
    {
        $this->payment->branch = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setIban($data)
    {
        $this->payment->iban = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCard($data)
    {
        $this->payment->creditCard = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardOwner($data)
    {
        $this->basket->creditCard->owner = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardNumber($data)
    {
        $this->basket->creditCard->number = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardMonth($data)
    {
        $this->basket->creditCard->month = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardYear($data)
    {
        $this->basket->creditCard->year = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardCvv($data)
    {
        $this->basket->creditCard->ccv = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCreditCardCvvType($data)
    {
        $this->basket->creditCard->ccvType = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDelivery($data)
    {
        $this->basket->cashOnDelivery = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryType($data)
    {
        $this->basket->cashOnDelivery->type = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryDisplayName($data)
    {
        $this->basket->cashOnDelivery->displayName = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryAdditionalFee($data)
    {
        $this->basket->cashOnDelivery->additionalFee = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryDescription($data)
    {
        $this->basket->cashOnDelivery->description = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryIsSMSVerification($data)
    {
        $this->basket->cashOnDelivery->isSMSVerification = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliverySMSCode($data)
    {
        $this->basket->cashOnDelivery->SMSCode = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCashOnDeliveryPhoneNumber($data)
    {
        $this->basket->cashOnDelivery->phoneNumber = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setClientId($data)
    {
        $this->basket->cashOnDelivery->phoneNumber = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethodType()
    {
        return $this->payment->methodType;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->payment->type;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->payment->displayName;
    }

    /**
     * @return mixed
     */
    public function getBankCode()
    {
        return $this->payment->bankCode;
    }

    /**
     * @return mixed
     */
    public function getInstallment()
    {
        return $this->payment->installment;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->payment->accountNumber;
    }

    /**
     * @return mixed
     */
    public function getBranch()
    {
        return $this->payment->branch;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return $this->payment->iban;
    }

    /**
     * @return mixed
     */
    public function getCreditCard()
    {
        return $this->payment->creditCard;
    }

    /**
     * @return mixed
     */
    public function getCreditCardOwner()
    {
        return $this->basket->creditCard->owner;
    }

    /**
     * @return mixed
     */
    public function getCreditCardNumber()
    {
        return $this->payment->creditCard->number;
    }

    /**
     * @return mixed
     */
    public function getCreditCardMonth()
    {
        return $this->payment->creditCard->month;
    }

    /**
     * @return mixed
     */
    public function getCreditCardYear()
    {
        return $this->payment->creditCard->year;
    }

    /**
     * @return mixed
     */
    public function getCreditCardCvv()
    {
        return $this->payment->creditCard->ccv;
    }

    /**
     * @return mixed
     */
    public function getCreditCardCvvType()
    {
        return $this->payment->creditCard->ccvType;
    }

    /**
     * @return mixed
     */
    public function getCashOnDelivery()
    {
        return $this->payment->cashOnDelivery;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryType()
    {
        return $this->payment->cashOnDelivery->type;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryDisplayName()
    {
        return $this->payment->cashOnDelivery->displayName;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryAdditionalFee()
    {
        return $this->payment->cashOnDelivery->additionalFee;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryDescription()
    {
        return $this->payment->cashOnDelivery->description;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryIsSMSVerification()
    {
        return $this->payment->cashOnDelivery->isSMSVerification;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliverySMSCode()
    {
        return $this->payment->cashOnDelivery->SMSCode;
    }

    /**
     * @return mixed
     */
    public function getCashOnDeliveryPhoneNumber()
    {
        return $this->payment->cashOnDelivery->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getPaypal()
    {
        return $this->payment->paypal;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->payment->clienId;
    }

    /**
     * @return mixed
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * @param $data
     *
     * @return object
     */
    public function setContract($data)
    {
        $data;
        $result = $this->contract = (object)[];

        return $result;
    }

    /**
     * @return mixed
     */
    public function getContractData()
    {
        return $this->contract->data;
    }

    /**
     * @return mixed
     */
    public function getShippingContract()
    {
        return $this->contract->shippingContract;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function setContractData($data)
    {
        $result = $this->contract->data = $data;

        return $result;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function setShippingContract($data)
    {
        $result = $this->contract->shippingContract = $data;

        return $result;
    }

    /**
     * @return mixed
     */
    public function getGiftWrappingIsSelected()
    {
        return $this->basket->giftWrappingIsSelected;
    }
    /**
     * @return mixed
     */
    public function getGiftWrappingFee()
    {
        return $this->basket->giftWrappingFee;
    }
    /**
     * @return mixed
     */
    public function getGiftWrappingCharacter()
    {
        return $this->basket->giftWrappingCharacter;
    }
    /**
     * @return mixed
     */
    public function getGiftWrappingMessage()
    {
        return $this->basket->giftWrappingMessage;
    }
    /**
     * @return mixed
     */
    public function setGiftWrappingIsSelected($data)
    {
        $result = $this->basket->giftWrappingIsSelected = $data;
        return $result;
    }
    /**
     * @return mixed
     */
    public function setGiftWrappingFee($data)
    {
        $result = $this->basket->giftWrappingFee = $data;
        return $result;
    }
    /**
     * @return mixed
     */
    public function setGiftWrappingCharacter($data)
    {
        $result =  $this->basket->giftWrappingCharacter = $data;
        return $result;
    }
    /**
     * @return mixed
     */
    public function setGiftWrappingMessage($data)
    {
        $result =  $this->basket->giftWrappingMessage = $data;
        return $result;
    }

}
