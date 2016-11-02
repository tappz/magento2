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
use TmobLabs\Tappz\API\BasketRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class Basket.
 */
class Basket extends Action
{
    /**
     * @var
     */
    private $jsonResult;
    /**
     * @var BasketRepositoryInterface
     */
    private $basketRepository;

    /**
     * Basket constructor.
     *
     * @param Context $context
     * @param JSON $json
     * @param BasketRepositoryInterface $basketRepository
     * @param RequestHandler $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        BasketRepositoryInterface $basketRepository,
        RequestHandler $helper
    ) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->basketRepository = $basketRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $params = ($this->getRequest()->getParams());
   
        $result = [];
        if (count($params) > 0 && empty($params[key($params)])) {
            $basketId = key($params);
            $result = $this->basketRepository->getByBasketById($basketId);
        } else if (count($params) > 0 && !empty($params[key($params)])) {
            $key = key($params);
            $param = ucfirst($params[key($params)]);
            $method = "get$param";
            if (method_exists($this->basketRepository, $method)) {
                $allKeys = array_keys($params);
                if (count($allKeys) == 1) {
                    $result = $this->basketRepository->{$method}($key);
                } else {
                    $endArray = end($allKeys);
                    $lastKey = ($endArray);
                    $result = $this->basketRepository->{$method}(
                        $key,
                        $lastKey
                    );
                }
            }
        } else {
            $result = $this->basketRepository->getUserBasket();
        }
        $this->jsonResult->setData($result);
        return $this->jsonResult;
    }
}
