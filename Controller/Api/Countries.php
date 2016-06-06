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
use TmobLabs\Tappz\API\LocationRepositoryInterface as LocationRepositoryI;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class Countries.
 */
class Countries extends Action
{
    /**
     * @var
     */
    private $_jsonResult;
    /**
     * @var LocationRepository
     */
    private $_locationRepository;

    /**
     * Countries constructor.
     *
     * @param Context $context
     * @param JSON $json
     * @param LocationRepositoryI $locationRepository
     * @param RequestHandler $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        LocationRepositoryI $locationRepository,
        RequestHandler $helper
    ) {
        parent::__construct($context);
        $this->_jsonResult = $json->create();
        $this->_locationRepository = $locationRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $result = $this->_locationRepository->getCountries();
        $this->_jsonResult->setData($result);
        return $this->_jsonResult;
    }
}
