<?php

namespace TmobLabs\Tappz\Model\Location;

use TmobLabs\Tappz\API\LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface {

    private $locationCollector;

    public function __construct(
    LocationCollector $locationCollector
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
