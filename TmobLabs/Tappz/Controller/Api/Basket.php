<?php

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\BasketRepositoryInterface;

class Basket extends Action {

    protected $jsonResult;
    private $basketRepository;

    public function __construct(Context $context, JSON $json, BasketRepositoryInterface $basketRepository) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->basketRepository = $basketRepository;
    }

    public function execute() {
        $params = ($this->getRequest()->getParams());

        $result = array ();
     
        if (count($params) > 0 && empty($params[key($params)])) {
            $basketId = key($params);
            $result = $this->basketRepository->getByBasketById($basketId);
        } elseif (count($params) > 0 && !empty($params[key($params)])) {
            $key = key($params);
            $param = ucfirst($params[key($params)]);
            $method = "get$param";
            if (method_exists($this->basketRepository, $method) ) {
                $result = $this->basketRepository->{$method}($key);
            }
        }else{
              $result = $this->basketRepository->getUserBasket();
        }
        $this->jsonResult->setData($result);
        return $this->jsonResult;
    }

}
