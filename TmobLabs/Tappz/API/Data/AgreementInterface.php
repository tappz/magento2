<?php
namespace TmobLabs\Tappz\API\Data;
use Magento\Framework\Api\CustomAttributesDataInterface;
interface AgreementInterface extends CustomAttributesDataInterface
{
    /**
     * @return string
     */
    public function getAgreementText();
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