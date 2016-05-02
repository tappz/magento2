<?php
namespace  TmobLabs\Tappz\Model\System;

class Payment implements \Magento\Framework\Option\ArrayInterface {

	private $storeHelper;
	public function __construct(\Magento\Payment\Helper\Data $storeHelper)
	{
		$this->storeHelper = $storeHelper;
	}
	public function toOptionArray()
	{
		$options = array();
		$collection =$this->storeHelper->getStoreMethods();
		foreach ($collection as $method) {
			array_push(
				$options,
				array(
					'value' => $method->getCode(),
					'label' => $method->getTitle()
				)
			);
		}
		return $options;
	}
}