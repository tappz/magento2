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
use TmobLabs\Tappz\API\ProductRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class Product.
 */
class Product extends Action
{
    /**
     * @var
     */
    private $_jsonResult;
    /**
     * @var ProductRepositoryInterface
     */
    private $_productRepository;

    /**
     * Product constructor.
     *
     * @param Context $context
     * @param JSON $json
     * @param ProductRepositoryInterface $productRepository
     * @param RequestHandler $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        ProductRepositoryInterface $productRepository,
        RequestHandler $helper
    ) {
        parent::__construct($context);
        $this->_jsonResult = $json->create();
        $this->_productRepository = $productRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $params = ($this->getRequest()->getParams());
        $result = [];
        if (count($params) > 0 && $params[key($params)] == 'related') {
            $productId = key($params);
            $result = $this->_productRepository->getRelatedProduct($productId);
        } else {
            if (count($params) > 0 && !isset($params['barcode'])) {
                $productId = key($params);

                $result = $this->_productRepository->getById($productId);
            } elseif (isset($params['barcode']) && !empty($params['barcode'])) {
                $barcode = $params['barcode'];
                $result = $this->_productRepository->getByBarcode($barcode);
            }
        }
        $this->_jsonResult->setData($result);
        return $this->_jsonResult;
    }
}
