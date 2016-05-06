<?php

namespace TmobLabs\Tappz\Model\Profile;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\ProfileInterface;

class Profile extends AbstractExtensibleObject implements ProfileInterface
{

	protected $profile;
	protected $address;
	protected $userAgreement;

	public function getId()
	{
		return $this->profile->getID();
	}

	public function getAccessToken()
	{
		return $this->profile->accessToken;
	}

	public function getFullName()
	{
		return $this->profile->getName();
	}

	public function getAccept()
	{

		return !$this->profile->isConfirmationRequired();
	}

	public function getAddresses()
	{
		return $this->profile->addresses;
	}

	public function setAddresses($addresses)
	{
		$this->profile->addresses = $addresses;
		return $this;
	}

	public function getEmail()
	{
		return $this->profile->getEmail();
	}

	public function getErrorCode()
	{
		return null;
	}

	public function getFirstName()
	{
		return $this->profile->getFirstname() . ($this->profile->getMiddleName() ? (' ' . $this->profile->getMiddleName()) : '');
	}

	public function getGender()
	{

		return $this->profile->getData("gender");
	}

	public function getIsSMSSubscribe()
	{
		return false;
	}

	public function getIsSubscribe()
	{

		return $this->profile->subscribe;
	}

	public function setIsSubscribe($subscribe)
	{
		$this->profile->subscribe = $subscribe;
		return $this;
	}

	public function getLastName()
	{
		return $this->profile->getLastname();
	}

	public function getMessage()
	{
		return null;
	}

	public function getPassword()
	{
		return "";
	}

	public function getPhone()
	{
		return $this->profile->getPhone();
	}

	public function getPoints()
	{
		return 0;
	}

	public function getUserFriendly()
	{
		return false;
	}

	public function getbirthDate()
	{
		return "";
	}

	public function getUserAgreement()
	{
		return $this->userAgreement;
	}

	public function setUserAgreement($userAgreement)
	{
		$this->userAgreement = $userAgreement;
		return $this;
	}

	public function giftCheques()
	{
		return array();
	}

	public function setProfile($profile)
	{
		$this->profile = $profile;
		return $this;
	}

	public function setAccessToken($token = null)
	{
		$this->profile->accessToken = $token;
		return $this;
	}


}
