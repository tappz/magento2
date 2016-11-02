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
    public $purchase;

    /**
     * @return mixed
     */
    public function getPurchases()
    {
        return $this->purchase;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPurchases($data)
    {
        $this->purchase = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPurchaseId()
    {
        return $this->purchase->purchaseId;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPurchaseId($data)
    {
        $this->purchase->purchaseId = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrackingNumber()
    {
        return $this->purchase->trackingNumber;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTrackingNumber($data)
    {
        $this->purchase->trackingNumber = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->purchase->orderDate;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setOrderDate($data)
    {
        $this->purchase->orderDate = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingStatus()
    {
        return $this->purchase->shippingStatus;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingStatus($data)
    {
        $this->purchase->shippingStatus = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->purchase->paymentStatus;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPaymentStatus($data)
    {
        $this->purchase->paymentStatus = $data;

        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setIpAddress($data)
    {
        $this->purchase->ipAddress = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return !empty($_SERVER['HTTP_CLIENT_IP']) ?
            $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setLines($data)
    {
        $this->purchase->lines = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLines()
    {
        return $this->purchase->lines;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDelivery($data)
    {
        $this->purchase->delivery = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDelivery()
    {
        return $this->purchase->delivery;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setPayment($data)
    {
        $this->purchase->payment = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->purchase->payment;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCurrency($data)
    {
        $this->purchase->currency = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->purchase->currency;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setItemsPriceTotal($data)
    {
        $this->purchase->priceTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemsPriceTotal()
    {
        return $this->purchase->priceTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDiscountTotal($data)
    {
        $this->purchase->discountTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountTotal()
    {
        return $this->purchase->discountTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setSubTotal($data)
    {
        $this->purchase->subTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->purchase->subTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotal($data)
    {
        $this->purchase->shippingTotal = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingTotal()
    {
        return $this->purchase->shippingTotal;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotal($data)
    {
        $this->purchase->total = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->purchase->total;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTaxTotalValue($data)
    {
        $this->purchase->taxTotalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxTotalValue()
    {
        return $this->purchase->taxTotalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setShippingTotalValue($data)
    {
        $this->purchase->shippingTotalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingTotalValue()
    {
        return $this->purchase->shippingTotalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setTotalValue($data)
    {
        $this->purchase->totalValue = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalValue()
    {
        return $this->purchase->totalValue;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setCanChangeAddress($data)
    {
        $this->purchase->canChangeAddress = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCanChangeAddress()
    {
        return $this->purchase->canChangeAddress;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setErrorCode($data)
    {
        $this->purchase->errorCode = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->purchase->errorCode;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setMessage($data)
    {
        $this->purchase->message = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->purchase->message;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setUserFriendly($data)
    {
        $this->purchase->userFriendly = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserFriendly()
    {
        return $this->purchase->userFriendly;
    }
}
