<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API\Data;

/**
 * Interface ProductInterface.
 */
interface ProductInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getProductName();

    /**
     * @return array
     */
    public function getListPrice();

    /**
     * @return string
     */
    public function getNoImageUrl();

    /**
     * @return array
     */
    public function getHeadline();

    /**
     * @return string
     */
    public function getStrikeoutPrice();

    /**
     * @return string
     */
    public function getIsCampaign();

    /**
     * @return string
     */
    public function getCreditCardInstallments();

    /**
     * @return string
     */
    public function getInStock();

    /**
     * @return string
     */
    public function getShipmentInformation();

    /**
     * @return string
     */
    public function getIsShipmentFree();

    /**
     * @return string
     */
    public function getFeatures();

    /**
     * @return string
     */
    public function getVariants();

    /**
     * @return string
     */
    public function getShoutOutTexts();

    /**
     * @return string
     */
    public function getActions();

    /**
     * @return string
     */
    public function getPicture();

    /**
     * @return string
     */
    public function getPictures();

    /**
     * @return string
     */
    public function getProductDetailUrl();

    /**
     * @return string
     */
    public function getProductUrl();

    /**
     * @return string
     */
    public function getPoints();

    /**
     * @return string
     */
    public function getUnit();

    /**
     * @return string
     */
    public function getIsFavorite();

    /**
     * @return string
     */
    public function getIsBackInStockSubscription();

    /**
     * @return string
     */
    public function getBackInStockSubSelectedVariant();

    /**
     * @return string
     */
    public function getAdditionalTexts();

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

    /**
     * @return string
     */
    public function fillActions();

    /**
     * @return string
     */
    public function fillProductPrice();

    /**
     * @return string
     */
    public function getProduct($product);

    /**
     * @return string
     */
    public function setProduct($product);

    /**
     * @return string
     */
    public function fillAditionalTexts();

    /**
     * @return string
     */
    public function fillBackInStockSubSelectedVariant();
}
