<?php

namespace TmobLabs\Tappz\Model\Basket;

use TmobLabs\Tappz\API\BasketRepositoryInterface;
use TmobLabs\Tappz\Model\Purchase\PurchaseCollector;

class BasketRepository implements BasketRepositoryInterface
{

	private $basketCollector;
	private $purchaseCollector;

	public function __construct(
		BasketCollector $basketCollector,
		PurchaseCollector $purchaseCollector
	) {
		$this->basketCollector = $basketCollector;
		$this->purchaseCollector = $purchaseCollector;
	}

	public function getByBasketById($basketId)
	{
		$result = $this->basketCollector->getBasketById($basketId);
		return $result;
	}

	public function getUserBasket()
	{
		$result = $this->basketCollector->getUserBasket();
		return $result;
	}

	public function getPayment($quoteId)
	{
		$result = $this->basketCollector->getBasketPayment($quoteId);
		return $result;
	}

	public function getLines($quoteId = null)
	{
		$result = $this->basketCollector->getLines($quoteId);
		return $result;
	}

	public function getAddress($quoteId = null)
	{

		$result = $this->basketCollector->setAddress($quoteId);
		return $result;
	}

	public function getContract($quoteId = null)
	{
		$result = $this->basketCollector->getBasketContract($quoteId);
		return $result;
	}

	public function getPurchase($quoteId, $method)
	{

		$result = $this->purchaseCollector->getPurchase($quoteId, $method);
		return $result;
	}

	public function merge()
	{
		$result = $this->basketCollector->merge();
		return $result;
	}
}
