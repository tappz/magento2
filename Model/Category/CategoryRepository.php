<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Category;

use TmobLabs\Tappz\API\CategoryRepositoryInterface;

/**
 * Class CategoryRepository.
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var CategoryCollector
     */
    private $categoryCollector ;

    /**
     * CategoryRepository constructor.
     *
     * @param CategoryCollector $categoryCollector
     */
    public function __construct(
        CategoryCollector $categoryCollector
    ) {
        $this->categoryCollector  = $categoryCollector;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        $result = $this->categoryCollector ->getCategories();
        return $result;
    }

    /**
     * @param $categoryId
     *
     * @return array
     */
    public function getByCategoryById($categoryId)
    {
        $result = $this->categoryCollector ->getCategory($categoryId);
        return $result;
    }
}
