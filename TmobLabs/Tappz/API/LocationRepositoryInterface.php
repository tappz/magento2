<?php

namespace TmobLabs\Tappz\API;

interface LocationRepositoryInterface {

    public function getCountries();

    public function getStates($countryId);

    public function getCities($countryId);

    public function getDistricts($citdyId);

    public function getTowns($districtId);
}
