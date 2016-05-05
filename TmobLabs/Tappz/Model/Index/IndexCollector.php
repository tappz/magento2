<?php

namespace TmobLabs\Tappz\Model\Index;

use TmobLabs\Tappz\Model\Category\CategoryRepository as CategoryRepository;
use TmobLabs\Tappz\Model\Product\ProductCollector;
use TmobLabs\Tappz\API\Data\IndexInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Store\Model\StoreManagerInterface;

class IndexCollector extends IndexFill implements IndexInterface {


    private $_categoryFactory;
    public $categoryRepository;
    public $productCollector;

    public function __construct(
    StoreManagerInterface $storeManager, CategoryRepository $categoryRepository, ProductCollector $productCollector, CategoryFactory $categoryFactory
    ) {
        parent::__construct($storeManager);
        $this->categoryRepository = $categoryRepository;
        $this->productCollector = $productCollector;
        $this->_categoryFactory = $categoryFactory;
    }

    public function getIndex() {
        $categories = $this->categoryRepository->getCategories();
        $items = array();
        $groups = array();
        foreach ($categories as $category) {
            $id = $category['id'];
            $name = $category['name'];
            $image = null;
            $collection = $this->getCategoryProducts($id);
            foreach ($collection as $_product) {
                $items[] = $this->productCollector->getProduct($_product->getId());
            }
            if(count($items)>0 ){
                $groups[] = $this->fillGroups($name, $image, $items);
            }
        }
        $this->setGroups( $groups);
        $action = $this->fillActions();
        $ads[] = $this->fillAds("","",$action);
        $this->setAds($ads);
        return $this->fillIndex();
    }

    public function getCategory($categoryId) {
        $category = $this->_categoryFactory->create();
        $category->load($categoryId);
        return $category;
    }

    public function getCategoryProducts($categoryId) {
        $products = $this->getCategory($categoryId)->getProductCollection();
        $products->addAttributeToSelect('*');
        return $products;
    }

}
