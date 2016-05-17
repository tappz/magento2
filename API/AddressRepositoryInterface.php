<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API;

/**
 * Interface AddressRepositoryInterface.
 */
interface AddressRepositoryInterface
{
    /**
     * @return mixed
     */
    public function createAddress();

    /**
     * @return mixed
     */
    public function editAddress();

    /**
     * @return mixed
     */
    public function deleteAddress();
}
