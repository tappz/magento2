<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API\Data;

/**
 * Interface LinesInterface.
 */
interface LinesInterface
{
    /**
     * @return string
     */
    public function getProductId();

    /**
     * @return string
     */
    public function getProduct();

    /**
     * @return string
     */
    public function getQuantity();

    /**
     * @return string
     */
    public function getPlacedPrice();

    /**
     * @return string
     */
    public function getPlacedPriceTotal();

    /**
     * @return string
     */
    public function getExtendedPrice();

    /**
     * @return string
     */
    public function getExtendedPriceValue();

    /**
     * @return string
     */
    public function getExtendedPriceTotal();

    /**
     * @return string
     */
    public function getExtendedPriceTotalValue();

    /**
     * @return string
     */
    public function getStrikeoutPrice();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @return string
     */
    public function getAverageDeliveryDays();

    /**
     * @return string
     */
    public function variants();
}
