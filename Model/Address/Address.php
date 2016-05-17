<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Address;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\AddressInterface;

/**
 * Class Address.
 */
class Address extends AbstractExtensibleObject implements AddressInterface
{
    /**
     * @return mixed
     */
    public function get()
    {
        return $this->address;
    }

    /**
     * @param $address
     *
     * @return $this
     */
    public function set($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->address->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->address->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->address->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->address->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->address->firstname;
    }

    /**
     * @param $firstname
     *
     * @return $this
     */
    public function setCustomerName($firstname)
    {
        $this->address->firstname = $firstname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerSurname()
    {
        return $this->address->surname;
    }

    /**
     * @param $surname
     *
     * @return $this
     */
    public function setCustomerSurname($surname)
    {
        $this->address->surname = $surname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddressCustomerEmail()
    {
        return $this->address->customerEmail;
    }

    /**
     * @param $customerEmail
     *
     * @return $this
     */
    public function setAddressCustomerEmail($customerEmail)
    {
        $this->address->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->address->line;
    }

    /**
     * @param $line
     *
     * @return $this
     */
    public function setLine($line)
    {
        $this->address->line = $line;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->address->country;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->address->countryCode;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->address->state;
    }

    /**
     * @return mixed
     */
    public function getStateCode()
    {
        return $this->address->stateCode;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->address->district;
    }

    /**
     * @return mixed
     */
    public function getDistrictCode()
    {
        return $this->address->districtCode;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->address->town;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->address->city;
    }

    /**
     * @return mixed
     */
    public function getCityCode()
    {
        return $this->address->cityCode;
    }

    /**
     * @return mixed
     */
    public function getTownCode()
    {
        return $this->address->townCode;
    }

    /**
     * @return mixed
     */
    public function getCorporate()
    {
        return $this->address->corporate;
    }

    /**
     * @return mixed
     */
    public function getCorporateTitle()
    {
        return $this->address->corporateTitle;
    }

    /**
     * @return mixed
     */
    public function getTaxDepartment()
    {
        return $this->address->taxDepartment;
    }

    /**
     * @return mixed
     */
    public function getTaxNo()
    {
        return $this->address->taxNo;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->address->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getIdentityNo()
    {
        return $this->address->IdentityNo;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->address->zipCode;
    }

    /**
     * @return mixed
     */
    public function getUsCheckoutCity()
    {
        return $this->address->usCheckoutCity;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->address->errorCode;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->address->message;
    }

    /**
     * @return mixed
     */
    public function getUserFriendly()
    {
        return $this->address->userFriendly;
    }

    /**
     * @param $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->address->country = $country;

        return $this;
    }

    /**
     * @param $countryCode
     *
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->address->countryCode = $countryCode;

        return $this;
    }

    /**
     * @param $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->address->state = $state;

        return $this;
    }

    /**
     * @param $stateCode
     *
     * @return $this
     */
    public function setStateCode($stateCode)
    {
        $this->address->stateCode = $stateCode;

        return $this;
    }

    /**
     * @param $district
     *
     * @return $this
     */
    public function setDistrict($district)
    {
        $this->address->district = $district;

        return $this;
    }

    /**
     * @param $districtCode
     *
     * @return $this
     */
    public function setDistrictCode($districtCode)
    {
        $this->address->districtCode = $districtCode;

        return $this;
    }

    /**
     * @param $town
     *
     * @return $this
     */
    public function setTown($town)
    {
        $this->address->town = $town;

        return $this;
    }

    /**
     * @param $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->address->city = $city;

        return $this;
    }

    /**
     * @param $cityCode
     *
     * @return $this
     */
    public function setCityCode($cityCode)
    {
        $this->address->cityCode = $cityCode;

        return $this;
    }

    /**
     * @param $townCode
     *
     * @return $this
     */
    public function setTownCode($townCode)
    {
        $this->address->townCode = $townCode;

        return $this;
    }

    /**
     * @param $corporate
     *
     * @return $this
     */
    public function setCorporate($corporate)
    {
        $this->address->corporate = $corporate;

        return $this;
    }

    /**
     * @param $corporateTitle
     *
     * @return $this
     */
    public function setCorporateTitle($corporateTitle)
    {
        $this->address->corporateTitle = $corporateTitle;

        return $this;
    }

    /**
     * @param $taxno
     *
     * @return $this
     */
    public function setTaxNo($taxno)
    {
        $this->address->taxNo = $taxno;

        return $this;
    }

    /**
     * @param $phone
     *
     * @return $this
     */
    public function setPhoneNumber($phone)
    {
        $this->address->phoneNumber = $phone;

        return $this;
    }

    /**
     * @param $identityNo
     *
     * @return $this
     */
    public function setIdentityNo($identityNo)
    {
        $this->address->IdentityNo = $identityNo;

        return $this;
    }

    /**
     * @param $zipCode
     *
     * @return $this
     */
    public function setZipCode($zipCode)
    {
        $this->address->zipCode = $zipCode;

        return $this;
    }

    /**
     * @param $usCheckout
     *
     * @return $this
     */
    public function setUsCheckoutCity($usCheckout)
    {
        $this->address->usCheckoutCity = $usCheckout;

        return $this;
    }

    /**
     * @param $errorCode
     *
     * @return $this
     */
    public function setErrorCode($errorCode)
    {
        $this->address->errorCode = $errorCode;

        return $this;
    }

    /**
     * @param $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->address->message = $message;

        return $this;
    }

    /**
     * @param $userFriendly
     *
     * @return $this
     */
    public function setUserFriendly($userFriendly)
    {
        $this->address->userFriendly = $userFriendly;

        return $this;
    }

    /**
     * @param $taxDepartment
     *
     * @return $this
     */
    public function setTaxDepartment($taxDepartment)
    {
        $this->address->taxDepartment = $taxDepartment;

        return $this;
    }
}
