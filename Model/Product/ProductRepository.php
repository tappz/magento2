<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Product;

use TmobLabs\Tappz\API\ProductRepositoryInterface;

/**
 * Class ProductRepository.
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var ProductCollector
     */
    private $_productCollector;

    /**
     * @param ProductCollector $productCollector
     */
    public function __construct(
        ProductCollector $productCollector
    ) {
        $this->_productCollector = $productCollector;
    }

    /**
     * @param $productId
     *
     * @return array|string
     */
    public function getById($productId)
    {
        $result = $this->_productCollector->getProduct($productId);

        return $result;
    }

    /**
     * @param $productId
     *
     * @return array
     */
    public function getRelatedProduct($productId)
    {
        $result = $this->_productCollector->getRelatedProduct($productId);

        return $result;
    }

    /**
     * @param $barcode
     *
     * @return array
     */
    public function getByBarcode($barcode)
    {
        $result = $this->_productCollector->getProductBySku($barcode);

        return $result;
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function getProductSearch($params)
    {
        $result = $this->_productCollector->getProductSearch($params);

        return $result;
    }
}
