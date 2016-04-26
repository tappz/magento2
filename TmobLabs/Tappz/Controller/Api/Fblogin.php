<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\ProfileRepositoryInterface;

class Fblogin extends Action {

    protected $jsonResult;
    private $profileRepository;

    public function __construct(Context $context, JSON $json, ProfileRepositoryInterface $profileRepository) {
        parent::__construct($context);
        $this->jsonResult = $json->create();

        $this->profileRepository = $profileRepository;
    }

    public function execute() {
        $result = $this->profileRepository->fblogin();
        $this->jsonResult->setData($result);
        return $this->jsonResult;
    }

}
