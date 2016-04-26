<?php

namespace TmobLabs\Tappz\Model\Address;

use TmobLabs\Tappz\API\Data\AddressInterface;
use Magento\Store\Model\StoreManagerInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

class AddressCollector extends AddressFill implements AddressInterface {

    protected $helper;
    protected $customerUrl;
    protected $objectManager;

    public function __construct(
    StoreManagerInterface $storeManager, RequestHandler $requestHandler, \Magento\Customer\Model\Url $customerUrl
    ) {
        parent::__construct($storeManager);
        $this->helper = $requestHandler;
        $this->customerUrl = $customerUrl;
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    public function createAddress() {

        /**
         * @todo  @dzgok
         * Address attr larını al 
         * Almış olduğun attrleri result set lerini geri dön 
         */
     
        $userid = $this->helper->convertJson($this->helper->getAuthorization());
        $addressResponse = $this->helper->convertJson($this->helper->getHeaderJson());
        $store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
        //$customer = $this->objectManager->get('Magento\Customer\Model\Customer')->setStore($store)->load($userid);
        $result = $this->objectManager->get('Magento\Customer\Model\Address')->load(4);
        print_r($result);
        print_r($result);
        exit;
        if (!$customer->getID()) {
            // Error Message
        }
        $address = $this->objectManager->get('Magento\Customer\Model\Address')->setStore($store)->load($addressResponse->id);

        $attributes = $address->getDefaultAttributeCodes();
        foreach ($attributes as $attributeCode => $attributeData) {
            print_r($attributeData);
            echo "<br>";
        }

        exit;
        $customer->setData('firstname', $customerData['firstname']);
        $customer->setData('lastname', $customerData['lastname']);
        $customer->setData("gender", $customerData["gender"]);
        $customer->setData("email", $customerData["email"]);
        $customer->setData("phone", $customerData["phone"]);
        if (isset($customerData['isSubscribed']))
            $customer->setIsSubscribed($customerData['isSubscribed'] === 'true' ? true : false);
        $customer->save();
        return $this->getProfileByUserId($customer->getId());
        exit;
    }

}
