<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Index;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\IndexInterface;

/**
 * Class Index.
 */
class Index extends AbstractExtensibleObject implements IndexInterface
{
    /**
     * @var
     */
    public $index;
    /**
     * @var
     */
    public $items;
    /**
     * @var
     */
    public $ads;
    /**
     * @var
     */
    public $adsAction;
    /**
     * @var
     */
    public $groups;
    /**
     * @var
     */
    public $categories;

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param $groups
     *
     * @return $this
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     *
     */
    public function getMessage()
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
     *
     */
    public function getErrorCode()
    {
        return '';
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param $index
     *
     * @return $this
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param $item
     *
     * @return $this
     */
    public function setItems($item)
    {
        $this->index = $item;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @param $ads
     *
     * @return $this
     */
    public function setAds($ads)
    {
        $this->ads = $ads;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdsAction()
    {
        return $this->adsAction;
    }

    /**
     * @param $adsAction
     *
     * @return $this
     */
    public function setAdsAction($adsAction)
    {
        $this->adsAction = $adsAction;

        return $this;
    }

    /**
     * @param string $displayName
     * @param string $image
     * @param array $items
     *
     * @return array
     */
    public function fillGroups($displayName = '', $image = '', $items = [])
    {
        return [
            'displayName' => $displayName,
            'image' => $image,
            'items' => $items,
        ];
    }

    /**
     * @param string $displayName
     * @param string $image
     * @param array $action
     *
     * @return array
     */
    public function fillAds(
        $displayName = '',
        $image = '',
        $action = []
    ) {
        return [
            'displayName' => $displayName,
            'image' => $image,
            'action' => $action,
        ];
    }

    /**
     * @param string $type
     * @param string $image
     * @param string $text
     * @param string $productId
     * @param string $href
     * @param string $categoryId
     *
     * @return array
     */
    public function fillActions(
        $type = '',
        $image = '',
        $text = '',
        $productId = '',
        $href = '',
        $categoryId = ''
    ) {
        return [
            'type' => $type,
            'image' => $image,
            'text' => $text,
            'productId' => $productId,
            'href' => $href,
            'categoryId' => $categoryId,
        ];
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setAction($data)
    {
        $this->adsAction = $data;

        return $this;
    }
}
