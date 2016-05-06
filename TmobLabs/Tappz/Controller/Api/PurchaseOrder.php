<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\OrderRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

class PurchaseOrder extends Action
{

	protected $jsonResult;
	private $orderRepository;
	protected $helper;

	public function __construct(
		Context $context,
		JSON $json,
		OrderRepositoryInterface $orderRepository,
		RequestHandler $helper
	) {
		parent::__construct($context);
		$this->jsonResult = $json->create();
		$this->helper = $helper;
		$this->orderRepository = $orderRepository;
	}

	public function execute()
	{
		$params = ($this->getRequest()->getParams());
		$method = $this->helper->getRequestMethod();
		switch ($method) {
			case "GET":
				if (count($params) > 0) {
					echo 1;
					print_r($params);
					exit;
					$result = $this->productRepository->getRelatedProduct($productId);

				} else {
					echo 2;
					$result = $this->orderRepository->getOrder();
				}
				break;
			case "POST":
				$result = $this->orderRepository->setOrderAddress();
				break;
			default:
				break;
		}
		$this->jsonResult->setData($result);
		return $this->jsonResult;
	}
}
