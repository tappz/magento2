<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Order;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\OrderInterface;

/**
 * Class Order.
 */
class Order extends AbstractExtensibleObject implements OrderInterface
{
    /**
     * @var
     */
    public $order;

    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->order;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setOrders($data)
    {
        $this->order = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order->orderId;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setOrderId($data)
    {
        $this->order->orderId = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrackingNumber()
    {
        return $this->order->trackingNumber;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTrackingNumber($data)
    {
        $this->order->trackingNumber = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->order->orderDate;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setOrderDate($data)
    {
        $this->order->orderDate = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingStatus()
    {
        return $this->order->shippingStatus;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingStatus($data)
    {
        $this->order->shippingStatus = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->order->paymentStatus;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPaymentStatus($data)
    {
        $this->order->paymentStatus = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setIpAddress($data)
    {
        $this->order->ipAddress = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->order->ipAddress;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setLines($data)
    {
        $this->order->lines = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLines()
    {
        return $this->order->lines;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDelivery($data)
    {
        $this->order->delivery = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDelivery()
    {
        return $this->order->delivery;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPayment($data)
    {
        $this->order->payment = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->order->payment;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCurrency($data)
    {
        $this->order->currency = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->order->currency;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setItemsPriceTotal($data)
    {
        $this->order->priceTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemsPriceTotal()
    {
        return $this->order->priceTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDiscountTotal($data)
    {
        $this->order->discountTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountTotal()
    {
        return $this->order->discountTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setSubTotal($data)
    {
        $this->order->subTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->order->subTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotal($data)
    {
        $this->order->shippingTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingTotal()
    {
        return $this->order->shippingTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotal($data)
    {
        $this->order->total = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->order->total;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTaxTotalValue($data)
    {
        $this->order->taxTotalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxTotalValue()
    {
        return $this->order->taxTotalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotalValue($data)
    {
        $this->order->shippingTotalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingTotalValue()
    {
        return $this->order->shippingTotalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotalValue($data)
    {
        $this->order->totalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalValue()
    {
        return $this->order->totalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCanChangeAddress($data)
    {
        $this->order->canChangeAddress = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCanChangeAddress()
    {
        return $this->order->canChangeAddress;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setErrorCode($data)
    {
        $this->order->errorCode = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->order->errorCode;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setMessage($data)
    {
        $this->order->message = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->order->message;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUserFriendly($data)
    {
        $this->order->userFriendly = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserFriendly()
    {
        return $this->order->userFriendly;
    }
}
