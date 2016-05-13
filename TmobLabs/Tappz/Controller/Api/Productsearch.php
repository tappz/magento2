<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\ProductRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;


class ProductSearch extends Action
{
	protected $jsonResult;
	private $productRepository;

	public function __construct(Context $context, JSON $json, ProductRepositoryInterface $productRepository,	RequestHandler $helper)
	{
		parent::__construct($context);
		$this->jsonResult = $json->create();
		$this->productRepository = $productRepository;
		$helper->checkAuth();
	}

	public function execute()
	{

		$params = ($this->getRequest()->getParams());
		$result = $this->productRepository->getProductSearch($params);
		$this->jsonResult->setData($result);
		return $this->jsonResult;

	}
}