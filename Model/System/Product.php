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
        /** @var Mage_Catalog_Model_Product $product */
        $product = Mage::getModel('catalog/product');
        $attributes = $product->getAttributes();

        /** @var Mage_Catalog_Model_Resource_Eav_Attribute $attribute */
        foreach ($attributes as $attribute) {
            foreach ($attribute->getEntityType()->getAttributeCodes() as $code) {
                /** @var Mage_Eav_Model_Entity_Attribute $attributeModel */
                $attributeModel = Mage::getModel('eav/entity_attribute')->loadByCode($attribute->getEntityType(),
                    $code);
                $options[] = array('value' => $code, 'label' => $attributeModel->getFrontendLabel());
            }
            break;
        }

        return $options;
    }
}
