<?php

namespace TmobLabs\Tappz\Model\Profile;

use TmobLabs\Tappz\Model\Profile\Profile;

class ProfileFill extends Profile {

    protected $_storeManager;

    public function __construct(
    \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }

    public function fillProfile() {
        return [
            'accessToken' => $this->getAccessToken(),
            'fullName' => $this->getFullName(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'gender' => $this->getGender(),
            'IsSubscribe' => $this->getIsSubscribe(),
            'isSMSSubscribe' => $this->getIsSMSSubscribe(),
            'birthDate' => $this->getbirthDate(),
            'accept' => $this->getAccept(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'password' => $this->getPassword(),
            'addresses' => $this->getAddresses(),
            'giftCheques' => $this->giftCheques(),
            'points' => $this->getPoints(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
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

    public function fillUserAgreement() {
        return [
            'agreementText' => $this->getUserAgreement(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    protected function fillRegisterCustomerData($data) {
      
        return [
            'firstname' => $data->firstName,
            'lastname' => $data->lastName,
            'password' => $data->password,
            'gender' => $data->gender,
            'isSubscribed' => $data->IsSubscribe,
            'email' => $data->email,
            'phone' => $data->phone,

        ];
    }

}
