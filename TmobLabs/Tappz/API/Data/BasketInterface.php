<?php

namespace TmobLabs\Tappz\API\Data;
use Magento\Framework\Api\CustomAttributesDataInterface;
interface BasketInterface extends CustomAttributesDataInterface
{
    /**
     * @return string
     */
    public function getId();
    /**
     * @return string
     */
    public function getLines();
    /**
     * @return string
     */
    public function getShippingMethods();
        /**
     * @return string
     */
    public function getDelivery();
      /**
     * @return string
     */
    public function getPaymentOptions();
          /**
     * @return string
     */
    public function getPayment();
              /**
     * @return string
     */
    public function getCurrency();
                  /**
     * @return string
     */
    public function getItemsPriceTotal();
        /**
     * @return string
     */
    public function getSubTotal();
       /**
     * @return string
     */
    public function getBeforeTaxTotal();
           /**
     * @return string
     */
    public function getTaxTotal();
     /**
     * @return string
     */
    public function getShippingTotal();
         /**
     * @return string
     */
    public function getTotal();
          /**
     * @return string
     */
    public function getErrors();
              /**
     * @return string
     */
    public function getGiftCheques();
                  /**
     * @return string
     */
    public function getSpentGiftChequeTotal();
    /**
     * @return string
     */
    public function getDiscounts();
        /**
     * @return string
     */
    public function getUsedPoints();
            /**
     * @return string
     */
    public function getUsedPointsAmount();
                /**
     * @return string
     */
    public function getRewardPoints();
                /**
     * @return string
     */
    public function getPaymentFee();
                /**
     * @return string
     */
    public function getEstimatedSupplyDate();
                    /**
     * @return string
     */
    public function getIsGiftWrappingEnabled();
                /**
     * @return string
     */
    public function getGiftWrapping();
                /**
     * @return string
     */
    public function getExpirationTime();
    
                    /**
     * @return string
     */
    public function getErrorCode();
                /**
     * @return string
     */
    public function getMessage();
                    /**
     * @return string
     */
    public function getUserFriendly();
    
}