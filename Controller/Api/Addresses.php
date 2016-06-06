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
    protected $_helper;
    /**
     * @var
     */
    private $_jsonResult;
    /**
     * @var AddressRepositoryInterface
     */
    private $_addressRepository;

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
        $this->_jsonResult = $json->create();
        $this->_helper = $helper;
        $this->_addressRepository = $addressRepository;
        $this->_helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $method = $this->_helper->getRequestMethod();
        switch ($method) {
            case 'POST':
                $result = $this->_addressRepository->createAddress();
                break;
            case 'PUT':
                $result = $this->_addressRepository->editAddress();
                break;
            case 'DELETE':
                $result = $this->_addressRepository->deleteAddress();
                break;
            default:
                break;
        }
        $this->_jsonResult->setData($result);

        return $this->_jsonResult;
    }
}
