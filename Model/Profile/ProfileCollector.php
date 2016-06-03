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
    protected $_helper;
    /**
     * @var
     */
    protected $_objectManager;
    /**
     * @var ScopeConfig
     */
    protected $_scopeConfig;
    /**
     * @var AddressRepository
     */
    protected $_addressRepository;

    /**
     * ProfileCollector constructor.
     *
     * @param StoreManagerInterface       $storeManager
     * @param RequestHandler              $requestHandler
     * @param \Magento\Customer\Model\Url $customerUrl
     * @param ScopeConfig                 $scopeConfig
     * @param AddressRepository           $addressRepository
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        RequestHandler $requestHandler,
        \Magento\Customer\Model\Url $customerUrl,
        ScopeConfig $scopeConfig,
        AddressRepository $addressRepository
    ) {
        parent::__construct($storeManager);
        $this->_helper = $requestHandler;
        $this->_objectManager =
            \Magento\Framework\App\ObjectManager::getInstance();
        $this->_scopeConfig = $scopeConfig;
        $this->_addressRepository = $addressRepository;
    }

    /**
     * @return array
     */
    public function login()
    {

        $header = $this->_helper->convertJson($this->_helper->getHeaderJson());
        $email = $header->email;
        $password = $header->password;
        $store = $this->_objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->_objectManager->
        get('Magento\Customer\Model\Customer')->setStore($store);
        try {
            $customer->authenticate($email, $password);
        } catch (Exception $e) {

        }

        $subscriber = $this->_objectManager->
        get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
        $this->_profile = ($customer->loadByEmail($email));
        $this->setIsSubscribe((bool) $subscriber->getId());
        $shipping['shipping'] = [];

        foreach ($customer->getAddresses() as $address) {
            $shipping['shipping'][] = $this->_addressRepository->
            getAddress($address->getID());
        }

        $this->setAddresses($shipping);


        $accessToken = $this->_helper->getAuthorization().' '.$customer->getID();

        $this->setAccessToken($accessToken);

        return $this->fillProfile();
    }

    /**
     * @return array
     */
    public function fblogin()
    {
        $header = $this->_helper->convertJson($this->_helper->getHeaderJson());
        $token = $header->fbAccessToken;
        $fbUserId = $header->fbUid;
        $curl = curl_init();
        $fbField = 'id,name,email,first_name,'.
            'last_name,gender,verified,birthday';
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL,
            "https://graph.facebook.com/$fbUserId?".
            "fields=$fbField&access_token=$token"
        );
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $userInfo = json_decode($result);
        if (isset($userInfo->email)) {
            $email = $userInfo->email;
            $store = $this->_objectManager->
            get('Magento\Store\Model\StoreManagerInterface')->getStore();
            $customer = $this->_objectManager->
            get('Magento\Customer\Model\Customer')->setStore($store);
            $customer->loadByEmail($email);
            if ($customer) {
                $accessToken = $this->_helper->getAuthorizationFull().
                    ' '.$customer->getID();
                $subscriber = $this->_objectManager->
                get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
                $this->_profile = ($customer->loadByEmail($email));
                $this->setIsSubscribe((bool) $subscriber->getId());
                $shipping['shipping'] = [];
                foreach ($customer->getAddresses() as $address) {
                    $shipping['shipping'][] = $this->_addressRepository->
                    getAddress($address->getID());
                }
                $this->setAddresses($shipping);
                $this->setAccessToken($accessToken);
                return $this->fillProfile();
            } else {
            }
        }
    }

    /**
     * @return array
     */
    public function getProfile()
    {
        $userId = $this->_helper->convertJson(
            $this->_helper->getAuthorization()
        );

        return $this->getProfileByUserId($userId);
    }

    /**
     * @return array
     */
    public function createProfile()
    {
        $data = $this->_helper->convertJson($this->_helper->getHeaderJson());
        $customerData = $this->fillRegisterCustomerData($data);
        $store = $this->_objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->_objectManager->
        get('Magento\Customer\Model\Customer')->setStore($store);
        $customer->setData($customerData)
            ->setPassword($customerData['password'])
            ->save();

        return $this->getProfileByUserId($customer->getId());
    }

    /**
     * @param $userid
     *
     * @return array
     */
    public function getProfileByUserId($userid)
    {
        $store = $this->_objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->_objectManager->
        get('Magento\Customer\Model\Customer')->setStore($store);
        $this->_profile = ($customer->load($userid));
        $email = $customer->getEmail();
        $subscriber = $this->_objectManager->
        get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
        $this->setIsSubscribe((bool) $subscriber->getId());
        $shipping['shipping'] = [];
        foreach ($customer->getAddresses() as $address) {
            $shipping['shipping'][] = $this->_addressRepository->
            getAddress($address->getID());
        }
        $this->setAddresses($shipping);
        $accessToken = $this->_helper->getAuthorizationFull().
            ' '. $customer->getID();
        $this->setAccessToken($accessToken);

        return $this->fillProfile();
    }

    /**
     * @return array
     */
    public function editProfile()
    {
        $userid = $this->_helper->convertJson(
            $this->_helper->getAuthorization()
        );
        $data = $this->_helper->convertJson($this->_helper->getHeaderJson());
        $data->entity_id = $userid;
        $customerData = $this->fillRegisterCustomerData($data);
        $store = $this->_objectManager
            ->get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->_objectManager
            ->get('Magento\Customer\Model\Customer')
            ->setStore($store)->load($userid);
        $customer->setData('firstname', $customerData['firstname']);
        $customer->setData('lastname', $customerData['lastname']);
        $customer->setData('gender', $customerData['gender']);
        $customer->setData('email', $customerData['email']);
        $customer->setData('phone', $customerData['phone']);
        if (isset($customerData['isSubscribed'])) {
            $customer->setIsSubscribed($customerData['isSubscribed'] === 'true'
                ? true : false);
        }
        $customer->save();

        return $this->getProfileByUserId($customer->getId());
    }

    /**
     * @return array
     */
    public function userAgreement()
    {
        $this->setUserAgreement($this->_scopeConfig->getValue(
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
        $this->address = $this->_objectManager->
        get('Magento\Customer\Model\Address')->
        load($addressId);
        return $this->fillAddress();
    }
}
