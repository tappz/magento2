<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Profile;

/**
 * Class ProfileFill.
 */
class ProfileFill extends Profile
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * ProfileFill constructor.
     *
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }

    /**
     * @return array
     */
    public function fillProfile()
    {
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

    /**
     * @return array
     */
    public function fillUserAgreement()
    {
        return [
            'agreementText' => $this->getUserAgreement(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    /**
     * @param $data
     *
     * @return array
     */
    protected function fillRegisterCustomerData($data)
    {
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
