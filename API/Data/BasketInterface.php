<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API\Data;

/**
 * Interface BasketInterface.
 */
interface BasketInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $quoteID
     *
     * @return mixed
     */
    public function getLines($quoteID);

    /**
     * @return mixed
     */
    public function getLine();

    /**
     * @return mixed
     */
    public function getShippingMethods();

    /**
     * @return mixed
     */
    public function getDelivery();

    /**
     * @return mixed
     */
    public function getPaymentOptions();

    /**
     * @return mixed
     */
    public function getPayment();

    /**
     * @return mixed
     */
    public function getCurrency();

    /**
     * @return mixed
     */
    public function getItemsPriceTotal();

    /**
     * @return mixed
     */
    public function getSubTotal();

    /**
     * @return mixed
     */
    public function getBeforeTaxTotal();

    /**
     * @return mixed
     */
    public function getTaxTotal();

    /**
     * @return mixed
     */
    public function getShippingTotal();

    /**
     * @return mixed
     */
    public function getTotal();

    /**
     * @return mixed
     */
    public function getErrors();

    /**
     * @return mixed
     */
    public function getGiftCheques();

    /**
     * @return mixed
     */
    public function getSpentGiftChequeTotal();

    /**
     * @return mixed
     */
    public function getDiscounts();

    /**
     * @return mixed
     */
    public function getUsedPoints();

    /**
     * @return mixed
     */
    public function getUsedPointsAmount();

    /**
     * @return mixed
     */
    public function getRewardPoints();

    /**
     * @return mixed
     */
    public function getPaymentFee();

    /**
     * @return mixed
     */
    public function getEstimatedSupplyDate();

    /**
     * @return mixed
     */
    public function getIsGiftWrappingEnabled();

    /**
     * @return mixed
     */
    public function getGiftWrapping();

    /**
     * @return mixed
     */
    public function getExpirationTime();

    /**
     * @return mixed
     */
    public function getErrorCode();

    /**
     * @return mixed
     */
    public function getMessage();

    /**
     * @return mixed
     */
    public function getUserFriendly();
}
