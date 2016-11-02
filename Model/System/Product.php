<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\System;

/**
 * Class Product.
 */
class Product implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Payment\Helper\Data
     */
    private $storeHelper;

    /**
     * Product constructor.
     *
     * @param \Magento\Payment\Helper\Data $storeHelper
     */
    public function __construct(
        \Magento\Payment\Helper\Data $storeHelper
    ) {
        $this->storeHelper = $storeHelper;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['value' => ' ', 'label' => ' '];
        $product = Mage::getModel('catalog/product');
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            $codes = $attribute->getEntityType()->getAttributeCodes();
            foreach ($codes as $code) {
                $attributeModel = Mage::getModel('eav/entity_attribute')->
                loadByCode(
                    $attribute->getEntityType(),
                    $code
                );
                $options[] = ['value' => $code, 'label' =>
                    $attributeModel->getFrontendLabel()];
            }
            break;
        }

        return $options;
    }
}
