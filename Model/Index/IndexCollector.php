<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Index;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Store\Model\StoreManagerInterface;
use TmobLabs\Tappz\API\Data\IndexInterface;
use TmobLabs\Tappz\Model\Category\CategoryRepository as CategoryRepository;
use TmobLabs\Tappz\Model\Product\ProductCollector;

/**
 * Class IndexCollector.
 */
class IndexCollector extends IndexFill implements IndexInterface
{
    /**
     * @var CategoryFactory
     */
    private $_categoryFactory;
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;
    /**
     * @var ProductCollector
     */
    public $productCollector;

    /**
     * IndexCollector constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param CategoryRepository    $categoryRepository
     * @param ProductCollector      $productCollector
     * @param CategoryFactory       $categoryFactory
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        CategoryRepository $categoryRepository,
        ProductCollector $productCollector,
        CategoryFactory $categoryFactory
    ) {
        parent::__construct($storeManager);
        $this->categoryRepository = $categoryRepository;
        $this->productCollector = $productCollector;
        $this->_categoryFactory = $categoryFactory;
    }

    /**
     * @return array
     */
    public function getIndex()
    {
        $categories = $this->categoryRepository->getCategories();
        $items = [];
        $groups = [];
        foreach ($categories as $category) {
            $id = $category['id'];
            $name = $category['name'];
            $image = null;
            $collection = $this->getCategoryProducts($id);
            foreach ($collection as $_product) {
                $items[] = $this->productCollector->getProduct(
                    $_product->getId()
                );
            }
            if (count($items) > 0) {
                $groups[] = $this->fillGroups($name, $image, $items);
            }
        }
        $this->setGroups($groups);
        $action = $this->fillActions();
        $ads[] = $this->fillAds('', '', $action);
        $this->setAds($ads);

        return $this->fillIndex();
    }

    /**
     * @param $categoryId
     *
     * @return mixed
     */
    public function getCategory($categoryId)
    {
        $category = $this->_categoryFactory->create();
        $category->load($categoryId);

        return $category;
    }

    /**
     * @param $categoryId
     *
     * @return mixed
     */
    public function getCategoryProducts($categoryId)
    {
        $products = $this->getCategory($categoryId)->getProductCollection();
        $products->addAttributeToSelect('*');

        return $products;
    }
}
