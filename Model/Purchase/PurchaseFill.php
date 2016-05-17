<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Purchase;

/**
 * Class PurchaseFill.
 */
class PurchaseFill extends Purchase
{
    /**
     * @return array
     */
    public function fillPurchase()
    {
        return [
            'id' => $this->getPurchaseId(),
            'trackingNumber' => $this->getTrackingNumber(),
            'orderDate' => $this->getOrderDate(),
            'shippingStatus' => $this->getShippingStatus(),
            'paymentStatus' => $this->getPaymentStatus(),
            'ipAddress' => $this->getIpAddress(),
            'lines' => $this->getLines(),
            'delivery' => $this->getDelivery(),
            'payment' => $this->getPayment(),
            'currency' => $this->getCurrency(),
            'itemsPriceTotal' => $this->getItemsPriceTotal(),
            'discountTotal' => $this->getDiscountTotal(),
            'subTotal' => $this->getSubtotal(),
            'shippingTotal' => $this->getShippingTotal(),
            'total' => $this->getTotal(),
            'taxTotalValue' => $this->getTaxTotalValue(),
            'shippingTotalValue' => $this->getShippingTotalValue(),
            'totalValue' => $this->getTotalValue(),
            'canChangeAddress' => $this->getCanChangeAddress(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }
}
