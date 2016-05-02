<?php

namespace TmobLabs\Tappz\Model\Order;

use TmobLabs\Tappz\API\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface {

    private $locationCollector;

    public function __construct(
    OrderCollector $locationCollector
    ) {
        $this->locationCollector = $locationCollector;
    }

    public function getCountries() {
        $result = $this->locationCollector->getCountries();
        return $result;
    }

    public function getStates($countryId) {
        $result = $this->locationCollector->getStates($countryId);
        return $result;
    }

    public function getCities($countryId) {
        $result = $this->locationCollector->getCities($countryId);
        return $result;
    }

    public function getDistricts($cityId) {
        $result = $this->locationCollector->getDistricts($cityId);
        return $result;
    }

    public function getTowns($districtId) {
        $result = $this->locationCollector->getTowns($districtId);
        return $result;
    }

}
