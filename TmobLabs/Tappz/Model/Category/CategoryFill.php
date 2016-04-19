<?php

namespace TmobLabs\Tappz\Model\Category;

use TmobLabs\Tappz\Model\Category\Category;

class CategoryFill extends Category {

    protected $_storeManager;

    public function __construct(
    \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }

    public function fillCategory() {

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
