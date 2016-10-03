<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Category;

use Magento\Catalog\Api\Data\CategoryTreeInterface as CategoryTree;
use Magento\Catalog\Helper\Category as CategoryHelper;
use Magento\Catalog\Model\Indexer\Category\Flat\State as State;
use TmobLabs\Tappz\API\Data\CategoryInterface;

/**
 * Class CategoryCollector.
 */
class CategoryCollector extends CategoryFill implements CategoryInterface
{
    /**
     * @var
     */
    public $category;
    /**
     * @var CategoryHelper
     */
    public $categoryHelper;

    /**
     * @var
     */
    public $categoryRepository;

    /**
     * CategoryCollector constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param CategoryHelper $categoryHelper
     * @param State $state
     */
    public function __construct(
        CategoryHelper $categoryHelper
    ) {
        $this->categoryHelper = $categoryHelper;

    }

    /**
     * @param $categoryId
     *
     * @return array
     */
    public function getCategory($categoryId)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->category =
            $objectManager
                ->get('Magento\Catalog\Model\Category')
                ->load($categoryId);
        return $this->fillCategory();
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        $result = [];
        $categories = $this->getStoreCategories(true, false, true);
        foreach ($categories as $category) {
            $this->category = $category;
            $result[] = $this->fillCategory();
        }
        return $result;
    }
}
