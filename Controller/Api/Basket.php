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
    private $_jsonResult;
    /**
     * @var BasketRepositoryInterface
     */
    private $_basketRepository;

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
        $this->_jsonResult = $json->create();
        $this->_basketRepository = $basketRepository;
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
            $result = $this->_basketRepository->getByBasketById($basketId);
        } elseif (count($params) > 0 && !empty($params[key($params)])) {
            $key = key($params);
            $param = ucfirst($params[key($params)]);
            $method = "get$param";
            if (method_exists($this->_basketRepository, $method)) {
                $allKeys = array_keys($params);
                if (sizeof($allKeys) == 1) {
                    $result = $this->_basketRepository->{$method}($key);
                } else {
                    $endArray = end($allKeys);
                    $lastKey = ($endArray);
                    $result = $this->_basketRepository->{$method}(
                        $key,
                        $lastKey
                    );
                }
            }
        } else {
            
            $result = $this->_basketRepository->getUserBasket();
        }
        $this->_jsonResult->setData($result);
        return $this->_jsonResult;
    }
}
