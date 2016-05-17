<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API;

/**
 * Interface ProfileRepositoryInterface.
 */
interface ProfileRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getUserAgreement();

    /**
     * @return mixed
     */
    public function login();

    /**
     * @return mixed
     */
    public function fblogin();

    /**
     * @return mixed
     */
    public function getProfile();

    /**
     * @return mixed
     */
    public function createProfile();

    /**
     * @return mixed
     */
    public function editProfile();
}
