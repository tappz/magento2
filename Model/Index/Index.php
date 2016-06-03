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
    protected $_index;
    /**
     * @var
     */
    protected $_items;
    /**
     * @var
     */
    protected $_ads;
    /**
     * @var
     */
    protected $_adsAction;
    /**
     * @var
     */
    protected $_groups;
    /**
     * @var
     */
    protected $_categories;

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->_groups;
    }

    /**
     * @param $groups
     *
     * @return $this
     */
    public function setGroups($groups)
    {
        $this->_groups = $groups;

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
        return $this->_index;
    }

    /**
     * @param $index
     *
     * @return $this
     */
    public function setIndex($index)
    {
        $this->_index = $index;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * @param $item
     *
     * @return $this
     */
    public function setItems($item)
    {
        $this->_index = $item;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAds()
    {
        return $this->_ads;
    }

    /**
     * @param $ads
     *
     * @return $this
     */
    public function setAds($ads)
    {
        $this->_ads = $ads;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdsAction()
    {
        return $this->_adsAction;
    }

    /**
     * @param $adsAction
     *
     * @return $this
     */
    public function setAdsAction($adsAction)
    {
        $this->_adsAction = $adsAction;

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
    public function fillAds($displayName = '', $image = '', $action = [])
    {
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
    public function fillActions($type = '',
                                $image = '',
                                $text = '',
                                $productId = '',
                                $href = '',
                                $categoryId = '')
    {
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
        $this->_adsAction = $data;

        return $this;
    }
}
