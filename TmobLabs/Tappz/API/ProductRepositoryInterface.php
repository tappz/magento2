<?php

namespace TmobLabs\Tappz\API;

interface ProductRepositoryInterface
{

	public function getById($productId);

	public function getByBarcode($productId);

	public function getProductSearch($params);

	public function getRelatedProduct($productId);
}
