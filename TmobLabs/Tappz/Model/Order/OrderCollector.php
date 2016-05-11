<?php

namespace TmobLabs\Tappz\Model\Order;


use TmobLabs\Tappz\API\Data\OrderInterface;
use TmobLabs\Tappz\Model\Address\AddressRepository as AddressRepository;
use TmobLabs\Tappz\Model\Basket\BasketCollector as BasketCollector;
use TmobLabs\Tappz\Model\Product\ProductRepository as ProductRepository;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

class OrderCollector extends OrderFill implements OrderInterface
{

	protected $objectManager;
	protected $addressRepository;
	protected $basketCollector ;
	protected $productRepository;
	protected $orderCollectionFactory;
	protected $helper;
	public function __construct( AddressRepository $addressRepository , BasketCollector $basketCollector,ProductRepository $productRepository,
		RequestHandler $requestHandler,
\Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
	) {
		$this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$this->addressRepository = $addressRepository;
		$this->basketCollector = $basketCollector;
		$this->productRepository = $productRepository;
		$this->orderCollectionFactory = $orderCollectionFactory;
		$this->helper = $requestHandler;

	}
	public function getOrder(){
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
		if(count($orders) > 0 ){
			foreach($orders as $order){
			}
			$result[]=self::setOrder($order->getId());

		}
		return $result;

	}
	public function getOrderById($orderId){
		return $this->setOrder($orderId);
	}
	public function setOrder($orderId)
	{	$order = $this->objectManager->get('Magento\Sales\Model\Order');
		$order = $order->load($orderId);
		$this->setOrders((object)array());
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
		$this->setShippingTotalValue($this->getShippingTotalValueByOrder($order));
		$this->setTotalValue($this->getShippingTotalValueByOrder($order));
		$this->setCanChangeAddress($this->getCanChangeAddressByOrder($order));
		$this->setErrorCode(null);
		$this->setMessage(null);
		$this->setUserFriendly(false);
		return $this->fillOrder();

	}
	public function getOrderIdByOrder($order)
	{
		return $order->getID();
	}
	public function getTrackingNumberByOrder($order)
	{
		return !empty($order->getTrackingNumbers())?$order->getTrackingNumbers():null;
	}
	public function getOrderDateByOrder($order)
	{
		return $order->getCreatedAt();
	}
	public function getShippingStatusByOrder($order)
	{
		return $order->getStatus();
	}
	public function getPaymentStatusByOrder($order)
	{
		return  empty($order->getStatusHistories())?$order->getStatus():$order->getStatusHistories();
	}

	public function getIpAddressByOrder($order){
		return $order->getRemoteIp();
	}
	public function getLinesByOrder($order){

		$this->basketCollector->setBasket((object)array());
		foreach ($order->getAllVisibleItems() as $item) {
			$this->basketCollector->setProductId($item->getData('product_id'));
			$this->basketCollector->setProduct($this->productRepository->getById($item->getData('product_id')));
			$this->basketCollector->setQuantity($item->getData('qty'));
			$this->basketCollector->setPlacedPrice(number_format($item->getData('price'), 2));
			$this->basketCollector->setPlacedPriceTotal(number_format($item->getData('row_total'), 2));
			$this->basketCollector->setExtendedPrice(number_format($item->getData('price'), 2));
			$this->basketCollector->setExtendedPriceValue(number_format($item->getData('price'), 2));
			$this->basketCollector->setExtendedPriceTotal(number_format($item->getData('price'), 2));
			$this->basketCollector->setExtendedPriceTotalValue(number_format($item->getData('price'), 2));
			$this->basketCollector->setStatus(0);
			$this->basketCollector->setAverageDeliveryDays("");
			$this->basketCollector->setVariants(array());
			$this->basketCollector->setStrikeoutPrice(null);
			$result[] = $this->basketCollector->fillLines();
		}

		return $result ;

	}
	public function getDeliveryByOrder($order){
		 $shippingAddressId = $order->getShippingAddress()->getCustomerAddressId();
		 $billingAddressId = $order->getBillingAddress()->getCustomerAddressId();

		if ($billingAddressId) {
			$delivery['billingAddress'] = $this->addressRepository->getAddress($billingAddressId);

		}
		if ($shippingAddressId) {
			$delivery['shippingAddress'] = $this->addressRepository->getAddress($shippingAddressId);
			$method =  $order->getShippingMethod();
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
		if (!isset($delivery['shippingAddress']) || is_null($delivery['shippingAddress']['id'])) {
			$delivery = (object)array();
		}else{
			$delivery['useSameAddressForBilling'] = false;
			if($shippingAddressId == $billingAddressId)
				$delivery['useSameAddressForBilling'] = true;
		}
		return $delivery;
	}
	public function getPaymentByOrder($order){
		$paymentMethod = $order->getPayment()->getMethod();
		if(!empty($paymentMethod)){

		}

		return null;
	}
	public function getCurrencyByOrder($order){
		return ($order->getOrderCurrencyCode());
	}
	public function getItemsPriceByOrder($order){

		return ( $order->getSubtotal());
	}
	public function getDiscountByOrder($order){
		return ($order->getDiscountAmount());
	}
	public function getSubtotalByOrder($order){
		return ($order->getSubtotal());
	}
	public function getShippingTotalByOrder($order){
		return ($order->getShippingAmount());
	}
	public function getTotalByOrder($order){
		return ($order->getBaseGrandTotal());
	}

	public function getShippingTotalValueByOrder($order){
		return ($order->getShippingAmount());

	}
	public function getCanChangeAddressByOrder($order){
		return false;
	}
	public function getTaxTotalValueByOrder($order){
	return ($order->getTaxAmount());
	}


}
