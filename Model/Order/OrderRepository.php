<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Order;

use TmobLabs\Tappz\API\OrderRepositoryInterface;

/**
 * Class OrderRepository.
 */
class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var
     */
    private $_orderCollector;

    /**
     * OrderRepository constructor.
     *
     * @param OrderCollector $orderCollector
     */
    public function __construct(
        OrderCollector $orderCollector
    ) {
        $this->_orderCollector = $orderCollector;
    }

    /**
     * @param $orderId
     *
     * @return array
     */
    public function getOrderById($orderId)
    {
        $result = $this->_orderCollector->getOrderById($orderId);

        return $result;
    }

    /**
     * @return array
     */
    public function getOrder()
    {
        $result = $this->_orderCollector->getOrder();

        return $result;
    }
}
