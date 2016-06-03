<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Profile;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\ProfileInterface;

/**
 * Class Profile.
 */
class Profile extends AbstractExtensibleObject implements ProfileInterface
{
    /**
     * @var
     */
    protected $_profile;
    /**
     * @var
     */
    protected $address;
    /**
     * @var
     */
    protected $_userAgreement;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_profile->getID();
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->_profile->accessToken;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->_profile->getName();
    }

    /**
     * @return bool
     */
    public function getAccept()
    {
        return !$this->_profile->isConfirmationRequired();
    }

    /**
     * @return mixed
     */
    public function getAddresses()
    {
        return $this->_profile->addresses;
    }

    /**
     * @param $addresses
     *
     * @return $this
     */
    public function setAddresses($addresses)
    {
        $this->_profile->addresses = $addresses;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_profile->getEmail();
    }

    /**
     *
     */
    public function getErrorCode()
    {
        return;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        $firstName = $this->_profile->getFirstname();
        $middleName = $this->_profile->getMiddleName();
        return $firstName.($middleName ? (' '.$middleName) : '');
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->_profile->getData('gender');
    }

    /**
     * @return bool
     */
    public function getIsSMSSubscribe()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function getIsSubscribe()
    {
        return $this->_profile->subscribe;
    }

    /**
     * @param $subscribe
     *
     * @return $this
     */
    public function setIsSubscribe($subscribe)
    {
        $this->_profile->subscribe = $subscribe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_profile->getLastname();
    }

    /**
     *
     */
    public function getMessage()
    {
        return;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return '';
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_profile->getPhone();
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return 0;
    }

    /**
     * @return bool
     */
    public function getUserFriendly()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getbirthDate()
    {
        return '';
    }

    /**
     * @return mixed
     */
    public function getUserAgreement()
    {
        return $this->_userAgreement;
    }

    /**
     * @param $userAgreement
     *
     * @return $this
     */
    public function setUserAgreement($userAgreement)
    {
        $this->_userAgreement = $userAgreement;

        return $this;
    }

    /**
     * @return array
     */
    public function giftCheques()
    {
        return [];
    }

    /**
     * @param $profile
     *
     * @return $this
     */
    public function setProfile($profile)
    {
        $this->_profile = $profile;

        return $this;
    }

    /**
     * @param null $token
     *
     * @return $this
     */
    public function setAccessToken($token = null)
    {
        $this->_profile->accessToken = $token;

        return $this;
    }
}
