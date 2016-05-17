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
use TmobLabs\Tappz\API\OrderRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class PurchaseOrder.
 */
class PurchaseOrder extends Action
{
    /**
     * @var
     */
    protected $jsonResult;
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var RequestHandler
     */
    protected $helper;

    /**
     * PurchaseOrder constructor.
     *
     * @param Context                  $context
     * @param JSON                     $json
     * @param OrderRepositoryInterface $orderRepository
     * @param RequestHandler           $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        OrderRepositoryInterface $orderRepository,

        RequestHandler $helper
    ) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->helper = $helper;
        $this->orderRepository = $orderRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $params = ($this->getRequest()->getParams());
        $method = $this->helper->getRequestMethod();

        $result = array();
        switch ($method) {
            case 'GET':
                if (count($params) > 0) {
                    $orderId = key($params);
                    $result = $this->orderRepository->getOrderById($orderId);
                } else {
                    $result = $this->orderRepository->getOrder();
                }
                break;
            default:
                break;
        }
        $this->jsonResult->setData($result);

        return $this->jsonResult;
    }
}
