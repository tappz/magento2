<?php
namespace  TmobLabs\Tappz\Model\System;

class Address implements \Magento\Framework\Option\ArrayInterface {

	private $storeHelper;
	public function __construct(\Magento\Payment\Helper\Data $storeHelper)
	{
		$this->storeHelper = $storeHelper;
	}
	public function toOptionArray()
	{
		$options = array();
		$options[] = array('value' => ' ', 'label' => ' ');
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$attributes = $objectManager->get('Magento\Customer\Model\Address')->getAttributes();
		foreach ($attributes as $attribute) {
			if($attribute->getIsVisible()) {
				$options[] = array('value' => $attribute->getAttributeCode(), 'label' => $attribute->getFrontendLabel());
			}
		}

		return $options;
	}
}