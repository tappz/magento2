<?php

namespace TmobLabs\Tappz\Model\Product;

use TmobLabs\Tappz\API\Data\ProductInterface;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfigInterface;
class ProductCollector extends ProductFill  implements ProductInterface{
    protected $product;
    protected $scopeConfigInterface;
    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager , ScopeConfigInterface $scopeConfigInterface) {
        parent::__construct($storeManager);
        $this->scopeConfigInterface = $scopeConfigInterface;
    }
    public function getProduct($productId) {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->product = $objectManager->get('Magento\Catalog\Model\Product')->load($productId);
        
        return $this->fillProduct();
    }

   
    public function getProductBySku($barcode) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productId = $objectManager->get('Magento\Catalog\Model\Product')->getIdBySku($barcode);
        $this->product = $product = $objectManager->get('Magento\Catalog\Model\Product')->load($productId);
        return $this->fillProduct();
    }

    public function getRelatedProduct($productId) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
         $this->product = $objectManager->get('Magento\Catalog\Model\Product')->load($productId);
         $result = array();
        if (! $this->product->hasRelatedProductIds()) {
            foreach (  $this->product->getRelatedProducts() as $product) {
              $this->product =  $this->getProduct($product->getID());
              $result[] = $this->fillProduct();
            }    
        }
        return $result;
    }

    public function getProductSearch($params) {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');
        if (!isset($params['pagesize']) || empty($params['pagesize']) || intval($params['pagesize']) < 1) {
            $pageSize = 20;
        } else {
            $pageSize = $params['pagesize'];
        }
        if (!isset($params['pageNumber']) || empty($params['pageNumber']) || intval($params['pageNumber']) < 1) {
            $pageNumber = 1;
        } else {
            $pageNumber = $params['pageNumber'] + 1;
        }
        if (isset($params['phrase']) && !empty($params['phrase']))
            $productCollection->addAttributeToFilter("name", ['like' => "%" . $params['phrase'] . "%"]);
        if (isset($params['category']) && !empty($params['category']))
            $productCollection->addCategoriesFilter(['eq' => $params['category']]);
        $productCollection->setPage($pageNumber, $pageSize);
        $products = array();
        foreach ($productCollection as $product) {
            $products[] = $this->getProduct($product->getID());
        }
        $totalResultCount = sizeof($products);
        $result = $this->fillProductSearch($totalResultCount, $pageNumber, $pageSize, $products);
        return $result;
    }

}
