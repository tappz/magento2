<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\IndexRepositoryInterface;

class Index extends Action
{

	protected $jsonResult;
	private $indexRepository;

	public function __construct(Context $context, JSON $json, IndexRepositoryInterface $indexRepository)
	{
		parent::__construct($context);
		$this->jsonResult = $json->create();
		$this->indexRepository = $indexRepository;
	}

	public function execute()
	{
		$result = $this->indexRepository->getIndex();
		$this->jsonResult->setData($result);
		return $this->jsonResult;
	}

}
