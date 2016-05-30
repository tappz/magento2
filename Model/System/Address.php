<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\System;

/**
 * Class Address.
 */
class Address implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Payment\Helper\Data
     */
    private $storeHelper;

    /**
     * Address constructor.
     *
     * @param \Magento\Payment\Helper\Data $storeHelper
     */
    public function __construct(\Magento\Payment\Helper\Data $storeHelper)
    {
        $this->storeHelper = $storeHelper;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = array();
        $options[] = array('value' => ' ', 'label' => ' ');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $attributes = $objectManager->
        get('Magento\Customer\Model\Address')->getAttributes();
        foreach ($attributes as $attribute) {
            if ($attribute->getIsVisible()) {
                $options[] = array(
                    'value' => $attribute->getAttributeCode(),
                    'label' => $attribute->getFrontendLabel(),
                );
            }
        }

        return $options;
    }
}
