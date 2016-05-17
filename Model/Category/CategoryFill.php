<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Category;

/**
 * Class CategoryFill.
 */
class CategoryFill extends Category
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * CategoryFill constructor.
     *
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }

    /**
     * @return array
     */
    public function fillCategory()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'isRoot' => $this->getIsRoot(),
            'isLeaf' => $this->getIsLeaf(),
            'parentCategoryId' => $this->getParentCategoryId(),
            'children' => $this->getChildren(),
            'description' => $this->getDescription(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }
}
