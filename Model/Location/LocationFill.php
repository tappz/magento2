<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Location;

/**
 * Class LocationFill.
 */
class LocationFill extends Location
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    public $storeManager;

    /**
     * LocationFill constructor.
     *
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * @return array
     */
    public function fillCountries()
    {
        return [
            'countries' => $this->getCodeAndName(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    /**
     * @return array
     */
    public function fillStates()
    {
        return [
            'states' => $this->getCodeAndName(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    /**
     * @return array
     */
    public function fillCities()
    {
        return [
            'cities' => $this->getCodeAndName(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    /**
     * @return array
     */
    public function fillDistricts()
    {
        return [
            'code' => $this->getDefaultCode(),
            'name' => $this->getDefaultName(),
            'districts' => $this->getCodeAndName(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    /**
     * @return array
     */
    public function fillTowns()
    {
        return [
            'code' => $this->getDefaultCode(),
            'name' => $this->getDefaultName(),
            'towns' => $this->getCodeAndName(),
            'ErrorCode' => $this->getErrorCode(),
            'Message' => $this->getMessage(),
            'UserFriendly' => $this->getUserFriendly(),
        ];
    }

    /**
     * @return array
     */
    public function fillCodeAndName()
    {
        return [
            'code' => $this->getCode(),
            'name' => $this->getName(),
        ];
    }
}
