<?php

namespace TmobLabs\Tappz\Model\Order;

use TmobLabs\Tappz\API\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{

	private $locationCollector;

	public function __construct(
		OrderCollector $orderCollector
	) {
		$this->orderCollector = $orderCollector;
	}

	public function getOrderById($orderId)
	{

		$result = $this->orderCollector->getOrderById($orderId);
		return $result;
	}
	public function getOrder()
	{

		$result = $this->orderCollector->getOrder();

		return $result;
	}


}
