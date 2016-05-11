<?php
namespace TmobLabs\Tappz\Model\Order;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\OrderInterface;

class Order extends AbstractExtensibleObject implements OrderInterface
{
	protected $order;

	public function getOrders()
	{
		return $this->order;
	}

	public function setOrders($data)
	{
		$this->order = $data;
		return $this;
	}

	public function getOrderId()
	{
		return $this->order->orderId;
	}

	public function setOrderId($data)
	{
		$this->order->orderId = $data;
		return $this;
	}

	public function getTrackingNumber()
	{
		return $this->order->trackingNumber;
	}

	public function setTrackingNumber($data)
	{
		$this->order->trackingNumber = $data;
		return $this;
	}

	public function getOrderDate()
	{
		return $this->order->orderDate;
	}

	public function setOrderDate($data)
	{
		$this->order->orderDate = $data;
		return $this;
	}

	public function getShippingStatus()
	{
		return $this->order->shippingStatus;
	}

	public function setShippingStatus($data)
	{
		$this->order->shippingStatus = $data;
		return $this;
	}

	public function getPaymentStatus()
	{
		return $this->order->paymentStatus;
	}

	public function setPaymentStatus($data)
	{
		$this->order->paymentStatus = $data;
		return $this;
	}

	public function setIpAddress($data)
	{
		$this->order->ipAddress = $data;
		return $this;
	}

	public function getIpAddress()
	{
		return $this->order->ipAddress;
	}

	public function setLines($data)
	{
		$this->order->lines = $data;
		return $this;
	}

	public function getLines()
	{
		return $this->order->lines;
	}

	public function setDelivery($data)
	{
		$this->order->delivery = $data;
		return $this;
	}

	public function getDelivery()
	{
		return $this->order->delivery;
	}

	public function setPayment($data)
	{
		$this->order->payment = $data;
		return $this;
	}

	public function getPayment()
	{
		return $this->order->payment;
	}

	public function setCurrency($data)
	{
		$this->order->currency = $data;
		return $this;
	}

	public function getCurrency()
	{
		return $this->order->currency;
	}

	public function setItemsPriceTotal($data)
	{
		$this->order->priceTotal = $data;
		return $this;
	}

	public function getItemsPriceTotal()
	{
		return $this->order->priceTotal;
	}

	public function setDiscountTotal($data)
	{
		$this->order->discountTotal = $data;
		return $this;
	}

	public function getDiscountTotal()
	{
		return $this->order->discountTotal;
	}

	public function setSubTotal($data)
	{
		$this->order->subTotal = $data;
		return $this;
	}

	public function getSubTotal()
	{
		return $this->order->subTotal;
	}

	public function setShippingTotal($data)
	{
		$this->order->shippingTotal = $data;
		return $this;
	}

	public function getShippingTotal()
	{
		return $this->order->shippingTotal;
	}

	public function setTotal($data)
	{
		$this->order->total = $data;
		return $this;
	}

	public function getTotal()
	{
		return $this->order->total;
	}

	public function setTaxTotalValue($data)
	{
		$this->order->taxTotalValue = $data;
		return $this;
	}

	public function getTaxTotalValue()
	{
		return $this->order->taxTotalValue;
	}

	public function setShippingTotalValue($data)
	{
		$this->order->shippingTotalValue = $data;
		return $this;
	}

	public function getShippingTotalValue()
	{
		return $this->order->shippingTotalValue;
	}

	public function setTotalValue($data)
	{
		$this->order->totalValue = $data;
		return $this;
	}

	public function getTotalValue()
	{
		return $this->order->totalValue;
	}

	public function setCanChangeAddress($data)
	{
		$this->order->canChangeAddress = $data;
		return $this;
	}

	public function getCanChangeAddress()
	{
		return $this->order->canChangeAddress;
	}

	public function setErrorCode($data)
	{
		$this->order->errorCode = $data;
		return $this;
	}

	public function getErrorCode()
	{
		return $this->order->errorCode;
	}

	public function setMessage($data)
	{
		$this->order->message = $data;
		return $this;
	}

	public function getMessage()
	{
		return $this->order->message;
	}

	public function setUserFriendly($data)
	{
		$this->order->userFriendly = $data;
		return $this;
	}

	public function getUserFriendly()
	{
		return $this->order->userFriendly;
	}
}
