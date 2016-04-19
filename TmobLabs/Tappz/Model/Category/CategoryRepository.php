<?php

namespace TmobLabs\Tappz\Model\Category;

use TmobLabs\Tappz\API\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface {


    private $categoryCollector;


    public function __construct(
    CategoryCollector $categoryCollector
    ) {
        $this->categoryCollector = $categoryCollector;
    }

    public function getCategories() {
        $result = $this->categoryCollector->getCategories();
        return $result;
    }

    public function getByCategoryById($categoryId) {
        $result = $this->categoryCollector->getCategory($categoryId);
        return $result;
    }

}
