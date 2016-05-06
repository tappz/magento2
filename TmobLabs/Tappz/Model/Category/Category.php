<?php

namespace TmobLabs\Tappz\Model\Category;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\CategoryInterface;

class Category extends AbstractExtensibleObject implements CategoryInterface
{

	protected $category;

	public function getId()
	{
		return $this->category->getId();
	}

	public function getName()
	{
		return $this->category->getName();
	}

	public function getAgreementText()
	{
		return null;
	}

	public function getChildren()
	{

		$result = array();
		$categories = $this->category->getChildrenCategories();
		if (($categories)) {
			foreach ($categories as $category) {
				$this->category = $category;
				$result[] = $this->fillCategory();
			}
		}
		return $result;
	}

	public function getErrorCode()
	{
		return null;
	}

	public function getIsLeaf()
	{
		return $this->category->getChildrenCount() == 0;
	}

	public function getIsRoot()
	{
		return $this->getParentCategoryId() == $this->getRootCategory() ? true : false;
	}

	public function getMessage()
	{
		return null;
	}

	public function getDescription()
	{
		return null;
	}

	public function getParentCategoryId()
	{
		return $this->category->getParentId();
	}

	public function getUserFriendly()
	{
		return false;
	}

	public function getStoreCategories($sorted = false, $asCollection = true, $toLoad = true)
	{
		return $this->categoryHelper->getStoreCategories($sorted, $asCollection, $toLoad);
	}

	public function getRootCategory()
	{
		$store = $this->currentStore();
		return $store->getStore()->getRootCategoryId();
	}

	public function currentStore()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		return $objectManager->get('Magento\Store\Model\StoreManagerInterface');

	}

}
