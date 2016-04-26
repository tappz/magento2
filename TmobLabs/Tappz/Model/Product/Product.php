<?php

namespace TmobLabs\Tappz\Model\Product;

use TmobLabs\Tappz\API\Data\ProductInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Product extends AbstractExtensibleObject implements ProductInterface {

    /**
     * @var string
     */
    protected $product;

    /**
     * @return string
     */
    public function getId() {
        return $this->product->getId();
    }

    public function getProductName() {
        return $this->product->getName();
    }

    public function getListPrice() {
        $specialPrice = (double)$this->product->getSpecialPrice();
        $listPrice = (double)$this->product->getPrice();
        $amount = ($specialPrice) > 0 ? $specialPrice : $listPrice;
        $currency = $defaultCurrency = $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
        return $this->fillProductPrice($amount, $currency, $currency);
    }

    public function getNoImageUrl() {
        return null;
    }

    public function getHeadline() {
        return null;
    }

    public function getStrikeOutPrice() {
        $specialPrice = $this->product->getSpecialPrice();
        $amount = ($specialPrice) > 0 ? $specialPrice : 0;
        $currency = $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
        return $this->fillProductPrice($amount, $currency, $currency);
    }

    public function getIsCampaign() {
        return false;
    }

    public function getCreditCardInstallments() {
        return array();
    }

    public function getShipmentInformation() {
        return "";
    }

    public function getActions() {
         $actions = $this->fillActions();
         return !empty($actions->type)? $actions : null;
              
    }

    public function getFeatures() {
        return null;
    }

    public function getVariants() {
        $result = array();
        $productType = $this->product->getTypeId();
        if ($productType == 'configurable') {
            $instanceConf = $this->product->getTypeInstance();

            $configurableAttributesData = $instanceConf->getConfigurableAttributesAsArray($this->product);
            foreach ($configurableAttributesData as $dt => $val) {
                $group = array();
                $group['id'] = null;
                $group['name'] = null;
                $group['selected'] = null;
                $group['values'] = array();
                $group['id'] = $val['attribute_code'];
                $group['name'] = $val['label'];
                foreach ($val['values'] as $vv) {
                    $groupValue = array();
                    $groupValue['id'] = null;
                    $groupValue['name'] = null;
                    $groupValue['id'] = $vv['label'];
                    $groupValue['name'] = $vv['value_index'];
                    $group['values'][] = $groupValue;
                }
                $result[] = $group;
            }
        }
        return $result;
    }

    public function getInStock() {

        $result = isset($this->product->getQuantityAndStockStatus()["is_in_stock"])?$this->product->getQuantityAndStockStatus()["is_in_stock"]:false;
        return $result;
    }

    public function getIsShipmentFree() {
        return false;
    }

    public function getPicture() {
        $result = $this->product->getImageUrl();
        if (!isset($result)) {
            $images = $this->product->getMediaGalleryImages();
            $response = array();
            foreach ($images as $image) {
                $response[] = $image->getUrl();
            }
            $result = count($response[0]) && !empty($response[0]) > 0 ? $response[0] : "";
        }
        return $result;
    }

    public function getPictures() {
        $images = $this->product->getMediaGalleryImages();
        $image = array();
        $result = array();
        if (isset($images)) {
            if (count($images) > 0) {
                foreach ($images as $image) {
                    $result[]['url'] = $image->getUrl();
                  
                }
            } else {
                $result[0]['url'] = $this->product->getImageUrl($this->product);
            }
        }
        return $result;
    }

    public function getProductDetailUrl() {
        return $this->product->getDescription();
    }

    public function getProductUrl() {
        return $this->product->getProductUrl();
    }

    public function getPoints() {
        return 0;
    }

    public function getUnit() {
         $result = isset($this->product->getQuantityAndStockStatus()["is_in_stock"])?$this->product->getQuantityAndStockStatus()["is_in_stock"]:false;
        return $result;
    }

    public function getIsFavorite() {
        return false;
    }

    public function getIsBackInStockSubscription() {
        return false;
    }

    public function getBackInStockSubSelectedVariant() {
       
        return array();
    }

    public function getAdditionalTexts() {
        return $this->fillAditionalTexts();
    }

    public function getErrorCode() {
        return null;
    }

    public function getMessage() {
        return null;
    }

    public function getUserFriendly() {
        return true;
    }

    public function getShoutOutTexts() {
        return null;
    }

    public function fillActions($type = "", $image = "", $text = "", $productId = "", $href = "", $categoryId = "") {
        return [
            'type' => $type,
            'image' => $image,
            'text' => $text,
            'productId' => $productId,
            'href' => $href,
            'categoryId' => $categoryId,
        ];
    }

    public function fillAditionalTexts($key = "", $text = "") {
        return [
            'key' => $key,
            'text' => $text
        ];
    }

    public function fillProductPrice($amount = 0, $defaultCurrency = null, $currency = null) {
        return [
            'amount' =>number_format($amount, 2, '.', '') ,
            'amountDefaultCurrency' => $defaultCurrency,
            'currency' => $currency
        ];
    }

    public function fillBackInStockSubSelectedVariant($groupName = null, $groupId = null, $features = null) {
        return [
            'groupName' => $groupName,
            'groupId' => $groupId,
            'features' => $features
        ];
    }
    public function fillFilters(){
           return [
                "id" => "string",
                  "displayName" => "string",
                  "selectedItemId" => "string",
                  "rangeStart" => "string",
                  "rangeEnd" => "string",
                  "FilterType" => "string",
                  "items" =>[
                      
                  ]
           ];
    }
    public function fillFilterItems(){
        
    }
    public function fillShortList() {
        return [
           ['id' => 'name-asc', 'name' => 'Name (Ascending)'],
           ['id' => 'name-desc', 'name' => 'Name (Descending)'],
           ['id' => 'price-asc', 'name' => 'Price (Ascending)'],
           ['id' => 'price-desc', 'name' => 'Price (Descending)']
          ];
    }

    public function setProduct($product) {
        $this->product = $product;
        return $this;
    }

    public function getProduct($product) {
        return $this->product;
    }

}
