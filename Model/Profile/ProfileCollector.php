<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Profile;

use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Store\Model\StoreManagerInterface;
use TmobLabs\Tappz\API\Data\ProfileInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Address\AddressRepository as AddressRepository;

/**
 * Class ProfileCollector.
 */
class ProfileCollector extends ProfileFill implements ProfileInterface
{
    /**
     * @var RequestHandler
     */
    public $helper;
    /**
     * @var
     */
    public $objectManager;
    /**
     * @var ScopeConfig
     */
    public $scopeConfig;
    /**
     * @var AddressRepository
     */
    public $addressRepository;

    /**
     * ProfileCollector constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param RequestHandler $requestHandler
     * @param ScopeConfig $scopeConfig
     * @param AddressRepository $addressRepository
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        RequestHandler $requestHandler,
        ScopeConfig $scopeConfig,
        AddressRepository $addressRepository
    ) {
        parent::__construct($storeManager);
        $this->helper = $requestHandler;
        $this->objectManager =
            \Magento\Framework\App\ObjectManager::getInstance();
        $this->scopeConfig = $scopeConfig;
        $this->addressRepository = $addressRepository;
    }

    /**
     * @return array
     */
    public function login()
    {
        $header = $this->helper->convertJson($this->helper->getHeaderJson());
        $email = $header->email;
        $password = $header->password;
        $store = $this->objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->objectManager->
        get('Magento\Customer\Model\Customer')->setStore($store);
        $customer->authenticate($email, $password);
        $subscriber = $this->objectManager->
        get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
        $this->profile = ($customer->loadByEmail($email));
        $this->setIsSubscribe((bool)$subscriber->getId());
        $shipping['shipping'] = [];
        foreach ($customer->getAddresses() as $address) {
            $shipping['shipping'][] = $this->addressRepository->
            getAddress($address->getID());
        }
        $this->setAddresses($shipping);
        $accessToken = $this->helper->getAuthorization() .
            ' ' . $customer->getID();
        $this->setAccessToken($accessToken);
        return $this->fillProfile();
    }

    /**
     * @return array
     */
    public function fblogin()
    {
        $header = $this->helper->convertJson($this->helper->getHeaderJson());
        $token = $header->fbAccessToken;
        $fbUserId = $header->fbUid;
        $curl = curl_init();
        $fbField = 'id,name,email,first_name,' .
            'last_name,gender,verified,birthday';
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL,
            "https://graph.facebook.com/$fbUserId?" .
            "fields=$fbField&access_token=$token"
        );
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $userInfo = json_decode($result);
        if (isset($userInfo->email)) {
            $email = $userInfo->email;
            $store = $this->objectManager->
            get('Magento\Store\Model\StoreManagerInterface')->getStore();
            $customer = $this->objectManager->
            get('Magento\Customer\Model\Customer')->setStore($store);
            $customer->loadByEmail($email);
            if ($customer) {
                $accessToken = $this->helper->getAuthorizationFull() .
                    ' ' . $customer->getID();
                $subscriber = $this->objectManager->
                get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
                $this->profile = ($customer->loadByEmail($email));
                $this->setIsSubscribe((bool)$subscriber->getId());
                $shipping['shipping'] = [];
                foreach ($customer->getAddresses() as $address) {
                    $shipping['shipping'][] = $this->addressRepository->
                    getAddress($address->getID());
                }
                $this->setAddresses($shipping);
                $this->setAccessToken($accessToken);
                return $this->fillProfile();
            } else {
                return false;
            }
        }
    }

    /**
     * @return array
     */
    public function getProfile()
    {
        $userId = $this->helper->convertJson(
            $this->helper->getAuthorization()
        );

        return $this->getProfileByUserId($userId);
    }

    /**
     * @param $userid
     *
     * @return array
     */
    public function getProfileByUserId($userId)
    {
        $store = $this->objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->objectManager->
        get('Magento\Customer\Model\Customer')->setStore($store);
        $this->profile = ($customer->load($userId));
        $email = $customer->getEmail();
        $subscriber = $this->objectManager->
        get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
        $this->setIsSubscribe((int)$subscriber->getId());
        $shipping['shipping'] = [];
        foreach ($customer->getAddresses() as $address) {
            $shipping['shipping'][] = $this->addressRepository->
            getAddress($address->getID());
        }
        $this->setAddresses($shipping);
        $accessToken = $this->helper->getAuthorizationFull() .
            ' ' . $customer->getID();
        $this->setAccessToken($accessToken);

        return $this->fillProfile();
    }

    /**
     * @return array
     */
    public function createProfile()
    {

        $data = $this->helper->convertJson($this->helper->getHeaderJson());
        
        $customerData = $this->fillRegisterCustomerData($data);
        $store = $this->objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->objectManager->
        get('Magento\Customer\Model\Customer')->setStore($store);
        $checkUser = $customer->loadByEmail($customerData['email']);
        if (empty(trim($customerData['firstname'])) ) {
            $result =   $this->getProfileByUserId(0);
            $result["ErrorCode"] = 403;
            $result["Message"] = "Name required";
            $result["UserFriendly"] = true ;
        }elseif (empty(trim($customerData['lastname'])) ) {
            $result =   $this->getProfileByUserId(0);
            $result["ErrorCode"] = 403;
            $result["Message"] = "Surname required";
            $result["UserFriendly"] = true ;
         }  elseif (!filter_var($customerData['email'], FILTER_VALIDATE_EMAIL)) {
            $result =   $this->getProfileByUserId(0);
            $result["ErrorCode"] = 403;
            $result["Message"] = "Invalid email format";
            $result["UserFriendly"] = true ;
        }
        elseif( strlen(trim($customerData['password'])) < 6 ){
            $result =   $this->getProfileByUserId(0);
            $result["ErrorCode"] = 403;
            $result["Message"] = "password must be at least 6 characters ";
            $result["UserFriendly"] = true ;
        } elseif($checkUser->getID()!=NULL){

           $result =   $this->getProfileByUserId($checkUser->getID());
            $result["ErrorCode"] = 403;
            $result["Message"] = "User already registered";
            $result["UserFriendly"] = true ;
        } else{
            $customer->setData($customerData)
                ->setPassword($customerData['password'])
                ->save();
            $result =  $this->getProfileByUserId($customer->getId());
            $result["ErrorCode"] = 200;
            $result["Message"] = "Login Successful";
            $result["UserFriendly"] = true ;
        }

        return $result;

    }

    /**
     * @return array
     */
    public function editProfile()
    {
        $userId = $this->helper->convertJson(
            $this->helper->getAuthorization()
        );

        $data = $this->helper->convertJson($this->helper->getHeaderJson());


        $customerData = $this->fillRegisterCustomerData($data);
        $store = $this->objectManager
            ->get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->objectManager
            ->get('Magento\Customer\Model\Customer')
            ->setStore($store)->load($userId);
        $customer->setData('firstname', $customerData['firstname']);
        $customer->setData('lastname', $customerData['lastname']);
        $customer->setData('gender', $customerData['gender']);
        $customer->setData('email', $customerData['email']);
        $customer->setData('phone', $customerData['phone']);
        if (isset($customerData['isSubscribed'])) {
            $customer->setIsSubscribed(
                $customerData['isSubscribed'] === 'true' ? true : false
            );
        }
        $customer->save();

        $result = $this->getProfileByUserId($customer->getId());

        return $result ;
    }

    /**
     * @return array
     */
    public function userAgreement()
    {
        $this->setUserAgreement(
            $this->scopeConfig->getValue(
                'tappzagreement/useragreement/agreement',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        );
        return $this->fillUserAgreement();
    }

    /**
     * @param $addressId
     *
     * @return mixed
     */
    public function getCustomerAddressById($addressId)
    {
        $this->address = $this->objectManager->
        get('Magento\Customer\Model\Address')->
        load($addressId);
        return $this->fillAddress();
    }
}
