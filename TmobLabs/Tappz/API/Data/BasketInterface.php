<?php

namespace TmobLabs\Tappz\API\Data;


interface BasketInterface  {

    public function getId();

    public function getLines($quoteID);

    public function getLine();

    public function getShippingMethods();

    public function getDelivery();

    public function getPaymentOptions();

    public function getPayment();

    public function getCurrency();

    public function getItemsPriceTotal();

    public function getSubTotal();

    public function getBeforeTaxTotal();

    public function getTaxTotal();

    public function getShippingTotal();

    public function getTotal();

    public function getErrors();

    public function getGiftCheques();

    public function getSpentGiftChequeTotal();

    public function getDiscounts();

    public function getUsedPoints();

    public function getUsedPointsAmount();

    public function getRewardPoints();

    public function getPaymentFee();

    public function getEstimatedSupplyDate();

    public function getIsGiftWrappingEnabled();

    public function getGiftWrapping();

    public function getExpirationTime();

    public function getErrorCode();

    public function getMessage();

    public function getUserFriendly();
}
