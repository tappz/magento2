<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API;

/**
 * Interface LocationRepositoryInterface.
 */
interface LocationRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getCountries();

    /**
     * @param $countryId
     *
     * @return mixed
     */
    public function getStates($countryId);

    /**
     * @param $countryId
     *
     * @return mixed
     */
    public function getCities($countryId);

    /**
     * @param $citdyId
     *
     * @return mixed
     */
    public function getDistricts($citdyId);

    /**
     * @param $districtId
     *
     * @return mixed
     */
    public function getTowns($districtId);
}
