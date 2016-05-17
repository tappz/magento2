<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API\Data;

/**
 * Interface IndexInterface.
 */
interface IndexInterface
{
    /**
     *  Return array.
     */
    public function getGroups();

    /**
     * Return array.
     */
    public function getAds();

    /**
     * Return string.
     */
    public function getErrorCode();

    /**
     *  Return string.
     */
    public function getMessage();

    /**
     * Return string.
     */
    public function getUserFriendly();
}
