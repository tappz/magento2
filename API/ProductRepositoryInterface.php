<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API;

/**
 * Interface ProductRepositoryInterface.
 */
interface ProductRepositoryInterface
{
    /**
     * @param $productId
     *
     * @return mixed
     */
    public function getById($productId);

    /**
     * @param $productId
     *
     * @return mixed
     */
    public function getByBarcode($productId);

    /**
     * @param $params
     *
     * @return mixed
     */
    public function getProductSearch($params);

    /**
     * @param $productId
     *
     * @return mixed
     */
    public function getRelatedProduct($productId);
}
