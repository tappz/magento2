<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Address;

/**
 * Class AddressFill.
 */
class AddressFill extends Address
{
    /**
     * @return array
     */
    public function fillAddress()
    {
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
