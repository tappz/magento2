<?php

namespace TmobLabs\Tappz\Model\Profile;

use TmobLabs\Tappz\API\Data\ProfileInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Profile extends AbstractExtensibleObject implements ProfileInterface {

    protected $profile;
    protected $address;

    public function getId() {
        return $this->profile->getID();
    }

    public function getAccessToken() {
        return $this->profile->accessToken;
    }

    public function getFullName() {
        return $this->profile->getName();
    }

    public function getAccept() {

        return !$this->profile->isConfirmationRequired();
    }

    public function getAddresses() {
        return $this->profile->addresses;
    }

    public function setAddresses($addresses) {
         $this->profile->addresses= $addresses;
         return $this;
    }

    public function getEmail() {
        return $this->profile->getEmail();
    }

    public function getErrorCode() {
        return null;
    }

    public function getFirstName() {
        return $this->profile->getFirstname() . ($this->profile->getMiddleName() ? (' ' . $this->profile->getMiddleName()) : '');
    }

    public function getGender() {
       
         return  $this->profile->getData("gender");
    }

    public function getIsSMSSubscribe() {
        return false;
    }

    public function getIsSubscribe() {

        return $this->profile->subscribe;
    }

    public function setIsSubscribe($subscribe) {
        $this->profile->subscribe = $subscribe;
        return $this;
    }

    public function getLastName() {
        return $this->profile->getLastname();
    }

    public function getMessage() {
        return null; 
    }

    public function getPassword() {
        return "";
    }

    public function getPhone() {
        return $this->profile->getPhone();
    }

    public function getPoints() {
        return 0;
    }

    public function getUserFriendly() {
        return false;
    }

    public function getbirthDate() {
        return "";
    }

    public function getUserAgreement() {
        return "Set your user Agreement Text Here ";
    }

    public function giftCheques() {
        return array();
    }

    public function setProfile($profile) {
        $this->profile = $profile;
        return $this;
    }

    public function setAccessToken($token = null) {
        $this->profile->accessToken = $token;
        return $this;
    }

    public function getAddressId() {
        return $this->address->getID();
    }

    public function getAddressName() {
        return $this->address->getName();
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

    public function getUsCheckoutCity() {
        return "";
    }

}
