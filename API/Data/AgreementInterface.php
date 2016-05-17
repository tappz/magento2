<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API\Data;

/**
 * Interface AgreementInterface.
 */
interface AgreementInterface
{
    /**
     * @return string
     */
    public function getAgreementText();

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
