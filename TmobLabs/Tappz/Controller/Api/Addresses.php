<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\AddressRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

class Addresses extends Action {

    protected $jsonResult;
    private $addressRepository;
    protected $helper;

    public function __construct(Context $context, JSON $json, AddressRepositoryInterface $addressRepository, RequestHandler $helper) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->helper = $helper;
        $this->addressRepository = $addressRepository;
    }

    public function execute() {
        $method = $this->helper->getRequestMethod();

        switch ($method) {
            case "POST":

                $result = $this->addressRepository->createAddress();
                break;
            case "PUT":
                $result = $this->addressRepository->editAddress();
                break;
            case "DELETE":
                $result = $this->addressRepository->deleteAddress();
                break;
            default:
                break;
        }
        $this->jsonResult->setData($result);
        return $this->jsonResult;
    }

}
