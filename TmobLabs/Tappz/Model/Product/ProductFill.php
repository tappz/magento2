<?php

namespace TmobLabs\Tappz\Model\Product;

use TmobLabs\Tappz\Model\Product\Product;

class ProductFill extends Product {

    protected $_storeManager;

    public function __construct(
    \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }

    public function fillProduct() {

        return [
            'id' => $this->getId(),
            'productName' => $this->getProductName(),
            'listPrice' => $this->getListPrice(),
            'noImageUrl' => $this->getNoImageUrl(),
            'headline' => $this->getHeadline(),
            'strikeoutPrice' => $this->getStrikeOutPrice(),
            "IsCampaign" => $this->getIsCampaign(),
            "creditCardInstallments" => $this->getCreditCardInstallments(),
            "inStock" => $this->getInStock(),
            "shipmentInformation" =>  $this->getShipmentInformation(),
            "isShipmentFree" =>  $this->getIsShipmentFree(),
            "features" => $this->getFeatures(),
            "variants" => $this->getVariants(),
            "shoutOutTexts" => $this->getShoutOutTexts(),
            "actions" => $this->getActions(),
            "picture" => $this->getPicture(),
            "pictures" => $this->getPictures(),
            "productDetailUrl" => '<p>' . $this->getProductDetailUrl() . '</p>',
            "productUrl" => $this->getProductUrl(),
            "points" => $this->getPoints(),
            "unit" => $this->getUnit(),
            "isFavorite" => $this->getIsFavorite(),
            "UserFriendly" => $this->getUserFriendly(),
            "ErrorCode" => $this->getErrorCode(),
            "Message" => $this->getMessage(),
        ];

    }
    public function fillProductSearch($totalResultCount, $pageNumber, $pageSize ,$products ,$filters =array() ,$sortList =  array() ,$categories=  array()) {

            return [
                'totalResultCount' => $totalResultCount,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'products' =>$products,
                'filters' => $filters,
                "sortList" => $sortList,
                "categories" => $categories,
                "UserFriendly" => $this->getUserFriendly(),
                "ErrorCode" => $this->getErrorCode(),
                "Message" => $this->getMessage(),
            ];
        }
}
