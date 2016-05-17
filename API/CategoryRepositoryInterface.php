<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\API;

/**
 * Interface CategoryRepositoryInterface.
 */
interface CategoryRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getCategories();

    /**
     * @param $productId
     *
     * @return mixed
     */
    public function getByCategoryById($productId);
}
