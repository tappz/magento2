<?php

namespace TmobLabs\Tappz\Model\Product;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\ProductInterface;

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

	public function getProductName()
	{
		return $this->product->getName();
	}

	public function getListPrice()
	{
		$specialPrice = (double)$this->product->getData('specialPrice');
		$listPrice = (double)$this->product->getData('price');
		$amount = ($specialPrice) > 0 ? $specialPrice : $listPrice;
		$currency = $defaultCurrency = $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
		return $this->fillProductPrice($amount, $currency, $currency);
	}

	public function getNoImageUrl()
	{
		return null;
	}

	public function getHeadline()
	{
		return null;
	}

	public function getStrikeOutPrice()
	{
		$specialPrice = $this->product->getData('specialPrice');
		$amount = ($specialPrice) > 0 ? $specialPrice : 0;
		$currency = $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
		return $this->fillProductPrice($amount, $currency, $currency);
	}

	public function getIsCampaign()
	{
		return false;
	}

	public function getCreditCardInstallments()
	{
		return array();
	}

	public function getShipmentInformation()
	{
		return "";
	}

	public function getActions()
	{
		$actions = $this->fillActions();
		return !empty($actions->type) ? $actions : null;

	}

	public function getFeatures()
	{
		return null;
	}

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
		return array();
	}

	public function getInStock()
	{

		$result = isset($this->product->getQuantityAndStockStatus()["is_in_stock"]) ? $this->product->getQuantityAndStockStatus()["is_in_stock"] : false;
		return $result;
	}

	public function getIsShipmentFree()
	{
		return false;
	}

	public function getPicture()
	{
		$baseUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		$result = $this->product->getImage();
		return $baseUrl . "catalog/product" . $result;
	}

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

	public function getProductDetailUrl()
	{
		return $this->product->getDescription();
	}

	public function getProductUrl()
	{
		return $this->product->getProductUrl();
	}

	public function getPoints()
	{
		return 0;
	}

	public function getUnit()
	{
		$result = isset($this->product->getQuantityAndStockStatus()["is_in_stock"]) ? $this->product->getQuantityAndStockStatus()["is_in_stock"] : false;
		return $result;
	}

	public function getIsFavorite()
	{
		return false;
	}

	public function getIsBackInStockSubscription()
	{
		return false;
	}

	public function getBackInStockSubSelectedVariant()
	{

		return array();
	}

	public function getAdditionalTexts()
	{
		return $this->fillAditionalTexts();
	}

	public function getErrorCode()
	{
		return null;
	}

	public function getMessage()
	{
		return null;
	}

	public function getUserFriendly()
	{
		return true;
	}

	public function getShoutOutTexts()
	{
		return null;
	}

	public function fillActions($type = "", $image = "", $text = "", $productId = "", $href = "", $categoryId = "")
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

	public function fillAditionalTexts($key = "", $text = "")
	{
		return [
			'key' => $key,
			'text' => $text
		];
	}

	public function fillProductPrice($amount = 0, $defaultCurrency = null, $currency = null)
	{
		return [
			'amount' => number_format($amount, 2, '.', ''),
			'amountDefaultCurrency' => $defaultCurrency,
			'currency' => $currency
		];
	}

	public function fillBackInStockSubSelectedVariant($groupName = null, $groupId = null, $features = null)
	{
		return [
			'groupName' => $groupName,
			'groupId' => $groupId,
			'features' => $features
		];
	}

	public function fillFilters()
	{
		return [
			"id" => "string",
			"displayName" => "string",
			"selectedItemId" => "string",
			"rangeStart" => "string",
			"rangeEnd" => "string",
			"FilterType" => "string",
			"items" => [

			]
		];
	}

	public function fillFilterItems()
	{

	}

	public function fillShortList()
	{
		return [
			['value' => 'name-asc', 'displayName' => 'Name (Ascending)'],
			['value' => 'name-desc', 'displayName' => 'Name (Descending)'],
			['value' => 'price-asc', 'displayName' => 'Price (Ascending)'],
			['value' => 'price-desc', 'displayName' => 'Price (Descending)']
		];
	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
	}

	public function getProduct($product)
	{
		return $this->product;
	}

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
