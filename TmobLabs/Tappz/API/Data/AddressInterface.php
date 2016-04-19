<?php

namespace TmobLabs\Tappz\API\Data;
 
use Magento\Framework\Api\CustomAttributesDataInterface;

interface AddressInterface extends CustomAttributesDataInterface
{
      /**
      * @return string
     */
    public function getId();
    /**
     * @return string
     */
    public function getAddressName();
      /**
     * @return string
     */
    public function getName();
      /**
     * @return string
     */
    public function getSurname();
      /**
     * @return string
     */
    public function getEmail();
      /**
     * @return string
     */
    public function getAddressLine();
      /**
     * @return string
     */
    public function getCountry();
          /**
     * @return string
     */
    public function getCountryCode();

          /**
     * @return string
     */
    public function getState();
          /**
     * @return string
     */
    public function getStateCode();
     /**
     * @return string
     */
    public function getCity();
      /**
     * @return string
     */
    public function getDistrict();
         /**
     * @return string
     */
    public function getDistrictCode();
           /**
     * @return string
     */
    public function getTown();
               /**
     * @return string
     */
    public function getTownCode();
     /**
     * @return string
     */
    public function getCorporate();
         /**
     * @return string
     */
    public function getCompanyTitle();
             /**
     * @return string
     */
    public function getTaxNo();
                 /**
     * @return string
     */
    public function getTaxDepartment();
                 /**
     * @return string
     */
    public function getPhoneNumber();
                 /**
     * @return string
     */
    public function getIdentityNo();
                 /**
     * @return string
     */
    public function getZipCode();
                 /**
     * @return string
     */
    public function getUsCheckoutCity();
                       /**
     * @return string
     */
    public function getErrorCode();
               /**
     * @return string
     */
    public function getMessage();
               /**
     * @return string
     */
    public function getUserFriendly();
}