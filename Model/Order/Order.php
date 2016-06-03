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
    protected $_order;

    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->_order;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setOrders($data)
    {
        $this->_order = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->_order->orderId;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setOrderId($data)
    {
        $this->_order->orderId = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrackingNumber()
    {
        return $this->_order->trackingNumber;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTrackingNumber($data)
    {
        $this->_order->trackingNumber = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->_order->orderDate;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setOrderDate($data)
    {
        $this->_order->orderDate = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingStatus()
    {
        return $this->_order->shippingStatus;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingStatus($data)
    {
        $this->_order->shippingStatus = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->_order->paymentStatus;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPaymentStatus($data)
    {
        $this->_order->paymentStatus = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setIpAddress($data)
    {
        $this->_order->ipAddress = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->_order->ipAddress;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setLines($data)
    {
        $this->_order->lines = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLines()
    {
        return $this->_order->lines;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDelivery($data)
    {
        $this->_order->delivery = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDelivery()
    {
        return $this->_order->delivery;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPayment($data)
    {
        $this->_order->payment = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->_order->payment;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCurrency($data)
    {
        $this->_order->currency = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->_order->currency;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setItemsPriceTotal($data)
    {
        $this->_order->priceTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemsPriceTotal()
    {
        return $this->_order->priceTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDiscountTotal($data)
    {
        $this->_order->discountTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountTotal()
    {
        return $this->_order->discountTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setSubTotal($data)
    {
        $this->_order->subTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->_order->subTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotal($data)
    {
        $this->_order->shippingTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingTotal()
    {
        return $this->_order->shippingTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotal($data)
    {
        $this->_order->total = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->_order->total;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTaxTotalValue($data)
    {
        $this->_order->taxTotalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxTotalValue()
    {
        return $this->_order->taxTotalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotalValue($data)
    {
        $this->_order->shippingTotalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingTotalValue()
    {
        return $this->_order->shippingTotalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotalValue($data)
    {
        $this->_order->totalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalValue()
    {
        return $this->_order->totalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCanChangeAddress($data)
    {
        $this->_order->canChangeAddress = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCanChangeAddress()
    {
        return $this->_order->canChangeAddress;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setErrorCode($data)
    {
        $this->_order->errorCode = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->_order->errorCode;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setMessage($data)
    {
        $this->_order->message = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_order->message;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUserFriendly($data)
    {
        $this->_order->userFriendly = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserFriendly()
    {
        return $this->_order->userFriendly;
    }
}
