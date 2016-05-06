<?php

namespace TmobLabs\Tappz\Model\Profile;

use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Store\Model\StoreManagerInterface;
use TmobLabs\Tappz\API\Data\ProfileInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Address\AddressRepository as AddressRepository;

class ProfileCollector extends ProfileFill implements ProfileInterface
{

	protected $helper;
	protected $customerUrl;
	protected $objectManager;
	protected $_scopeConfig;
	protected $addressRepository;

	public function __construct(
		StoreManagerInterface $storeManager,
		RequestHandler $requestHandler,
		\Magento\Customer\Model\Url $customerUrl,
		ScopeConfig $scopeConfig,
		AddressRepository $addressRepository
	) {
		parent::__construct($storeManager);
		$this->helper = $requestHandler;
		$this->customerUrl = $customerUrl;
		$this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$this->_scopeConfig = $scopeConfig;
		$this->addressRepository = $addressRepository;

	}

	public function login()
	{
		$header = $this->helper->convertJson($this->helper->getHeaderJson());
		$email = $header->email;
		$password = $header->password;

		$store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
		$customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store);
		try {
			$customer->authenticate($email, $password);
		} catch (Exception $e) {

		}
		$subscriber = $this->objectManager->get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
		$this->profile = ($customer->loadByEmail($email));
		$this->setIsSubscribe((bool)$subscriber->getId());
		$shipping["shipping"] = array();
		foreach ($customer->getAddresses() as $address) {
			$shipping['shipping'][] = $this->addressRepository->getAddress($address->getID());
		}
		$this->setAddresses($shipping);
		$accessToken = $this->helper->getAuthorizationFull() . " " . $customer->getID();
		$this->setAccessToken($accessToken);
		return $this->fillProfile();
	}

	public function fblogin()
	{
		$header = $this->helper->convertJson($this->helper->getHeaderJson());
		$facebookAccessToken = $header->fbAccessToken;
		$facebookUserId = $header->fbUid;
		$curl = curl_init();
		$fbField = "id,name,email,first_name,last_name,gender,verified,birthday";
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_URL,
			"https://graph.facebook.com/$facebookUserId?fields=$fbField&access_token=$facebookAccessToken");
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($curl);
		$userInfo = json_decode($result);
		if (isset($userInfo->email)) {
			$email = $userInfo->email;
			$store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
			$customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store);
			$customer->loadByEmail($email);
			if ($customer) {
				$accessToken = $this->helper->getAuthorizationFull() . " " . $customer->getID();
				$subscriber = $this->objectManager->get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
				$this->profile = ($customer->loadByEmail($email));
				$this->setIsSubscribe((bool)$subscriber->getId());
				$shipping["shipping"] = array();
				foreach ($customer->getAddresses() as $address) {
					$shipping['shipping'][] = $this->addressRepository->getAddress($address->getID());
				}
				$this->setAddresses($shipping);
				$this->setAccessToken($accessToken);
				return $this->fillProfile();
			} else {

			}
		}
	}

	public function getProfile()
	{
		$userId = $this->helper->convertJson($this->helper->getAuthorization());
		return $this->getProfileByUserId($userId);
	}

	public function createProfile()
	{
		$data = $this->helper->convertJson($this->helper->getHeaderJson());
		$customerData = $this->fillRegisterCustomerData($data);
		$store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
		$customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store);
		$customer->setData($customerData)
			->setPassword($customerData['password'])
			->save();
		return $this->getProfileByUserId($customer->getId());
	}

	public function getProfileByUserId($userid)
	{

		$store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
		$customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store);
		$this->profile = ($customer->load($userid));
		$email = $customer->getEmail();
		$subscriber = $this->objectManager->get('Magento\Newsletter\Model\Subscriber')->loadByEmail($email);
		$this->setIsSubscribe((bool)$subscriber->getId());
		$shipping["shipping"] = array();
		foreach ($customer->getAddresses() as $address) {
			$shipping['shipping'][] = $this->addressRepository->getAddress($address->getID());
		}
		$this->setAddresses($shipping);
		$accessToken = $this->helper->getAuthorizationFull() . " " . $customer->getID();
		$this->setAccessToken($accessToken);
		return $this->fillProfile();
	}

	public function editProfile()
	{
		$userid = $this->helper->convertJson($this->helper->getAuthorization());
		$data = $this->helper->convertJson($this->helper->getHeaderJson());
		$data->entity_id = $userid;
		$customerData = $this->fillRegisterCustomerData($data);

		$store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
		$customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store)->load($userid);
		$customer->setData('firstname', $customerData['firstname']);
		$customer->setData('lastname', $customerData['lastname']);
		$customer->setData("gender", $customerData["gender"]);
		$customer->setData("email", $customerData["email"]);
		$customer->setData("phone", $customerData["phone"]);
		if (isset($customerData['isSubscribed'])) {
			$customer->setIsSubscribed($customerData['isSubscribed'] === 'true' ? true : false);
		}
		$customer->save();
		return $this->getProfileByUserId($customer->getId());
	}

	public function userAgreement()
	{

		$this->setUserAgreement($this->_scopeConfig->getValue('tappzagreement/useragreement/agreement',
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE));
		return $this->fillUserAgreement();

	}

	public function getCustomerAddressById($addressId)
	{
		$this->address = $this->objectManager->get('Magento\Customer\Model\Address')->load($addressId);
		return $this->fillAddress();
	}

}
