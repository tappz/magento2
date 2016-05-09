<?php

namespace TmobLabs\Tappz\Model\Basket;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\BasketInterface;

class Basket extends AbstractExtensibleObject implements BasketInterface
{

	protected $basket;
	protected $payment;
	protected $contract;
	protected $purchase;

	public function getBasket()
	{
		return $this->product;
	}

	public function getAverageDeliveryDays()
	{
		return $this->basket->averageDeliveryDays;
	}

	public function getBeforeTaxTotal()
	{
		return $this->basket->beforeTaxTotal;
	}

	public function getCurrency()
	{
		return $this->basket->currency;
	}

	public function getDelivery()
	{
		return $this->basket->delivery;
	}

	public function getDiscounts()
	{
		return $this->basket->discounts;
	}

	public function getDiscountTotal()
	{
		return $this->basket->discountTotal;
	}

	public function getDiscountDisplayName()
	{
		return $this->basket->discountDisplayName;

	}

	public function getDiscountPromoCode()
	{
		return $this->basket->discountPromoCode;

	}

	public function getErrorCode()
	{
		return $this->basket->errorCode;
	}

	public function getErrors()
	{
		return $this->basket->errors;
	}

	public function getEstimatedSupplyDate()
	{
		return $this->basket->estimatedSupplyDate;
	}

	public function getExpirationTime()
	{
		return $this->basket->expirationTime;
	}

	public function getExtendedPrice()
	{
		return $this->basket->extendedPrice;
	}

	public function getExtendedPriceTotal()
	{
		return $this->basket->extendedPriceTotal;
	}

	public function getExtendedPriceTotalValue()
	{
		return $this->basket->extendedPriceTotalValue;
	}

	public function getExtendedPriceValue()
	{
		return $this->basket->extendedPriceValue;
	}

	public function getGiftCheques()
	{
		return $this->basket->giftCheques;
	}

	public function getGiftWrapping()
	{
		return $this->basket->giftWrapping;
	}

	public function getId()
	{
		return $this->basket->id;
	}

	public function getIsGiftWrappingEnabled()
	{
		return $this->basket->isGiftWrappingEnabled;
	}

	public function getItemsPriceTotal()
	{
		return $this->basket->itemsPriceTotal;
	}

	public function getLine()
	{
		return $this->basket->lines;
	}

	public function getMessage()
	{
		return $this->basket->message;
	}

	public function getPayment()
	{
		return $this->basket->payment;
	}

	public function getPaymentFee()
	{
		return $this->basket->paymentFee;
	}

	public function getPaymentOptions()
	{
		return $this->basket->paymentOptions;
	}

	public function getPlacedPrice()
	{
		return $this->basket->placedPrice;
	}

	public function getPlacedPriceTotal()
	{
		return $this->basket->placedPriceTotal;
	}

	public function getProduct()
	{
		return $this->basket->product;
	}

	public function getProductId()
	{
		return $this->basket->productId;
	}

	public function getQuantity()
	{
		return $this->basket->quantity;
	}

	public function getRewardPoints()
	{
		return $this->basket->rewardPoints;
	}

	public function getShippingMethods()
	{
		return $this->basket->shippingMethods;
	}

	public function getShippingMethod()
	{
		return $this->basket->shippingMethod;
	}
	public function getShippingTotal()
	{
		return $this->basket->shippingTotal;
	}

	public function getSpentGiftChequeTotal()
	{
		return $this->basket->spentGiftChequeTotal;
	}

	public function getStatus()
	{
		return $this->basket->status;
	}

	public function getStrikeoutPrice()
	{
		return $this->basket->strikeoutPrice;
	}

	public function getSubTotal()
	{
		return $this->basket->subtotal;
	}

	public function getTaxTotal()
	{
		return $this->basket->taxTotal;
	}

	public function getTotal()
	{
		return $this->basket->total;
	}

	public function getUsedPoints()
	{
		return $this->basket->usedPoints;
	}

	public function getUsedPointsAmount()
	{
		return $this->basket->usedPointsAmount;
	}

	public function getUserFriendly()
	{
		return $this->basket->userFriendly;
	}

	public function getLines($id)
	{

		return $this->basket->lines;
	}

	public function setAverageDeliveryDays($data)
	{
		$this->basket->averageDeliveryDays = $data;
		return $this;
	}

	public function setBeforeTaxTotal($data)
	{
		$this->basket->beforeTaxTotal = $data;

		return $this;
	}

	public function setCurrency($data)
	{
		$this->basket->currency = $data;

		return $this;
	}

	public function setDelivery($data)
	{
		$this->basket->delivery = $data;

		return $this;
	}

	public function setDiscounts($data)
	{
		$this->basket->discounts = $data;

		return $this;
	}

	public function setErrorCode($data)
	{
		$this->basket->errorCode = $data;
		return $this;
	}

	public function setErrors($data)
	{
		$this->basket->errors = $data;
		return $this;
	}

	public function setEstimatedSupplyDate($data)
	{
		$this->basket->estimatedSupplyDate = $data;
		return $this;
	}

	public function setExpirationTime($data)
	{
		$this->basket->expirationTime = $data;
		return $this;
	}

	public function setExtendedPrice($data = "")
	{
		$this->basket->extendedPrice = $data;
		return $this;
	}

	public function setExtendedPriceTotal($data)
	{
		$this->basket->extendedPriceTotal = $data;
		return $this;
	}

	public function setExtendedPriceTotalValue($data)
	{
		$this->basket->extendedPriceTotalValue = $data;
		return $this;
	}

	public function setExtendedPriceValue($data)
	{
		$this->basket->extendedPriceValue = $data;
		return $this;
	}

	public function setGiftCheques($data)
	{
		$this->basket->giftCheques = $data;
		return $this;
	}

	public function setGiftWrapping($data)
	{
		$this->basket->giftWrapping = $data;
		return $this;
	}

	public function setId($data)
	{
		$this->basket->id = $data;
		return $this;
	}

	public function setIsGiftWrappingEnabled($data)
	{
		$this->basket->isGiftWrappingEnabled = $data;
		return $this;
	}

	public function setItemsPriceTotal($data)
	{
		$this->basket->itemsPriceTotal = $data;
		return $this;
	}

	public function setLine($data)
	{
		$this->basket->lines = $data;
		return $this;
	}

	public function setMessage($data)
	{
		$this->basket->message = $data;
		return $this;
	}

	public function setPayment($data)
	{
		$this->basket->payment = $data;
		return $this;
	}

	public function setPaymentFee($data)
	{
		$this->basket->paymentFee = $data;
		return $this;
	}

	public function setPaymentOptions($data)
	{
		$this->basket->paymentOptions = $data;
		return $this;
	}

	public function setPlacedPrice($data)
	{
		$this->basket->placedPrice = $data;
		return $this;
	}

	public function setPlacedPriceTotal($data)
	{
		$this->basket->placedPriceTotal = $data;
		return $this;
	}

	public function setProduct($data)
	{
		$this->basket->product = $data;
		return $this;
	}

	public function setProductId($data)
	{
		$this->basket->productId = $data;
		return $this;
	}

	public function setQuantity($data)
	{
		$this->basket->quantity = $data;
		return $this;
	}

	public function setRewardPoints($data)
	{
		$this->basket->rewardPoints = $data;
		return $this;
	}

	public function setShippingMethods($data)
	{
		$this->basket->shippingMethods = $data;
		return $this;
	}
	public function setShippingMethod($data)
	{

		$this->basket->shippingMethod = $data;

		return $this;
	}
	public function setShippingTotal($data)
	{
		$this->basket->shippingTotal = $data;
		return $this;
	}

	public function setSpentGiftChequeTotal($data)
	{
		$this->basket->spentGiftChequeTotal = $data;
		return $this;
	}

	public function setStatus($data)
	{
		$this->basket->status = $data;
		return $this;
	}

	public function setStrikeoutPrice($data)
	{
		$this->basket->strikeoutPrice = $data;
	}

	public function setSubTotal($data)
	{
		$this->basket->subtotal = $data;
		return $this;
	}

	public function setTaxTotal($data)
	{
		$this->basket->taxTotal = $data;
		return $this;
	}

	public function setTotal($data)
	{
		$this->basket->total = $data;
		return $this;
	}

	public function setUsedPoints($data)
	{
		$this->basket->usedPoints = $data;
		return $this;
	}

	public function setUsedPointsAmount($data)
	{
		$this->basket->usedPointsAmount = $data;
		return $this;
	}

	public function setUserFriendly($data)
	{
		$this->basket->userFriendly = $data;
		return $this;
	}

	public function setBasket($data)
	{
		$this->basket = $data;
		return $this;
	}

	public function setLines($lines)
	{

		$this->basket->lines = $lines;
		return $this;
	}

	public function setDiscountTotal($discountTotal)
	{
		$this->basket->discountTotal = $discountTotal;
		return $this;
	}

	public function setDiscountDisplayName($displayName)
	{
		$this->basket->discountDisplayName = $displayName;
		return $this;
	}

	public function setDiscountPromoCode($promeCode)
	{
		$this->basket->discountPromoCode = $promeCode;
		return $this;
	}

	public function getVariants()
	{
		return $this->basket->variants;
	}

	public function setVariants($data)
	{
		$this->basket->variants = $data;
		return $this;
	}

	/****/
	public function setMethodType($data)
	{
		$this->payment->methodType = $data;
		return $this;
	}

	public function setType($data)
	{
		$this->payment->type = $data;
		return $this;
	}

	public function setDisplayName($data)
	{
		$this->payment->displayName = $data;
		return $this;
	}

	public function setBankCode($data)
	{
		$this->payment->bankCode = $data;
		return $this;
	}

	public function setInstallment($data)
	{
		$this->payment->installment = $data;
		return $this;
	}

	public function setAccountNumber($data)
	{
		$this->payment->accountNumber = $data;
		return $this;
	}

	public function setBranch($data)
	{
		$this->payment->branch = $data;
		return $this;
	}

	public function setIban($data)
	{
		$this->payment->iban = $data;
		return $this;
	}

	public function setCreditCard($data)
	{
		$this->payment->creditCard = $data;
		return $this;
	}

	public function setCreditCardOwner($data)
	{
		$this->basket->creditCard->owner = $data;
		return $this;
	}

	public function setCreditCardNumber($data)
	{
		$this->basket->creditCard->number = $data;
		return $this;
	}

	public function setCreditCardMonth($data)
	{
		$this->basket->creditCard->month = $data;
		return $this;
	}

	public function setCreditCardYear($data)
	{
		$this->basket->creditCard->year = $data;
		return $this;
	}

	public function setCreditCardCvv($data)
	{
		$this->basket->creditCard->ccv = $data;
		return $this;
	}

	public function setCreditCardCvvType($data)
	{
		$this->basket->creditCard->ccvType = $data;
		return $this;
	}

	public function setCashOnDelivery($data)
	{
		$this->basket->cashOnDelivery = $data;
		return $this;
	}

	public function setCashOnDeliveryType($data)
	{
		$this->basket->cashOnDelivery->type = $data;
		return $this;
	}

	public function setCashOnDeliveryDisplayName($data)
	{
		$this->basket->cashOnDelivery->displayName = $data;
		return $this;
	}

	public function setCashOnDeliveryAdditionalFee($data)
	{
		$this->basket->cashOnDelivery->additionalFee = $data;
		return $this;
	}

	public function setCashOnDeliveryDescription($data)
	{
		$this->basket->cashOnDelivery->description = $data;
		return $this;
	}

	public function setCashOnDeliveryIsSMSVerification($data)
	{
		$this->basket->cashOnDelivery->isSMSVerification = $data;
		return $this;
	}

	public function setCashOnDeliverySMSCode($data)
	{
		$this->basket->cashOnDelivery->SMSCode = $data;
		return $this;
	}

	public function setCashOnDeliveryPhoneNumber($data)
	{
		$this->basket->cashOnDelivery->phoneNumber = $data;
		return $this;
	}

	public function setClientId($data)
	{
		$this->basket->cashOnDelivery->phoneNumber = $data;
		return $this;

	}

	public function getMethodType()
	{
		return $this->payment->methodType;

	}

	public function getType()
	{
		return $this->payment->type;

	}

	public function getDisplayName()
	{
		return $this->payment->displayName;

	}

	public function getBankCode()
	{
		return $this->payment->bankCode;

	}

	public function getInstallment()
	{
		return $this->payment->installment;

	}

	public function getAccountNumber()
	{
		return $this->payment->accountNumber;

	}

	public function getBranch()
	{
		return $this->payment->branch;

	}

	public function getIban()
	{
		return $this->payment->iban;

	}

	public function getCreditCard()
	{
		return $this->payment->creditCard;

	}

	public function getCreditCardOwner()
	{
		return $this->basket->creditCard->owner;

	}

	public function getCreditCardNumber()
	{
		return $this->payment->creditCard->number;

	}

	public function getCreditCardMonth()
	{
		return $this->payment->creditCard->month;

	}

	public function getCreditCardYear()
	{
		return $this->payment->creditCard->year;

	}

	public function getCreditCardCvv()
	{
		return $this->payment->creditCard->ccv;

	}

	public function getCreditCardCvvType()
	{
		return $this->payment->creditCard->ccvType;

	}

	public function getCashOnDelivery()
	{
		return $this->payment->cashOnDelivery;

	}

	public function getCashOnDeliveryType()
	{
		return $this->payment->cashOnDelivery->type;

	}

	public function getCashOnDeliveryDisplayName()
	{
		return $this->payment->cashOnDelivery->displayName;

	}

	public function getCashOnDeliveryAdditionalFee()
	{
		return $this->payment->cashOnDelivery->additionalFee;

	}

	public function getCashOnDeliveryDescription()
	{
		return $this->payment->cashOnDelivery->description;

	}

	public function getCashOnDeliveryIsSMSVerification()
	{
		return $this->payment->cashOnDelivery->isSMSVerification;

	}

	public function getCashOnDeliverySMSCode()
	{
		return $this->payment->cashOnDelivery->SMSCode;

	}

	public function getCashOnDeliveryPhoneNumber()
	{
		return $this->payment->cashOnDelivery->phoneNumber;

	}

	public function getPaypal()
	{
		return $this->payment->paypal;

	}

	public function getClientId()
	{
		return $this->payment->payment->clienId;
	}

	public function getContract()
	{
		return $this->contract;
	}

	public function getContractData()
	{
		return $this->contract->data;
	}

	public function getShippingContract()
	{
		return $this->contract->shippingContract;
	}

	public function setContract($data)
	{
		$result = $this->contract = (object)array();

		return $result;
	}

	public function setContractData($data)
	{
		$result = $this->contract->data = $data;
		return $result;
	}

	public function setShippingContract($data)
	{

		$result = $this->contract->shippingContract = $data;
		return $result;
	}
}
