<?php

namespace TmobLabs\Tappz\Model\Address;

use TmobLabs\Tappz\Model\Address\Address;

class AddressFill extends Address {

    protected $_storeManager;

    public function __construct(
    \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }
    public function fillAddress() {
        return [
            'id' => $this->getId(),
            'addressName' => $this->getName(),
            'name' => $this->getCustomerName(),
            'surname' => $this->getCustomerSurname(),
            'email' => $this->getAddressCustomerEmail(),
            'addressLine' => $this->getLine(),
            'country' => $this->getCountry(),
            'countryCode' => $this->getCountryCode(),
            'state' => $this->getState(),
            'stateCode' => $this->getStateCode(),
            'city' => $this->getCity(),
            'cityCode' => $this->getCityCode(),
            'district' => $this->getDistrict(),
            'districtCode' => $this->getDistrictCode(),
            'town' => $this->getTown(),
            'townCode' => $this->getTownCode(),
            'corporate' => $this->getCorporate(),
            'companyTitle' => $this->getCorporateTitle(),
            'taxDepartment' => $this->getTaxDepartment(),
            'taxNo' => $this->getTaxNo(),
            'phoneNumber' => $this->getPhoneNumber(),
            'identityNo' => $this->getIdentityNo(),
            'zipCode' => $this->getZipCode(),
            'usCheckoutCity' => $this->getUsCheckoutCity(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

}
