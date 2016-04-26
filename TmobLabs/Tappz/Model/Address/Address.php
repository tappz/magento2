<?php

namespace TmobLabs\Tappz\Model\Address;

use TmobLabs\Tappz\API\Data\AddressInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

abstract class Address extends AbstractExtensibleObject implements AddressInterface {

    protected $address;
    
    public function setAddresses($addresses) {
        $this->address = $addresses;
        return $this;
    }

    
    public function setAccessToken($token = null) {
        $this->profile->accessToken = $token;
        return $this;
    }

    public function getAddressId() {
        return $this->address->id;
    }

    public function getAddressName() {
        return $this->address->addressName;
    }

    public function getAddressCustomerName() {
        return $this->address->getFirstname();
    }

    public function getAddressCustomerSurname() {
        return $this->address->getLastname();
    }

    public function getAddressCustomerEmail() {
        return $this->profile->getEmail();
    }

    public function getAddressLine() {
        return implode($this->address->getStreet());
    }

    public function getAddressCountry() {
        return $this->address->getCountryId();
    }

    public function getAddressCountryCode() {
        return $this->address->getCountryId();
    }

    public function getAddressState() {
        return "";
    }

    public function getAddressStateCity() {
        return $this->address->getCity();
    }

    public function getAddressStateCode() {
        return $this->address->getRegion();
    }

    public function getAddressStateDistrict() {
        return "";
    }

    public function getAddressDistrictCode() {
        return "";
    }

    public function getAddressTown() {
        return "";
    }

    public function getAddressTownCode() {
        return "";
    }

    public function getAddressCompanyTitle() {
        return $this->address->getCompany();
    }

    public function getAddressCorporate() {
        return $this->address->getCompany();
    }

    public function getTaxNo() {
        return "";
    }

    public function getAddressPhoneNumber() {
        return $this->address->getPhoneNumber();
    }

    public function getIdentityNo() {
        return "";
    }

    public function getZipCode() {
        return $this->address->getPostcode();
    }

    

}
