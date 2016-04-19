<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\LocationRepositoryInterface as LocationRepositoryInterface;

class States extends Action {

    protected $jsonResult;
    private $locationRepository;

    public function __construct(Context $context, JSON $json, LocationRepositoryInterface $locationRepository) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->locationRepository = $locationRepository;
    }

    public function execute() {
        $params = ($this->getRequest()->getParams());
        $countryId = key($params);

        $result = $this->locationRepository->getStates($countryId);

        $this->jsonResult->setData($result);
        return $this->jsonResult;
    }

}
