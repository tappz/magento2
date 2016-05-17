<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Product;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\ProductInterface;

/**
 * Class Product.
 */
class Product extends AbstractExtensibleObject implements ProductInterface
{
    /**
     * @var string
     */
    protected $product;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->product->getId();
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->product->getName();
    }

    /**
     * @return array|string
     */
    public function getListPrice()
    {
        $specialPrice = (double) $this->product->getData('specialPrice');
        $listPrice = (double) $this->product->getData('price');
        $amount = ($specialPrice) > 0 ? $specialPrice : $listPrice;
        $currency = $defaultCurrency = $this->_storeManager->getStore()->getCurrentCurrency()->getCode();

        return $this->fillProductPrice($amount, $currency, $currency);
    }

    /**
     *
     */
    public function getNoImageUrl()
    {
        return;
    }

    /**
     *
     */
    public function getHeadline()
    {
        return;
    }

    /**
     * @return array|string
     */
    public function getStrikeOutPrice()
    {
        $specialPrice = $this->product->getData('specialPrice');
        $amount = ($specialPrice) > 0 ? $specialPrice : 0;
        $currency = $this->_storeManager->getStore()->getCurrentCurrency()->getCode();

        return $this->fillProductPrice($amount, $currency, $currency);
    }

    /**
     * @return bool
     */
    public function getIsCampaign()
    {
        return false;
    }

    /**
     * @return array
     */
    public function getCreditCardInstallments()
    {
        return array();
    }

    /**
     * @return string
     */
    public function getShipmentInformation()
    {
        return '';
    }

    /**
     * @return array|null|string
     */
    public function getActions()
    {
        $actions = $this->fillActions();

        return !empty($actions->type) ? $actions : null;
    }

    /**
     *
     */
    public function getFeatures()
    {
        return;
    }

    /**
     * @return array
     */
    public function getVariants()
    {
        $result = array();
        $productType = $this->product->getTypeId();
        if ($productType == 'configurable') {
            $instanceConf = $this->product->getTypeInstance();

            $configurableAttributesData = $instanceConf->getConfigurableAttributesAsArray($this->product);
            foreach ($configurableAttributesData as $dt => $val) {
                $group = array();

                $group['groupId'] = $val['attribute_code'];
                $group['groupName'] = $val['label'];
                foreach ($val['values'] as $vv) {
                    $groupValue = array();

                    $groupValue['displayName'] = $vv['label'];
                    $groupValue['value'] = $vv['value_index'];
                    $group['features'][] = $groupValue;
                }
                $result[] = $group;
            }
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function getInStock()
    {
        $result = isset($this->product->getQuantityAndStockStatus()['is_in_stock']) ? $this->product->getQuantityAndStockStatus()['is_in_stock'] : false;

        return $result;
    }

    /**
     * @return bool
     */
    public function getIsShipmentFree()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        $baseUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $result = $this->product->getImage();

        return $baseUrl.'catalog/product'.$result;
    }

    /**
     * @return array
     */
    public function getPictures()
    {
        $images = $this->product->getMediaGalleryImages();
        $image = array();
        $result = array();
        if (isset($images)) {
            if (count($images) > 0) {
                foreach ($images as $image) {
                    $result[]['url'] = $image->getUrl();
                }
            } else {
                $result[0]['url'] = $this->product->getImageUrl($this->product);
            }
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getProductDetailUrl()
    {
        return $this->product->getDescription();
    }

    /**
     * @return mixed
     */
    public function getProductUrl()
    {
        return $this->product->getProductUrl();
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return 0;
    }

    /**
     * @return bool
     */
    public function getUnit()
    {
        $result = isset($this->product->getQuantityAndStockStatus()['is_in_stock']) ? $this->product->getQuantityAndStockStatus()['is_in_stock'] : false;

        return $result;
    }

    /**
     * @return bool
     */
    public function getIsFavorite()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getIsBackInStockSubscription()
    {
        return false;
    }

    /**
     * @return array
     */
    public function getBackInStockSubSelectedVariant()
    {
        return array();
    }

    /**
     * @return array|string
     */
    public function getAdditionalTexts()
    {
        return $this->fillAditionalTexts();
    }

    /**
     *
     */
    public function getErrorCode()
    {
        return;
    }

    /**
     *
     */
    public function getMessage()
    {
        return;
    }

    /**
     * @return bool
     */
    public function getUserFriendly()
    {
        return true;
    }

    /**
     *
     */
    public function getShoutOutTexts()
    {
        return;
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
    public function fillActions($type = '', $image = '', $text = '', $productId = '', $href = '', $categoryId = '')
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
     * @param string $key
     * @param string $text
     *
     * @return array
     */
    public function fillAditionalTexts($key = '', $text = '')
    {
        return [
            'key' => $key,
            'text' => $text,
        ];
    }

    /**
     * @param int  $amount
     * @param null $defaultCurrency
     * @param null $currency
     *
     * @return array
     */
    public function fillProductPrice($amount = 0, $defaultCurrency = null, $currency = null)
    {
        return [
            'amount' => number_format($amount, 2, '.', ''),
            'amountDefaultCurrency' => $defaultCurrency,
            'currency' => $currency,
        ];
    }

    /**
     * @param null $groupName
     * @param null $groupId
     * @param null $features
     *
     * @return array
     */
    public function fillBackInStockSubSelectedVariant($groupName = null, $groupId = null, $features = null)
    {
        return [
            'groupName' => $groupName,
            'groupId' => $groupId,
            'features' => $features,
        ];
    }

    /**
     * @return array
     */
    public function fillFilters()
    {
        return [
            'id' => 'string',
            'displayName' => 'string',
            'selectedItemId' => 'string',
            'rangeStart' => 'string',
            'rangeEnd' => 'string',
            'FilterType' => 'string',
            'items' => [

            ],
        ];
    }

    /**
     *
     */
    public function fillFilterItems()
    {
    }

    /**
     * @return array
     */
    public function fillShortList()
    {
        return [
            ['value' => 'name-asc', 'displayName' => 'Name (Ascending)'],
            ['value' => 'name-desc', 'displayName' => 'Name (Descending)'],
            ['value' => 'price-asc', 'displayName' => 'Price (Ascending)'],
            ['value' => 'price-desc', 'displayName' => 'Price (Descending)'],
        ];
    }

    /**
     * @param $product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @param $product
     *
     * @return string
     */
    public function getProduct($product)
    {
        return $this->product;
    }

    /**
     * @param $parentProductId
     * @param $attributeList
     *
     * @return int
     */
    public function getChildProductId($parentProductId, $attributeList)
    {
        $subProductIds = Mage::getModel('catalog/product_type_configurable')
            ->getChildrenIds($parentProductId); //get the children ids through a simple query
        $subProducts = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToFilter('entity_id', $subProductIds);
        foreach ($attributeList as $attribute) {
            $attributeCode = $attribute->id;
            $attributeValueIndex = $attribute->values[0]->id;
            $subProducts->addAttributeToFilter($attributeCode, $attributeValueIndex);
        }
        $product = null;
        if ($subProducts->getSize() > 0) {
            $product = $subProducts->getFirstItem();
        }

        return $product == null ? 0 : $product->getId();
    }
}