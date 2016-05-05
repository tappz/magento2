<?php

namespace TmobLabs\Tappz\Model\Purchase;

use TmobLabs\Tappz\Model\Purchase\Purchase;

class PurchaseFill extends Purchase {

    public function fillPurchase() {
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
