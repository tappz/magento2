<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\System;

/**
 * Class Payment.
 */
class Payment implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Payment\Helper\Data
     */
    private $storeHelper;

    /**
     * Payment constructor.
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
        $options = [];
        $collection = $this->storeHelper->getStoreMethods();
        foreach ($collection as $method) {
            array_push(
                $options,
                [
                    'value' => $method->getCode(),
                    'label' => $method->getTitle(),
                ]
            );
        }

        return $options;
    }
}
