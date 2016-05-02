<?php

namespace TmobLabs\Tappz\Model\Order;

use TmobLabs\Tappz\API\Data\OrderInterface;
use Magento\Store\Model\StoreManagerInterface as StoreManagerInterface;

class OrderCollector extends OrderFill implements OrderInterface {

    protected $objectManager;

    public function __construct(StoreManagerInterface $storeManager
    ) {
        parent::__construct($storeManager);
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    public function getCountries() {
        $countries = $this->objectManager->get('Magento\Directory\Model\Country')->getResourceCollection()
                ->loadByStore()
                ->toOptionArray(true);
        $result = array();
        $this->location = (object) array();
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

    public function getStates($countryId) {

        $states = $this->objectManager->get('Magento\Directory\Model\Country')->load($countryId)->getRegions()->toOptionArray(true);

        $this->location = (object) array();
        $result = array();
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

    public function getCities($countryId) {

        $states = $this->objectManager->get('Magento\Directory\Model\Country')->load($countryId)->getRegions()->toOptionArray(true);
        $result = array();
        $this->location = (object) array();
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

    public function getDistricts($cityId) {

        $this->location = (object) array();
        $this->setCode("");
        $this->setName("");
        $result = array();
        $this->setCodeAndName($result);
        return $this->fillDistricts();
    }

    public function getTowns($districtId) {
        $this->location = (object) array();
        $this->setDefaultCode("");
        $this->setDefaultName("");
        $result = array();
        $this->setCodeAndName($result);
        return $this->fillTowns();
    }

}
