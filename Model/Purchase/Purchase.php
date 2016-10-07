<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Purchase;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\PurchaseInterface;

/**
 * Class Purchase.
 */
class Purchase extends AbstractExtensibleObject implements PurchaseInterface
{
    /**
     * @var
     */
    protected $_purchase;

    /**
     * @return mixed
     */
    public function getPurchases()
    {
        return $this->_purchase;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPurchases($data)
    {
        $this->_purchase = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPurchaseId()
    {
        return $this->_purchase->purchaseId;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPurchaseId($data)
    {
        $this->_purchase->purchaseId = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrackingNumber()
    {
        return $this->_purchase->trackingNumber;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTrackingNumber($data)
    {
        $this->_purchase->trackingNumber = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->_purchase->orderDate;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setOrderDate($data)
    {
        $this->_purchase->orderDate = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingStatus()
    {
        return $this->_purchase->shippingStatus;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingStatus($data)
    {
        $this->_purchase->shippingStatus = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->_purchase->paymentStatus;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPaymentStatus($data)
    {
        $this->_purchase->paymentStatus = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setIpAddress($data)
    {
        $this->_purchase->ipAddress = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->_purchase->ipAddress;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setLines($data)
    {
        $this->_purchase->lines = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLines()
    {
        return $this->_purchase->lines;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDelivery($data)
    {
        $this->_purchase->delivery = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDelivery()
    {
        return $this->_purchase->delivery;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPayment($data)
    {
        $this->_purchase->payment = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->_purchase->payment;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCurrency($data)
    {
        $this->_purchase->currency = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->_purchase->currency;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setItemsPriceTotal($data)
    {
        $this->_purchase->priceTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemsPriceTotal()
    {
        return $this->_purchase->priceTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDiscountTotal($data)
    {
        $this->_purchase->discountTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountTotal()
    {
        return $this->_purchase->discountTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setSubTotal($data)
    {
        $this->_purchase->subTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->_purchase->subTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotal($data)
    {
        $this->_purchase->shippingTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingTotal()
    {
        return $this->_purchase->shippingTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotal($data)
    {
        $this->_purchase->total = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->_purchase->total;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTaxTotalValue($data)
    {
        $this->_purchase->taxTotalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxTotalValue()
    {
        return $this->_purchase->taxTotalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotalValue($data)
    {
        $this->_purchase->shippingTotalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingTotalValue()
    {
        return $this->_purchase->shippingTotalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotalValue($data)
    {
        $this->_purchase->totalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalValue()
    {
        return $this->_purchase->totalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCanChangeAddress($data)
    {
        $this->_purchase->canChangeAddress = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCanChangeAddress()
    {
        return $this->_purchase->canChangeAddress;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setErrorCode($data)
    {
        $this->_purchase->errorCode = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->_purchase->errorCode;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setMessage($data)
    {
        $this->_purchase->message = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_purchase->message;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUserFriendly($data)
    {
        $this->_purchase->userFriendly = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserFriendly()
    {
        return $this->_purchase->userFriendly;
    }
}
