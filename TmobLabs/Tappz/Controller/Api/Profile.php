<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\ProfileRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

class Profile extends Action {

    protected $jsonResult;
    private $profileRepository;
    protected $helper;

    public function __construct(Context $context, JSON $json, ProfileRepositoryInterface $profileRepository, RequestHandler $helper) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->helper = $helper;
        $this->profileRepository = $profileRepository;
    }

    public function execute() {
        
        $method = $this->helper->getRequestMethod();
        switch ($method) {
            case "GET":
               $result = $this->profileRepository->getProfile();
                break;
            case "POST":
                $result = $this->profileRepository->createProfile();
                break;
            case "PUT":
                $result = $this->profileRepository->editProfile();
                break;
            default:
                break;
        }
        
        $this->jsonResult->setData($result);
        return $this->jsonResult;
    }

}
