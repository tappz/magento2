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
use TmobLabs\Tappz\API\LocationRepositoryInterface as LocationRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class Districts.
 */
class Districts extends Action
{
    /**
     * @var
     */
    protected $jsonResult;
    /**
     * @var LocationRepositoryInterface
     */
    private $locationRepository;

    /**
     * Districts constructor.
     *
     * @param Context                     $context
     * @param JSON                        $json
     * @param LocationRepositoryInterface $locationRepository
     * @param RequestHandler              $helper
     */
    public function __construct(Context $context,
                                JSON $json,
                                LocationRepositoryInterface $locationRepository,
                                RequestHandler $helper)
    {
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
        $cityId = key($params);
        $result = $this->locationRepository->getDistricts($cityId);
        $this->jsonResult->setData($result);

        return $this->jsonResult;
    }
}
