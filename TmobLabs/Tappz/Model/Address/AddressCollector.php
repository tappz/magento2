<?php

namespace TmobLabs\Tappz\Model\Address;

use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Store\Model\StoreManagerInterface;
use TmobLabs\Tappz\API\Data\AddressInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

class AddressCollector extends AddressFill implements AddressInterface
{

	protected $helper;
	protected $customerUrl;
	protected $objectManager;
	protected $scopeInterface;
	protected $configAddress;

	public function __construct(
		StoreManagerInterface $storeManager,
		RequestHandler $requestHandler,
		\Magento\Customer\Model\Url $customerUrl,
		ScopeConfig $configAddress
	) {
		parent::__construct($storeManager);
		$this->helper = $requestHandler;
		$this->customerUrl = $customerUrl;
		$this->configAddress = $configAddress;
		$this->scopeInterface = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
		$this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
	}

	public function createAddress()
	{
		return $this->createOrUpdateAddress();
	}

	public function editAddress()
	{
		return $this->createOrUpdateAddress(true);
	}

	public function deleteAddress()
	{
		$userId = $this->helper->convertJson($this->helper->getAuthorization());
		$addressResponse = $this->helper->convertJson($this->helper->getHeaderJson());
		$store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
		$customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store)->load($userId);
		if (!$customer->getID()) {
			return "Error";
		}
		$address = $this->objectManager->get('Magento\Customer\Model\Address');
		$address->load($addressResponse->id);
		$result = $this->getAddressById($address->getID());
		$address->delete();
		return $result;
	}

	public function createOrUpdateAddress($update = false)
	{
		$userId = $this->helper->convertJson($this->helper->getAuthorization());
		$addressResponse = $this->helper->convertJson($this->helper->getHeaderJson());
		$store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
		$customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store)->load($userId);
		if (!$customer->getID()) {
			return "Error";
		}
		$address = $this->objectManager->get('Magento\Customer\Model\Address');
		if ($update) {
			$address->load($addressResponse->id);
		}
		$address = $this->addressBeforeSave($addressResponse, $address);
		if (!$update) {
			$address->setCustomer($customer);
		}

		$valid = $address->validate();
		if (is_array($valid)) {
			return $valid;
		}
		if ($address->save()) {

			return $this->getAddressById($address->getID());

		}
	}

	public function addressBeforeSave($addressResponse, $address)
	{
		if(empty($addressResponse->cityCode)){
			$addressResponse->cityCode = $addressResponse->city;
		}
		$address->setData($this->getAddressAttr("tappzaddressname"), $addressResponse->addressName);
		$address->setData($this->getAddressAttr("tappzaddressfirstname"), $addressResponse->name);
		$address->setData($this->getAddressAttr("tappzaddresslastname"), $addressResponse->surname);
		$address->setData($this->getAddressAttr("tappzaddressemail"), $addressResponse->email);
		$address->setData($this->getAddressAttr("tappzaddressstreet"), $addressResponse->addressLine);
		$address->setData($this->getAddressAttr("tappzaddresscountry"), $addressResponse->country);
		$address->setData($this->getAddressAttr("tappzaddresscountryid"), $addressResponse->countryCode);
		$address->setData($this->getAddressAttr("tappzaddressregion"), $addressResponse->state);
		$address->setData($this->getAddressAttr("tappzaddressregionid"), $addressResponse->stateCode);
		$address->setData($this->getAddressAttr("tappzaddresscity"), $addressResponse->city);
		$address->setData($this->getAddressAttr("tappzaddresscityid"), $addressResponse->cityCode);
		$address->setData($this->getAddressAttr("tappzaddressdistrict"), $addressResponse->district);
		$address->setData($this->getAddressAttr("tappzaddressdistrictid"), $addressResponse->districtCode);
		$address->setData($this->getAddressAttr("tappzaddresstown"), $addressResponse->town);
		$address->setData($this->getAddressAttr("tappzaddresstownid"), $addressResponse->townCode);
		$address->setData($this->getAddressAttr("tappzaddresscompany"), $addressResponse->companyTitle);
		$address->setData($this->getAddressAttr("tappzaddressiscompany"), (bool)$addressResponse->corporate);
		$address->setData($this->getAddressAttr("tappztaxdepartmentattribute"), $addressResponse->taxDepartment);
		$address->setData($this->getAddressAttr("tappzvatno"), $addressResponse->taxNo);
		$address->setData($this->getAddressAttr("tappzphone"), $addressResponse->phoneNumber);
		$address->setData($this->getAddressAttr("tappzidno"), $addressResponse->identityNo);
		$address->setData($this->getAddressAttr("tappzpostcode"), $addressResponse->zipCode);
		return $address;
	}

	public function setAddress($address)
	{
		$this->set($address);
		$this->setId($address->getID());
		$this->setName($address->getData($this->getAddressAttr("tappzaddressname")));
		$this->setCustomerName($address->getData($this->getAddressAttr("tappzaddressfirstname")));
		$this->setCustomerSurname($address->getData($this->getAddressAttr("tappzaddresslastname")));
		$this->setAddressCustomerEmail($address->getData($this->getAddressAttr("tappzaddressemail")));
		$this->setLine($address->getData($this->getAddressAttr("tappzaddressstreet")));
		$this->setCountry($address->getData($this->getAddressAttr("tappzaddresscountry")));
		$this->setCountryCode($address->getData($this->getAddressAttr("tappzaddresscountryid")));
		$this->setState($address->getData($this->getAddressAttr("tappzaddressregion")));
		$this->setStateCode($address->getData($this->getAddressAttr("tappzaddressregionid")));
		$this->setCity($address->getData($this->getAddressAttr("tappzaddresscity")));
		$this->setCityCode($address->getData($this->getAddressAttr("tappzaddresscityid")));
		$this->setDistrict($address->getData($this->getAddressAttr("tappzaddressdistrict")));
		$this->setDistrictCode($address->getData($this->getAddressAttr("tappzaddressdistrictid")));
		$this->setTown($address->getData($this->getAddressAttr("tappzaddresstown")));
		$this->setTownCode($address->getData($this->getAddressAttr("tappzaddresstownid")));
		$this->setCorporate(false);
		$this->setCorporateTitle($address->getData($this->getAddressAttr("tappzaddresscompany")));
		$this->setTaxDepartment($address->getData($this->getAddressAttr("tappztaxdepartmentattribute")));
		$this->setTaxNo($address->getData($this->getAddressAttr("tappzvatno")));
		$this->setPhoneNumber($address->getData($this->getAddressAttr("tappzphone")));
		$this->setIdentityNo($address->getData($this->getAddressAttr("tappzidno")));
		$this->setZipCode($address->getData($this->getAddressAttr("tappzpostcode")));
		$this->setUsCheckoutCity($address->getData($this->getAddressAttr("tappzaddresscityid")));
		$this->setErrorCode("");
		$this->setMessage("Success");
		$this->setUserFriendly(true);
	}

	public function getAddressAttr($attr)
	{
		return $this->configAddress->getValue('tappzaddress/tappzaddressesform/' . $attr);
	}

	public function getAddressById($addressId)
	{
		$this->setAddress($this->objectManager->get('Magento\Customer\Model\Address')->load($addressId));
		return $this->fillAddress();
	}

}
