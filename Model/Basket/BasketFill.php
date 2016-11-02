<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Basket;

/**
 * Class BasketFill.
 */
class BasketFill extends Basket
{
    /**
     * @return array
     */
    public function fillBasket()
    {
        return [
            'id' => $this->getId(),
            'lines' => $this->getLine(),
            'shippingMethods' => $this->getShippingMethods(),
            'shippingMethod' => $this->getShippingMethod(),
            'delivery' => $this->getDelivery(),
            'currency' => $this->getCurrency(),
            'shippingTotal' => $this->getShippingTotal(),
            'discountTotal' => $this->getDiscountTotal(),
            'paymentOptions' => $this->getPaymentOptions(),
            'payment' => $this->getPayment(),
            'itemsPriceTotal' => $this->getItemsPriceTotal(),
            'subTotal' => $this->getSubTotal(),
            'beforeTaxTotal' => $this->getBeforeTaxTotal(),
            'taxTotal' => $this->getTaxTotal(),
            'total' => $this->getTotal(),
            'errors' => $this->getErrors(),
            'giftCheques' => $this->getGiftCheques(),
            'spentGiftChequeTotal' => $this->getSpentGiftChequeTotal(),
            'discounts' => $this->getDiscounts(),
            'usedPoints' => $this->getUsedPoints(),
            'usedPointsAmount' => $this->getUsedPointsAmount(),
            'rewardPoints' => $this->getRewardPoints(),
            'paymentFee' => $this->getPaymentFee(),
            'estimatedSupplyDate' => $this->getEstimatedSupplyDate(),
            'isGiftWrappingEnabled' => $this->getIsGiftWrappingEnabled(),
            'giftWrapping' => $this->getGiftWrapping(),
            'expirationTime' => $this->getExpirationTime(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    /**
     * @return array
     */
    public function fillLines()
    {
        return [
            'productId' => $this->getProductId(),
            'product' => $this->getProduct(),
            'quantity' => $this->getQuantity(),
            'placedPrice' => $this->getPlacedPrice(),
            'placedPriceTotal' => $this->getPlacedPriceTotal(),
            'extendedPrice' => $this->getExtendedPrice(),
            'extendedPriceValue' => $this->getExtendedPriceValue(),
            'extendedPriceTotal' => $this->getExtendedPriceTotal(),
            'extendedPriceTotalValue' => $this->getExtendedPriceTotalValue(),
            'strikeoutPrice' => $this->getStrikeoutPrice(),
            'status' => $this->getStatus(),
            'averageDeliveryDays' => $this->getAverageDeliveryDays(),
            'variants' => $this->getVariants(),
        ];
    }

    /**
     * @return array
     */
    public function fillContract()
    {
        return [
            'contract' => $this->getContractData(),
            'shippingContract' => $this->getShippingContract(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    /**
     * @return array
     */
    public function fillDiscounts()
    {
        return [
            'displayName' => $this->getDiscountDisplayName(),
            'discountTotal' => $this->getDiscountTotal(),
            'promoCode' => $this->getDiscountPromoCode(),
        ];
    }
    public function fillGiftWrapping()
    {
        return [
            'isSelected' => $this->getGiftWrappingIsSelected(),
            'giftWrappingFee' => $this->getGiftWrappingFee(),
            'maxCharackter' => $this->getGiftWrappingCharacter(),
            'message' => $this->getGiftWrappingMessage(),
        ];
    }
}
