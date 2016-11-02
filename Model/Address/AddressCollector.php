<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Address;

use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use TmobLabs\Tappz\API\Data\AddressInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class AddressCollector.
 */
class AddressCollector extends AddressFill implements AddressInterface
{
    /**
     * @var RequestHandler
     */
    public $helper;
    /**
     * @var \Magento\Customer\Model\Url
     */
    public $customerUrl;
    /**
     * @var
     */
    public $objectManager;
    /**
     * @var
     */
    public $scopeInterface;
    /**
     * @var ScopeConfig
     */
    public $configAddress;

    /**
     * AddressCollector constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param RequestHandler $requestHandler
     * @param \Magento\Customer\Model\Url $customerUrl
     * @param ScopeConfig $configAddress
     */
    public function __construct(
        RequestHandler $requestHandler,
        \Magento\Customer\Model\Url $customerUrl,
        ScopeConfig $configAddress
    ) {
        $this->helper = $requestHandler;
        $this->customerUrl = $customerUrl;
        $this->configAddress = $configAddress;
        $this->scopeInterface =
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $this->objectManager =
            \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * @return array|string
     */
    public function createAddress()
    {
        return $this->createOrUpdateAddress();
    }

    /**
     * @param bool $update
     *
     * @return array|string
     */
    public function createOrUpdateAddress($update = false)
    {


        $userId = $this->helper->convertJson(
            $this->helper->getAuthorization()
        );
        $addressResponse = $this->
        helper->
        convertJson($this->helper->getHeaderJson());
        $store = $this->
        objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->objectManager->
        get('Magento\Customer\Model\Customer')
            ->setStore($store)->load($userId);
        if (!$customer->getID()) {
            return 'Error';
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
            $result =  $this->getAddressById(0);
            $result['ErrorCode'] = "403";
            $result['Message'] =  implode(",",$valid);
            $result['UserFriendly'] = true;
            return $result;
        }
        if ($address->save()) {
            return $this->getAddressById($address->getID());
        }
    }

    /**
     * @param $addressResponse
     * @param $address
     *
     * @return mixed
     */
    public function addressBeforeSave($response, $address)
    {
        if (empty($response->cityCode)) {
            $response->cityCode = $response->usCheckoutCity;
        }
        if (empty($response->state)) {
            $response->state = $response->usCheckoutCity;
        }
        if (empty($response->stateCode)) {
            $response->stateCode = $response->usCheckoutCity;
        }

        $address->setData(
            $this->getAttr('tappzaddressname'),
            $response->addressName
        );
        $address->setData(
            $this->getAttr('tappzaddressfirstname'),
            $response->name
        );
        $address->setData(
            $this->getAttr('tappzaddresslastname'),
            $response->surname
        );
        if(isset($response->email))
        {
            $address->setData(
                $this->getAttr('tappzaddressemail'),
                $response->email
            );
        }

        $address->setData(
            $this->getAttr('tappzaddressstreet'),
            $response->addressLine
        );
        $address->setData(
            $this->getAttr('tappzaddresscountry'),
            $response->country
        );
        $address->setData(
            $this->getAttr('tappzaddresscountryid'),
            $response->countryCode
        );
        $address->setData(
            $this->getAttr('tappzaddressregion'),
            $response->state
        );
        $address->setData(
            $this->getAttr('tappzaddressregionid'),
            $response->stateCode
        );
        $address->setData(
            $this->getAttr('tappzaddresscity'),
            $response->usCheckoutCity
        );
        $address->setData(
            $this->getAttr('tappzaddresscityid'),
            $response->cityCode
        );
        if(isset($response->district))
        {
            $address->setData(
                $this->getAttr('tappzaddressdistrict'),
                $response->district
            );
        }
        if(isset($response->districtCode))
        {
        $address->setData(
            $this->getAttr('tappzaddressdistrictid'),
            $response->districtCode
        );
        }
        if(isset($response->tappzaddresstown))
        {
            $address->setData(
                $this->getAttr('tappzaddresstown'),
                $response->town
            );
        }
        if(isset($response->tappzaddresstownid))
        {
            $address->setData(
                $this->getAttr('tappzaddresstownid'),
                $response->townCode
            );
        }
        $address->setData(
            $this->getAttr('tappzaddresscompany'),
            $response->companyTitle
        );
        $address->setData(
            $this->getAttr('tappzaddressiscompany'),
            (bool)$response->corporate
        );
        $address->setData(
            $this->getAttr('tappztaxdepartmentattribute'),
            $response->taxDepartment
        );
        $address->setData(
            $this->getAttr('tappzvatno'),
            $response->taxNo
        );
        $address->setData(
            $this->getAttr('tappzphone'),
            $response->phoneNumber
        );
        if(isset($response->identityNo)){


        $address->setData(
            $this->getAttr('tappzidno'),
            $response->identityNo
        );
        }
        $address->setData(
            $this->getAttr('tappzpostcode'),
            $response->zipCode
        );

        return $address;
    }

    /**
     * @param $attr
     *
     * @return mixed
     */
    public function getAttr($attr)
    {
        return $this->
        configAddress->
        getValue('tappzaddress/tappzaddressesform/' . $attr);
    }

    /**
     * @param $addressId
     *
     * @return array
     */
    public function getAddressById($addressId)
    {
        $address = $this->objectManager->get('Magento\Customer\Model\Address');
        $this->setAddress($address->load($addressId));

        return $this->fillAddress();
    }

    /**
     * @param $address
     */
    public function setAddress($address)
    {
        $this->set($address)
            ->setId(
                $address->getID()
            )
            ->setName(
                $address->getData($this->getAttr('tappzaddressname'))
            )
            ->setCustomerName(
                $address->getData($this->getAttr('tappzaddressfirstname'))
            )
            ->setCustomerSurname(
                $address->getData($this->getAttr('tappzaddresslastname'))
            )
            ->setAddressCustomerEmail(
                $address->getData($this->getAttr('tappzaddressemail'))
            )
            ->setLine(
                $address->getData($this->getAttr('tappzaddressstreet'))
            )
            ->setCountry(
                $address->getData($this->getAttr('tappzaddresscountry'))
            )
            ->setCountryCode(
                $address->getData($this->getAttr('tappzaddresscountryid'))
            )
            ->setState(
                $address->getData($this->getAttr('tappzaddressregion'))
            )
            ->setStateCode(
                $address->getData($this->getAttr('tappzaddressregionid'))
            )
            ->setCity(
                $address->getData($this->getAttr('tappzaddresscity'))
            )
            ->setCityCode(
                $address->getData($this->getAttr('tappzaddresscityid'))
            )
            ->setDistrict(
                $address->getData($this->getAttr('tappzaddressdistrict'))
            )
            ->setDistrictCode(
                $address->getData($this->getAttr('tappzaddressdistrictid'))
            )
            ->setTown(
                $address->getData($this->getAttr('tappzaddresstown'))
            )
            ->setTownCode(
                $address->getData($this->getAttr('tappzaddresstownid'))
            )
            ->setCorporate(
                false
            )
            ->setCorporateTitle(
                $address->getData($this->getAttr('tappzaddresscompany'))
            )
            ->setTaxDepartment(
                $address->getData($this->getAttr('tappztaxdepartmentattribute'))
            )
            ->setTaxNo(
                $address->getData($this->getAttr('tappzvatno'))
            )
            ->setPhoneNumber(
                $address->getData($this->getAttr('tappzphone'))
            )
            ->setIdentityNo(
                $address->getData($this->getAttr('tappzidno'))
            )
            ->setZipCode(
                $address->getData($this->getAttr('tappzpostcode'))
            )
            ->setUsCheckoutCity(
                $address->getData($this->getAttr('tappzaddresscityid'))
            )
            ->setErrorCode('')
            ->setMessage('Success')
            ->setUserFriendly(true);
    }

    /**
     * @return array|string
     */
    public function editAddress()
    {
        return $this->createOrUpdateAddress(true);
    }

    /**
     * @return array|string
     */
    public function deleteAddress()
    {
        $json = $this->helper->getHeaderJson();
        $userId = $this->helper->convertJson(
            $this->helper->getAuthorization()
        );
        $addressResponse = $this->helper->convertJson($json);
        $store = $this->
        objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer =
            $this->objectManager->get('Magento\Customer\Model\Customer')
                ->setStore($store)->load($userId);
        if (!$customer->getID()) {
            return 'Error';
        }
        $address =
            $this->objectManager->get('Magento\Customer\Model\Address');
        $address->load($addressResponse->id);
        $result = $this->getAddressById($address->getID());
        $address->delete();

        return $result;
    }
}
