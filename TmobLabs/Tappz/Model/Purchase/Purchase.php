<?php

namespace TmobLabs\Tappz\Model\Purchase;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\PurchaseInterface;

class Purchase extends AbstractExtensibleObject implements PurchaseInterface
{
	protected $purchase;

	public function getPurchases()
	{
		return $this->purchase;
	}

	public function setPurchases($data)
	{
		$this->purchase = $data;
		return $this;
	}

	public function getPurchaseId()
	{
		return $this->purchase->purchaseId;
	}

	public function setPurchaseId($data)
	{
		$this->purchase->purchaseId = $data;
		return $this;
	}

	public function getTrackingNumber()
	{
		return $this->purchase->trackingNumber;
	}

	public function setTrackingNumber($data)
	{
		$this->purchase->trackingNumber = $data;
		return $this;
	}

	public function getOrderDate()
	{
		return $this->purchase->orderDate;
	}

	public function setOrderDate($data)
	{
		$this->purchase->orderDate = $data;
		return $this;
	}

	public function getShippingStatus()
	{
		return $this->purchase->shippingStatus;
	}

	public function setShippingStatus($data)
	{
		$this->purchase->shippingStatus = $data;
		return $this;
	}

	public function getPaymentStatus()
	{
		return $this->purchase->paymentStatus;
	}

	public function setPaymentStatus($data)
	{
		$this->purchase->paymentStatus = $data;
		return $this;
	}

	public function setIpAddress($data)
	{
		$this->purchase->ipAddress = $data;
		return $this;
	}

	public function getIpAddress()
	{
		return $this->purchase->ipAddress;
	}

	public function setLines($data)
	{
		$this->purchase->lines = $data;
		return $this;
	}

	public function getLines()
	{
		return $this->purchase->lines;
	}

	public function setDelivery($data)
	{
		$this->purchase->delivery = $data;
		return $this;
	}

	public function getDelivery()
	{
		return $this->purchase->delivery;
	}

	public function setPayment($data)
	{
		$this->purchase->payment = $data;
		return $this;
	}

	public function getPayment()
	{
		return $this->purchase->payment;
	}

	public function setCurrency($data)
	{
		$this->purchase->currency = $data;
		return $this;
	}

	public function getCurrency()
	{
		return $this->purchase->currency;
	}

	public function setItemsPriceTotal($data)
	{
		$this->purchase->priceTotal = $data;
		return $this;
	}

	public function getItemsPriceTotal()
	{
		return $this->purchase->priceTotal;
	}

	public function setDiscountTotal($data)
	{
		$this->purchase->discountTotal = $data;
		return $this;
	}

	public function getDiscountTotal()
	{
		return $this->purchase->discountTotal;
	}

	public function setSubTotal($data)
	{
		$this->purchase->subTotal = $data;
		return $this;
	}

	public function getSubTotal()
	{
		return $this->purchase->subTotal;
	}

	public function setShippingTotal($data)
	{
		$this->purchase->shippingTotal = $data;
		return $this;
	}

	public function getShippingTotal()
	{
		return $this->purchase->shippingTotal;
	}

	public function setTotal($data)
	{
		$this->purchase->total = $data;
		return $this;
	}

	public function getTotal()
	{
		return $this->purchase->total;
	}

	public function setTaxTotalValue($data)
	{
		$this->purchase->taxTotalValue = $data;
		return $this;
	}

	public function getTaxTotalValue()
	{
		return $this->purchase->taxTotalValue;
	}

	public function setShippingTotalValue($data)
	{
		$this->purchase->shippingTotalValue = $data;
		return $this;
	}

	public function getShippingTotalValue()
	{
		return $this->purchase->shippingTotalValue;
	}

	public function setTotalValue($data)
	{
		$this->purchase->totalValue = $data;
		return $this;
	}

	public function getTotalValue()
	{
		return $this->purchase->totalValue;
	}

	public function setCanChangeAddress($data)
	{
		$this->purchase->canChangeAddress = $data;
		return $this;
	}

	public function getCanChangeAddress()
	{
		return $this->purchase->canChangeAddress;
	}

	public function setErrorCode($data)
	{
		$this->purchase->errorCode = $data;
		return $this;
	}

	public function getErrorCode()
	{
		return $this->purchase->errorCode;
	}

	public function setMessage($data)
	{
		$this->purchase->message = $data;
		return $this;
	}

	public function getMessage()
	{
		return $this->purchase->message;
	}

	public function setUserFriendly($data)
	{
		$this->purchase->userFriendly = $data;
		return $this;
	}

	public function getUserFriendly()
	{
		return $this->purchase->userFriendly;
	}
}
