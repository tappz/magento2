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
use Magento\Store\Model\StoreManagerInterface as StoreManagerInterface;
use TmobLabs\Tappz\API\Data\CategoryInterface;

/**
 * Class CategoryCollector.
 */
class CategoryCollector extends CategoryFill implements CategoryInterface
{
    /**
     * @var
     */
    protected $category;
    /**
     * @var CategoryHelper
     */
    protected $categoryHelper;
    /**
     * @var State
     */
    protected $state;
    /**
     * @var
     */
    protected $eventObserver;
    /**
     * @var
     */
    protected $categoryRepository;

    /**
     * CategoryCollector constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param CategoryHelper        $categoryHelper
     * @param State                 $state
     * @param CategoryTree          $categoryTree
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        CategoryHelper $categoryHelper,
        State $state,
        CategoryTree $categoryTree
    ) {
        parent::__construct($storeManager);
        $this->categoryHelper = $categoryHelper;
        $this->state = $state;
    }

    /**
     * @param $categoryId
     *
     * @return array
     */
    public function getCategory($categoryId)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->category = $objectManager->get('Magento\Catalog\Model\Category')->load($categoryId);

        return $this->fillCategory();
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        $result = array();
        $categories = $this->getStoreCategories(true, false, true);
        foreach ($categories as $category) {
            $this->category = $category;
            $result[] = $this->fillCategory();
        }

        return $result;
    }
}
