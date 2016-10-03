<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Category;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\CategoryInterface;

/**
 * Class Category.
 */
class Category extends AbstractExtensibleObject implements CategoryInterface
{
    /**
     * @var
     */
    public $category;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->category->getId();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->category->getName();
    }

    /**
     *
     */
    public function getAgreementText()
    {
        return '';
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        $result = [];
        $categories = $this->category->getChildrenCategories();
        if (($categories)) {
            foreach ($categories as $category) {
                $this->category = $category;
                $result[] = $this->fillCategory();
            }
        }

        return $result;
    }

    /**
     *
     */
    public function getErrorCode()
    {
        return '';
    }

    /**
     * @return bool
     */
    public function getIsLeaf()
    {
        return $this->category->getChildrenCount() == 0;
    }

    /**
     * @return bool
     */
    public function getIsRoot()
    {
        $categoryId = $this->getParentCategoryId();
        $rootCategory = $this->getRootCategory();
        $response = $categoryId == $rootCategory ? true : false;
        return $response;
    }

    /**
     * @return mixed
     */
    public function getParentCategoryId()
    {
        return $this->category->getParentId();
    }

    /**
     * @return mixed
     */
    public function getRootCategory()
    {
        $store = $this->currentStore();

        return $store->getStore()->getRootCategoryId();
    }

    /**
     * @return mixed
     */
    public function currentStore()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        return $objectManager->get('Magento\Store\Model\StoreManagerInterface');
    }

    /**
     *
     */
    public function getMessage()
    {
        return '';
    }

    /**
     *
     */
    public function getDescription()
    {
        return '';
    }

    /**
     * @return bool
     */
    public function getUserFriendly()
    {
        return false;
    }

    /**
     * @param bool $sorted
     * @param bool $asCollection
     * @param bool $toLoad
     *
     * @return mixed
     */
    public function getStoreCategories(
        $sorted = false,
        $asCollection = true,
        $toLoad = true
    ) {
        return $this->categoryHelper->
        getStoreCategories($sorted, $asCollection, $toLoad);
    }
}
