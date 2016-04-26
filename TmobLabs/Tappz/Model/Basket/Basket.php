<?php

namespace TmobLabs\Tappz\Model\Basket;

use TmobLabs\Tappz\API\Data\BasketInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Basket extends AbstractExtensibleObject implements BasketInterface {

    protected $basket;

    public function getBasket() {
        return $this->product;
    }

    public function getAverageDeliveryDays() {
        return $this->basket->averageDeliveryDays;
    }

    public function getBeforeTaxTotal() {
        return $this->basket->beforeTaxTotal;
    }

    public function getCurrency() {
        return $this->basket->currency;
    }

    public function getDelivery() {
        return $this->basket->delivery;
    }

    public function getDiscounts() {
        return $this->basket->discounts;
    }

    public function getDiscountTotal() {
        return $this->basket->discountTotal;
    }
    
    public function getDiscountDisplayName() {
        return $this->basket->discountDisplayName ;
        
    }

    public function getDiscountPromoCode() {
       return  $this->basket->discountPromoCode;
      
    }

    public function getErrorCode() {
        return $this->basket->errorCode;
    }

    public function getErrors() {
        return $this->basket->errors;
    }

    public function getEstimatedSupplyDate() {
        return $this->basket->estimatedSupplyDate;
    }

    public function getExpirationTime() {
        return $this->basket->expirationTime;
    }

    public function getExtendedPrice() {
        return $this->basket->extendedPrice;
    }

    public function getExtendedPriceTotal() {
        return $this->basket->extendedPriceTotal;
    }

    public function getExtendedPriceTotalValue() {
        return $this->basket->extendedPriceTotalValue;
    }

    public function getExtendedPriceValue() {
        return $this->basket->extendedPriceValue;
    }

    public function getGiftCheques() {
        return $this->basket->giftCheques;
    }

    public function getGiftWrapping() {
        return $this->basket->giftWrapping;
    }

    public function getId() {
        return $this->basket->id;
    }

    public function getIsGiftWrappingEnabled() {
        return $this->basket->isGiftWrappingEnabled;
    }

    public function getItemsPriceTotal() {
        return $this->basket->itemsPriceTotal;
    }

    public function getLine() {
        return $this->basket->lines;
    }

    public function getMessage() {
        return $this->basket->message;
    }

    public function getPayment() {
        return $this->basket->payment;
    }

    public function getPaymentFee() {
        return $this->basket->paymentFee;
    }

    public function getPaymentOptions() {
        return $this->basket->paymentOptions;
    }

    public function getPlacedPrice() {
        return $this->basket->placedPrice;
    }

    public function getPlacedPriceTotal() {
        return $this->basket->placedPriceTotal;
    }

    public function getProduct() {
        return $this->basket->product;
    }

    public function getProductId() {
        return $this->basket->productId;
    }

    public function getQuantity() {
        return $this->basket->quantity;
    }

    public function getRewardPoints() {
        return $this->basket->rewardPoints;
    }

    public function getShippingMethods() {
        return $this->basket->shippingMethods;
    }

    public function getShippingTotal() {
        return $this->basket->shippingTotal;
    }

    public function getSpentGiftChequeTotal() {
        return $this->basket->spentGiftChequeTotal;
    }

    public function getStatus() {
        return $this->basket->status;
    }

    public function getStrikeoutPrice() {
        return $this->basket->strikeoutPrice;
    }

    public function getSubTotal() {
        return $this->basket->subtotal;
    }

    public function getTaxTotal() {
        return $this->basket->taxTotal;
    }

    public function getTotal() {
        return $this->basket->total;
    }

    public function getUsedPoints() {
        return $this->basket->usedPoints;
    }

    public function getUsedPointsAmount() {
        return $this->basket->usedPointsAmount;
    }

    public function getUserFriendly() {
        return $this->basket->userFriendly;
    }

    public function getLines($id) {

        return $this->basket->lines;
    }

    public function setAverageDeliveryDays($data) {
        $this->basket->averageDeliveryDays = $data;
        return $this;
    }

    public function setBeforeTaxTotal($data) {
        $this->basket->beforeTaxTotal = $data;

        return $this;
    }

    public function setCurrency($data) {
        $this->basket->currency = $data;

        return $this;
    }

    public function setDelivery($data) {
        $this->basket->delivery = $data;

        return $this;
    }

    public function setDiscounts($data) {
        $this->basket->discounts = $data;

        return $this;
    }

    public function setErrorCode($data) {
        $this->basket->errorCode = $data;
        return $this;
    }

    public function setErrors($data) {
        $this->basket->errors = $data;
        return $this;
    }

    public function setEstimatedSupplyDate($data) {
        $this->basket->estimatedSupplyDate = $data;
        return $this;
    }

    public function setExpirationTime($data) {
        $this->basket->expirationTime = $data;
        return $this;
    }

    public function setExtendedPrice($data = "") {
        $this->basket->extendedPrice = $data;
        return $this;
    }

    public function setExtendedPriceTotal($data) {
        $this->basket->extendedPriceTotal = $data;
        return $this;
    }

    public function setExtendedPriceTotalValue($data) {
        $this->basket->extendedPriceTotalValue = $data;
        return $this;
    }

    public function setExtendedPriceValue($data) {
        $this->basket->extendedPriceValue = $data;
        return $this;
    }

    public function setGiftCheques($data) {
        $this->basket->giftCheques = $data;
        return $this;
    }

    public function setGiftWrapping($data) {
        $this->basket->giftWrapping = $data;
        return $this;
    }

    public function setId($data) {
        $this->basket->id = $data;
        return $this;
    }

    public function setIsGiftWrappingEnabled($data) {
        $this->basket->isGiftWrappingEnabled = $data;
        return $this;
    }

    public function setItemsPriceTotal($data) {
        $this->basket->itemsPriceTotal = $data;
        return $this;
    }

    public function setLine($data) {
        $this->basket->lines = $data;
        return $this;
    }

    public function setMessage($data) {
        $this->basket->message = $data;
        return $this;
    }

    public function setPayment($data) {
        $this->basket->payment = $data;
        return $this;
    }

    public function setPaymentFee($data) {
        $this->basket->paymentFee = $data;
        return $this;
    }

    public function setPaymentOptions($data) {
        $this->basket->paymentOptions = $data;
        return $this;
    }

    public function setPlacedPrice($data) {
        $this->basket->placedPrice = $data;
        return $this;
    }

    public function setPlacedPriceTotal($data) {
        $this->basket->placedPriceTotal = $data;
        return $this;
    }

    public function setProduct($data) {
        $this->basket->product = $data;
        return $this;
    }

    public function setProductId($data) {
        $this->basket->productId = $data;
        return $this;
    }

    public function setQuantity($data) {
        $this->basket->quantity = $data;
        return $this;
    }

    public function setRewardPoints($data) {
        $this->basket->rewardPoints = $data;
        return $this;
    }

    public function setShippingMethods($data) {
        $this->basket->shippingMethods = $data;
        return $this;
    }

    public function setShippingTotal($data) {
        $this->basket->shippingTotal = $data;
        return $this;
    }

    public function setSpentGiftChequeTotal($data) {
        $this->basket->spentGiftChequeTotal = $data;
        return $this;
    }

    public function setStatus($data) {
        $this->basket->status = $data;
        return $this;
    }

    public function setStrikeoutPrice($data) {
        $this->basket->strikeoutPrice = $data;
    }

    public function setSubTotal($data) {
        $this->basket->subtotal = $data;
        return $this;
    }

    public function setTaxTotal($data) {
        $this->basket->taxTotal = $data;
        return $this;
    }

    public function setTotal($data) {
        $this->basket->total = $data;
        return $this;
    }

    public function setUsedPoints($data) {
        $this->basket->usedPoints = $data;
        return $this;
    }

    public function setUsedPointsAmount($data) {
        $this->basket->usedPointsAmount = $data;
        return $this;
    }

    public function setUserFriendly($data) {
        $this->basket->userFriendly = $data;
        return $this;
    }

    public function setBasket($data) {
        $this->basket = $data;
        return $this;
    }

    public function setLines($lines) {

        $this->basket->lines = $lines;
        return $this;
    }

    public function setDiscountTotal($discountTotal) {
        $this->basket->discountTotal = $discountTotal;
        return $this;
    }

    public function setDiscountDisplayName($displayName) {
        $this->basket->discountDisplayName = $displayName;
        return $this;
    }

    public function setDiscountPromoCode($promeCode) {
        $this->basket->discountPromoCode = $promeCode;
        return $this;
    }

    public function getVariants() {
        return $this->basket->variants;
    }

    public function setVariants($data) {
        $this->basket->variants = $data;
        return $this;
    }

}
