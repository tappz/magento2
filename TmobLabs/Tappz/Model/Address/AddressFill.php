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
            'id' => $this->getAddressId(),
            'addressName' => $this->getAddressName(),
            'name' => $this->getAddressCustomerName(),
            'surname' => $this->getAddressCustomerSurname(),
            'email' => $this->getAddressCustomerEmail(),
            'addressLine' => $this->getAddressLine(),
            'country' => $this->getAddressCountry(),
            'countryCode' => $this->getAddressCountryCode(),
            'state' => $this->getAddressState(),
            'stateCode' => $this->getAddressStateCode(),
            'city' => $this->getAddressStateCity(),
            'cityCode' => $this->getAddressStateCode(),
            'district' => $this->getAddressStateDistrict(),
            'districtCode' => $this->getAddressDistrictCode(),
            'town' => $this->getAddressTown(),
            'townCode' => $this->getAddressTownCode(),
            'corporate' => $this->getAddressCorporate(),
            'companyTitle' => $this->getAddressCorporate(),
            'taxDepartment' => $this->getAddressId(),
            'taxNo' => $this->getTaxNo(),
            'phoneNumber' => $this->getAddressPhoneNumber(),
            'identityNo' => $this->getIdentityNo(),
            'zipCode' => $this->getZipCode(),
            'usCheckoutCity' => $this->getUsCheckoutCity(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

}
