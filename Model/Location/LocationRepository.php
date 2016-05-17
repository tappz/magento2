<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Location;

use TmobLabs\Tappz\API\LocationRepositoryInterface;

/**
 * Class LocationRepository.
 */
class LocationRepository implements LocationRepositoryInterface
{
    /**
     * @var LocationCollector
     */
    private $locationCollector;

    /**
     * LocationRepository constructor.
     *
     * @param LocationCollector $locationCollector
     */
    public function __construct(
        LocationCollector $locationCollector
    ) {
        $this->locationCollector = $locationCollector;
    }

    /**
     * @return array
     */
    public function getCountries()
    {
        $result = $this->locationCollector->getCountries();

        return $result;
    }

    /**
     * @param $countryId
     *
     * @return array
     */
    public function getStates($countryId)
    {
        $result = $this->locationCollector->getStates($countryId);

        return $result;
    }

    /**
     * @param $countryId
     *
     * @return array
     */
    public function getCities($countryId)
    {
        $result = $this->locationCollector->getCities($countryId);

        return $result;
    }

    /**
     * @param $cityId
     *
     * @return array
     */
    public function getDistricts($cityId)
    {
        $result = $this->locationCollector->getDistricts($cityId);

        return $result;
    }

    /**
     * @param $districtId
     *
     * @return array
     */
    public function getTowns($districtId)
    {
        $result = $this->locationCollector->getTowns($districtId);

        return $result;
    }
}
