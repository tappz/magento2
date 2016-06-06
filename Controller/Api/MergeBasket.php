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
 * Class MergeBasket.
 */
class MergeBasket extends Action
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
     * MergeBasket constructor.
     *
     * @param Context                   $context
     * @param JSON                      $json
     * @param BasketRepositoryInterface $basketRepository
     * @param RequestHandler            $helper
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
        $result = $this->_basketRepository->merge();
        $this->_jsonResult->setData($result);
        return $this->_jsonResult;
    }
}
