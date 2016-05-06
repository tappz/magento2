<?php

namespace TmobLabs\Tappz\Model\Product;

use TmobLabs\Tappz\API\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

	/**
	 * @var ProductCollector
	 */
	private $productCollector;

	/**
	 * @param ProductCollector $productCollector
	 */
	public function __construct(
		ProductCollector $productCollector
	) {
		$this->productCollector = $productCollector;
	}

	public function getById($productId)
	{
		$result = $this->productCollector->getProduct($productId);
		return $result;
	}

	public function getRelatedProduct($productId)
	{
		$result = $this->productCollector->getRelatedProduct($productId);
		return $result;
	}

	public function getByBarcode($barcode)
	{
		$result = $this->productCollector->getProductBySku($barcode);
		return $result;
	}

	public function getProductSearch($params)
	{
		$result = $this->productCollector->getProductSearch($params);
		return $result;
	}

}
