<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\BasketRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

class MergeBasket extends Action
{

	protected $jsonResult;
	private $basketRepository;

	public function __construct(Context $context, JSON $json, BasketRepositoryInterface $basketRepository,	RequestHandler $helper)
	{
		parent::__construct($context);
		$this->jsonResult = $json->create();
		$this->basketRepository = $basketRepository;
		$helper->checkAuth();
	}

	public function execute()
	{


		$result = $this->basketRepository->merge();
		$this->jsonResult->setData($result);
		return $this->jsonResult;
	}

}
