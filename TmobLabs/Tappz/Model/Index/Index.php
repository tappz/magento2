<?php

namespace TmobLabs\Tappz\Model\Index;

use TmobLabs\Tappz\API\Data\IndexInterface;
use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\Model\Category\CategoryRepository as  CategoryRepository;
class Index extends AbstractExtensibleObject implements IndexInterface {

    protected $index;
    protected $items;
    protected $ads;
    protected $adsAction;
    protected $groups;
    protected $categories;

    public function setGroups($groups) {
       $this->groups = $groups;
        return $this;
    }

    public function getGroups() {
        return $this->groups;
    }

    public function getMessage() {
        return null;
    }

    public function getUserFriendly() {
        return false;
    }

    public function getErrorCode() {
        return null;
    }

    public function getIndex() {
        return $this->index;
    }

    public function getItems() {
        return$this->items;
    }

    public function getAds() {
        return $this->ads;
    }

    public function getAdsAction() {
        return $this->adsAction;
    }

    public function setIndex($index) {
        $this->index = $index;
        return $this;
    }

    public function setItems($item) {
        $this->items = $item;
        return $this;
    }

    public function setAds($ads) {
        $this->ads = $ads;
        return $this;
    }

    public function setAdsAction($adsAction) {
        $this->adsAction = $adsAction;
        return $this;
    }
   public function fillGroups($displayName = "", $image = "", $items = array()) {
        return [
            'displayName' => $displayName,
            'image' => $image,
            'items' => $items
        ];
    }

    public function fillAds($displayName = "", $image = "", $action = array()) {
        return [
            'displayName' => $displayName,
            'image' => $image,
            'action' => $action
        ];
    }

    public function fillActions($type = "", $image = "", $text = "", $productId = "", $href = "", $categoryId = "") {
        return [
            'type' => $type,
            'image' => $image,
            'text' => $text,
            'productId' => $productId,
            'href' => $href,
            'categoryId' => $categoryId
        ];
    }
 
    private function setCategories(CategoryRepository $categories){
           $this->categories = $categories->getCategories();
           return $this; 
    }
    private function getCategories(){
           return $this->categories ;
          
    }
}
