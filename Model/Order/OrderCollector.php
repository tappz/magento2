<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Order;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as Collection;
use TmobLabs\Tappz\API\Data\OrderInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Address\AddressRepository as AddressRepository;
use TmobLabs\Tappz\Model\Basket\BasketCollector as BasketCollector;
use TmobLabs\Tappz\Model\Product\ProductRepository as ProductRepository;

/**
 * Class OrderCollector.
 */
class OrderCollector extends OrderFill implements OrderInterface
{
    /**
     * @var
     */
    public $objectManager;
    /**
     * @var AddressRepository
     */
    public $addressRepository;
    /**
     * @var BasketCollector
     */
    public $basketCollector;
    /**
     * @var ProductRepository
     */
    public $productRepository;
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    public $orderCollectionFactory;
    /**
     * @var RequestHandler
     */
    public $helper;

    public function __construct(
        AddressRepository $addressRepository,
        BasketCollector $basketCollector,
        ProductRepository $productRepository,
        RequestHandler $requestHandler,
        Collection $orderCollectionFactory
    ) {
        $this->objectManager =
            \Magento\Framework\App\ObjectManager::getInstance();
        $this->addressRepository = $addressRepository;
        $this->basketCollector = $basketCollector;
        $this->productRepository = $productRepository;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->helper = $requestHandler;
    }

    /**
     * @return array
     */
    public function getOrder()
    {
        $result=[];
        $userId = $this->helper->getAuthorization();
       
        $orders = $this->orderCollectionFactory->create()->addFieldToSelect(
            '*'
        )->addFieldToFilter(
            'customer_id',
            $userId
        )->setOrder(
            'created_at',
            'desc'
        );
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $result[] = self::setOrder($order->getId());
            }
        }
        return $result;
    }

    /**
     * @param $orderId
     *
     * @return array
     */
    public function setOrder($orderId)
    {
        $order = $this->objectManager->get('Magento\Sales\Model\Order');
        $order = $order->load($orderId);
        $this->setOrders((object)[]);
        $this->setOrderId($this->getOrderIdByOrder($order));
        $this->setTrackingNumber($this->getTrackingNumberByOrder($order));
        $this->setOrderDate($this->getOrderDateByOrder($order));
        $this->setShippingStatus($this->getShippingStatusByOrder($order));
        $this->setPaymentStatus($this->getPaymentStatusByOrder($order));
        $this->setIpAddress($this->getIpAddressByOrder($order));
        $this->setLines($this->getLinesByOrder($order));
        $this->setDelivery($this->getDeliveryByOrder($order));
        $this->setPayment($this->getPaymentByOrder($order));
        $this->setCurrency($this->getCurrencyByOrder($order));
        $this->setItemsPriceTotal($this->getItemsPriceByOrder($order));
        $this->setDiscountTotal($this->getDiscountByOrder($order));
        $this->setSubTotal($this->getSubtotalByOrder($order));
        $this->setShippingTotal($this->getShippingTotalByOrder($order));
        $this->setTotal($this->getTotalByOrder($order));
        $this->setTaxTotalValue($this->getTaxTotalValueByOrder($order));
        $this->setShippingTotalValue(
            $this->getShippingTotalValueByOrder($order)
        );
        $this->setTotalValue($this->getShippingTotalValueByOrder($order));
        $this->setCanChangeAddress($this->getCanChangeAddressByOrder($order));
        $this->setErrorCode(null);
        $this->setMessage(null);
        $this->setUserFriendly(false);

        return $this->fillOrder();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getOrderIdByOrder($order)
    {
        return $order->getID();
    }

    /**
     * @param $order
     */
    public function getTrackingNumberByOrder($order)
    {
        $trackNumber = $order->getTrackingNumbers();
        $result = !empty($trackNumber) ? ($trackNumber) : null;
        return $result;
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getOrderDateByOrder($order)
    {
        return $order->getCreatedAt();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getShippingStatusByOrder($order)
    {
        return $order->getStatus();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getPaymentStatusByOrder($order)
    {
        $statusHistories = $order->getStatusHistories();
        $getStatus = $order->getStatus();
        return empty($statusHistories) ? $getStatus : $statusHistories;
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getIpAddressByOrder($order)
    {
        return $order->getRemoteIp();
    }

    /**
     * @param $order
     *
     * @return array
     */
    public function getLinesByOrder($order)
    {
        $result = [];
        $this->basketCollector->setBasket((object)[]);
        foreach ($order->getAllVisibleItems() as $item) {
            $this->basketCollector->setProductId(
                $item->getData('product_id')
            );
            $this->basketCollector->setProduct(
                $this->productRepository->getById(
                    $item->getData('product_id')
                )
            );
            $this->basketCollector->setQuantity(
                $item->getData('qty')
            );
            $this->basketCollector->setPlacedPrice(
                number_format($item->getData('price'), 2)
            );
            $this->basketCollector->setPlacedPriceTotal(
                number_format($item->getData('row_total'), 2)
            );
            $this->basketCollector->setExtendedPrice(
                number_format($item->getData('price'), 2)
            );
            $this->basketCollector->setExtendedPriceValue(
                number_format($item->getData('price'), 2)
            );
            $this->basketCollector->setExtendedPriceTotal(
                number_format($item->getData('price'), 2)
            );
            $this->basketCollector->setExtendedPriceTotalValue(
                number_format($item->getData('price'), 2)
            );
            $this->basketCollector->setStatus(0);
            $this->basketCollector->setAverageDeliveryDays('');
            $this->basketCollector->setVariants([]);
            $this->basketCollector->setStrikeoutPrice(null);
            $result[] = $this->basketCollector->fillLines();
        }

        return $result;
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getDeliveryByOrder($order)
    {
        $shippingAddressId =
            $order->getShippingAddress()->getCustomerAddressId();
        $billingAddressId =
            $order->getBillingAddress()->getCustomerAddressId();

        if ($billingAddressId) {
            $delivery['billingAddress'] =
                $this->addressRepository->getAddress($billingAddressId);
        }
        if ($shippingAddressId) {
            $delivery['shippingAddress'] =
                $this->addressRepository->getAddress($shippingAddressId);
            $method = $order->getShippingMethod();
            if (!empty($method)) {
                $delivery['shippingMethod'][0]['id'] = $method;
                $delivery['shippingMethod'][0]['displayName'] = $method;
                $delivery['shippingMethod'][0]['trackingAddress'] = null;
                $delivery['shippingMethod'][0]['price'] = 0;
                $delivery['shippingMethod'][0]['priceForYou'] = null;
                $delivery['shippingMethod'][0]['shippingMethodType'] = $method;
                $delivery['shippingMethod'][0]['imageUrl'] = null;
            }
        }
        if (!isset($delivery['shippingAddress']) ||
            empty($delivery['shippingAddress']['id'])
        ) {
            $delivery = (object)[];
        } else {
            $delivery['useSameAddressForBilling'] = false;
            if ($shippingAddressId == $billingAddressId) {
                $delivery['useSameAddressForBilling'] = true;
            }
        }

        return $delivery;
    }

    /**
     * @param $order
     */
    public function getPaymentByOrder($order)
    {
        $paymentMethod = $order->getPayment()->getMethod();
        if (!empty($paymentMethod)) {
            $result = '';
        }

        return $result;
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getCurrencyByOrder($order)
    {
        return $order->getOrderCurrencyCode();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getItemsPriceByOrder($order)
    {
        return $order->getSubtotal();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getDiscountByOrder($order)
    {
        return $order->getDiscountAmount();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getSubtotalByOrder($order)
    {
        return $order->getSubtotal();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getShippingTotalByOrder($order)
    {
        return $order->getShippingAmount();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getTotalByOrder($order)
    {
        return $order->getBaseGrandTotal();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getTaxTotalValueByOrder($order)
    {
        return $order->getTaxAmount();
    }

    /**
     * @param $order
     *
     * @return mixed
     */
    public function getShippingTotalValueByOrder($order)
    {
        return $order->getShippingAmount();
    }

    /**
     * @param $order
     *
     * @return bool
     */
    public function getCanChangeAddressByOrder($order)
    {
        return false;
    }

    /**
     * @param $orderId
     *
     * @return array
     */
    public function getOrderById($orderId)
    {
        return $this->setOrder($orderId);
    }
}
