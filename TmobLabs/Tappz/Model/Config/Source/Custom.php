<?php

//Location: magento2_root/app/code/Vendorname/Extensionname/Model/Config/Source/Custom.php
namespace TmobLabs\Tappz\Model\Config\Source;

class Custom implements \Magento\Framework\Option\ArrayInterface
{
	/**
	 * @return array
	 */
	public function toOptionArray()
	{

		return [
			['value' => 0, 'label' => __('Zero')],
			['value' => 1, 'label' => __('One')],
			['value' => 2, 'label' => __('Two')],
		];
	}
}