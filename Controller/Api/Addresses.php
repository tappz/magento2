<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\AddressRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class Addresses.
 */
class Addresses extends Action
{
    /**
     * @var RequestHandler
     */
    public $helper;
    /**
     * @var
     */
    private $jsonResult;
    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * Addresses constructor.
     *
     * @param Context $context
     * @param JSON $json
     * @param AddressRepositoryInterface $addressRepository
     * @param RequestHandler $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        AddressRepositoryInterface $addressRepository,
        RequestHandler $helper
    ) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->helper = $helper;
        $this->addressRepository = $addressRepository;
        $this->helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $method = $this->helper->getRequestMethod();
        $result = [];
        switch ($method) {
            case 'POST':
                $result = $this->addressRepository->createAddress();
                break;
            case 'PUT':
                $result = $this->addressRepository->editAddress();
                break;
            case 'DELETE':
                $result = $this->addressRepository->deleteAddress();
                break;
            default:
                break;
        }
        $this->jsonResult->setData($result);

        return $this->jsonResult;
    }
}
