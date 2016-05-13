<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\LocationRepositoryInterface as LocationRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

class Towns extends Action
{

	protected $jsonResult;
	private $locationRepository;

	public function __construct(Context $context, JSON $json, LocationRepositoryInterface $locationRepository,	RequestHandler $helper)
	{
		parent::__construct($context);
		$this->jsonResult = $json->create();
		$this->locationRepository = $locationRepository;
		$helper->checkAuth();
	}

	public function execute()
	{
		$params = ($this->getRequest()->getParams());
		$cityId = key($params);
		$result = $this->locationRepository->getTowns($cityId);
		$this->jsonResult->setData($result);
		return $this->jsonResult;
	}

}
