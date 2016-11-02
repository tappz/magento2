<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Location;

use Magento\Store\Model\StoreManagerInterface as StoreManagerInterface;
use TmobLabs\Tappz\API\Data\LocationInterface;

/**
 * Class LocationCollector.
 */
class LocationCollector extends LocationFill implements LocationInterface
{
    /**
     * @var
     */
    public $objectManager;

    /**
     * LocationCollector constructor.
     *
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($storeManager);
        $this->objectManager =
            \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * @return array
     */
    public function getCountries()
    {
        $countries = $this->
        objectManager->
        get('Magento\Directory\Model\Country')->getResourceCollection()
            ->loadByStore()
            ->toOptionArray(true);
        $result = [];
        $this->location = (object)[];
        foreach ($countries as $country) {
            if (!empty($country['label']) && !empty($country['value'])) {
                $this->setCode($country['value']);
                $this->setName($country['label']);
                $result[] = $this->fillCodeAndName();
            }
        }
        $this->setCodeAndName($result);

        return $this->fillCountries();
    }

    /**
     * @param $countryId
     *
     * @return array
     */
    public function getStates($countryId)
    {
        $states = $this->objectManager->
        get('Magento\Directory\Model\Country')->
        load($countryId)->
        getRegions()->
        toOptionArray(true);
        $this->location = (object)[];
        $result = [];
        foreach ($states as $state) {
            if (!empty($state['label']) && !empty($state['value'])) {
                $this->setCode($state['value']);
                $this->setName($state['label']);
                $result[] = $this->fillCodeAndName();
            }
        }
        $this->setCodeAndName($result);

        return $this->fillStates();
    }

    /**
     * @param $countryId
     *
     * @return array
     */
    public function getCities($countryId)
    {
        $states = $this->objectManager->
        get('Magento\Directory\Model\Country')->
        load($countryId)->
        getRegions()->
        toOptionArray(true);
        $result = [];
        $this->location = (object)[];
        foreach ($states as $state) {
            if (!empty($state['label']) && !empty($state['value'])) {
                $this->setCode($state['value']);
                $this->setName($state['label']);
                $result[] = $this->fillCodeAndName();
            }
        }
        $this->setCodeAndName($result);

        return $this->fillCities();
    }

    /**
     * @param $cityId
     *
     * @return array
     */
    public function getDistricts($cityId)
    {
        $cityId;
        $this->location = (object)[];
        $this->setCode('');
        $this->setName('');
        $result = [];
        $this->setCodeAndName($result);

        return $this->fillDistricts();
    }

    /**
     * @param $districtId
     *
     * @return array
     */
    public function getTowns($districtId)
    {
        $districtId;
        $this->location = (object)[];
        $this->setDefaultCode('');
        $this->setDefaultName('');
        $result = [];
        $this->setCodeAndName($result);
        return $this->fillTowns();
    }


 



}
