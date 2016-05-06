<?php

namespace TmobLabs\Tappz\Model\Category;

use Magento\Catalog\Api\Data\CategoryTreeInterface as CategoryTree;
use Magento\Catalog\Helper\Category as CategoryHelper;
use Magento\Catalog\Model\Indexer\Category\Flat\State as State;
use Magento\Store\Model\StoreManagerInterface as StoreManagerInterface;
use TmobLabs\Tappz\API\Data\CategoryInterface;

class CategoryCollector extends CategoryFill implements CategoryInterface
{

	protected $category;
	protected $categoryHelper;
	protected $state;
	protected $eventObserver;
	protected $categoryRepository;

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

	public function getCategory($categoryId)
	{


		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$this->category = $objectManager->get('Magento\Catalog\Model\Category')->load($categoryId);

		return $this->fillCategory();
	}

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
