<?php
namespace TmobLabs\Tappz\API\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;
interface IndexInterface extends CustomAttributesDataInterface{
    /**
     *  Return array 
     */
    public function getGroups();
    /**
     * 
     * Return array 
     */
    public function getAds();
    /**
     * 
     * Return string  
     */
    public function getErrorCode();
    /**
     *  Return string 
     */
    public function getMessage();
    /**
     * 
     * Return string 
     */
    public function getUserFriendly();
}