<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Product;

/**
 * Class ProductFill.
 */
class ProductFill extends Product
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    public $storeManager;

    /**
     * ProductFill constructor.
     *
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * @return array
     */
    public function fillProduct()
    {

        return [
            'id' => $this->getId(),
            'productName' => $this->getProductName(),
            'listPrice' => $this->getListPrice(),
            'noImageUrl' => $this->getNoImageUrl(),
            'headline' => $this->getHeadline(),
            'strikeoutPrice' => $this->getStrikeOutPrice(),
            'IsCampaign' => $this->getIsCampaign(),
            'creditCardInstallments' => $this->getCreditCardInstallments(),
            'inStock' => $this->getInStock(),
            'shipmentInformation' => $this->getShipmentInformation(),
            'isShipmentFree' => $this->getIsShipmentFree(),
            'features' => $this->getFeatures(),
            'variants' => $this->getVariants(),
            'shoutOutTexts' => $this->getShoutOutTexts(),
            'actions' => $this->getActions(),
            'picture' => $this->getPicture(),
            'pictures' => $this->getPictures(),
            'productDetailUrl' => '<p>'.$this->getProductDetailUrl().'</p>',
            'productUrl' => $this->getProductUrl(),
            'points' => $this->getPoints(),
            'unit' => $this->getUnit(),
            'isFavorite' => $this->getIsFavorite(),
            'UserFriendly' => $this->getUserFriendly(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
        ];
    }

    /**
     * @param $totalResultCount
     * @param $pageNumber
     * @param $pageSize
     * @param $products
     * @param array $filters
     * @param array $sortList
     * @param array $categories
     *
     * @return array
     */
    public function fillProductSearch(
        $totalResultCount,
        $pageNumber,
        $pageSize,
        $products,
        $filters = [],
        $sortList = [],
        $categories = []
    ) {
        return [
            'totalResultCount' => $totalResultCount,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
            'products' => $products,
            'filters' => $filters,
            'sortList' => $sortList,
            'categories' => $categories,
            'UserFriendly' => $this->getUserFriendly(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
        ];
    }
}
