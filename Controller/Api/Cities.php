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
 * Class Cities.
 */
class Cities extends Action
{
    /**
     * @var
     */
    public $jsonResult;
    /**
     * @var LocationRepositoryI
     */
    private $locationRepository;

    /**
     * Cities constructor.
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
        $this->jsonResult = $json->create();
        $this->locationRepository = $locationRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $params = ($this->getRequest()->getParams());
        $countryId = key($params);
        $result = $this->locationRepository->getCities($countryId);
        $this->jsonResult->setData($result);

        return $this->jsonResult;
    }
}
