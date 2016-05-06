<?php

namespace TmobLabs\Tappz\Model\Address;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\AddressInterface;

class Address extends AbstractExtensibleObject implements AddressInterface
{
	public function get()
	{
		return $this->address;
	}

	public function set($address)
	{
		$this->address = $address;
		return $this;
	}

	public function getId()
	{
		return $this->address->id;
	}

	public function setId($id)
	{
		$this->address->id = $id;
		return $this;
	}

	public function getName()
	{
		return $this->address->name;
	}

	public function setName($name)
	{
		$this->address->name = $name;
		return $this;
	}

	public function getCustomerName()
	{
		return $this->address->firstname;
	}

	public function setCustomerName($firstname)
	{
		$this->address->firstname = $firstname;
		return $this;
	}

	public function getCustomerSurname()
	{
		return $this->address->surname;
	}

	public function setCustomerSurname($surname)
	{
		$this->address->surname = $surname;
		return $this;
	}

	public function getAddressCustomerEmail()
	{
		return $this->address->customerEmail;
	}

	public function setAddressCustomerEmail($customerEmail)
	{
		$this->address->customerEmail = $customerEmail;
		return $this;
	}

	public function getLine()
	{
		return $this->address->line;
	}

	public function setLine($line)
	{
		$this->address->line = $line;
		return $this;
	}

	public function getCountry()
	{
		return $this->address->country;
	}

	public function getCountryCode()
	{
		return $this->address->countryCode;
	}

	public function getState()
	{
		return $this->address->state;
	}

	public function getStateCode()
	{
		return $this->address->stateCode;
	}

	public function getDistrict()
	{
		return $this->address->district;
	}

	public function getDistrictCode()
	{
		return $this->address->districtCode;
	}

	public function getTown()
	{
		return $this->address->town;
	}

	public function getCity()
	{
		return $this->address->city;
	}

	public function getCityCode()
	{
		return $this->address->cityCode;
	}

	public function getTownCode()
	{
		return $this->address->townCode;
	}

	public function getCorporate()
	{
		return $this->address->corporate;
	}

	public function getCorporateTitle()
	{
		return $this->address->corporateTitle;
	}

	public function getTaxDepartment()
	{
		return $this->address->taxDepartment;
	}

	public function getTaxNo()
	{
		return $this->address->taxNo;
	}

	public function getPhoneNumber()
	{
		return $this->address->phoneNumber;
	}

	public function getIdentityNo()
	{
		return $this->address->IdentityNo;
	}

	public function getZipCode()
	{
		return $this->address->zipCode;
	}

	public function getUsCheckoutCity()
	{
		return $this->address->usCheckoutCity;
	}

	public function getErrorCode()
	{
		return $this->address->errorCode;
	}

	public function getMessage()
	{
		return $this->address->message;
	}

	public function getUserFriendly()
	{
		return $this->address->userFriendly;
	}

	public function setCountry($country)
	{
		$this->address->country = $country;
		return $this;
	}

	public function setCountryCode($countryCode)
	{
		$this->address->countryCode = $countryCode;
		return $this;
	}

	public function setState($state)
	{
		$this->address->state = $state;
		return $this;
	}

	public function setStateCode($stateCode)
	{
		$this->address->stateCode = $stateCode;
		return $this;
	}

	public function setDistrict($district)
	{
		$this->address->district = $district;
		return $this;
	}

	public function setDistrictCode($districtCode)
	{
		$this->address->districtCode = $districtCode;
		return $this;
	}

	public function setTown($town)
	{
		$this->address->town = $town;
		return $this;
	}

	public function setCity($city)
	{
		$this->address->city = $city;
		return $this;
	}

	public function setCityCode($cityCode)
	{
		$this->address->cityCode = $cityCode;
		return $this;
	}

	public function setTownCode($townCode)
	{
		$this->address->townCode = $townCode;
		return $this;
	}

	public function setCorporate($corporate)
	{
		$this->address->corporate = $corporate;
		return $this;
	}

	public function setCorporateTitle($corporateTitle)
	{
		$this->address->corporateTitle = $corporateTitle;
		return $this;
	}

	public function setTaxNo($taxno)
	{
		$this->address->taxNo = $taxno;
		return $this;
	}

	public function setPhoneNumber($phone)
	{
		$this->address->phoneNumber = $phone;
		return $this;
	}

	public function setIdentityNo($identityNo)
	{
		$this->address->IdentityNo = $identityNo;
		return $this;
	}

	public function setZipCode($zipCode)
	{
		$this->address->zipCode = $zipCode;
		return $this;
	}

	public function setUsCheckoutCity($usCheckout)
	{
		$this->address->usCheckoutCity = $usCheckout;
		return $this;
	}

	public function setErrorCode($errorCode)
	{
		$this->address->errorCode = $errorCode;
		return $this;
	}

	public function setMessage($message)
	{
		$this->address->message = $message;

		return $this;
	}

	public function setUserFriendly($userFriendly)
	{
		$this->address->userFriendly = $userFriendly;
		return $this;
	}

	public function setTaxDepartment($taxDepartment)
	{
		$this->address->taxDepartment = $taxDepartment;
		return $this;
	}


}
