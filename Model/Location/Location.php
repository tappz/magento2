<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Location;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\LocationInterface;

/**
 * Class Location.
 */
class Location extends AbstractExtensibleObject implements LocationInterface
{
    /**
     * @var
     */
    protected $_location;

    /**
     */
    public function getErrorCode()
    {

        $result = isset($this->_location->errorCode) ?
            $this->_location->errorCode : null;
        return $result;
    }

    /**
     */
    public function getMessage()
    {

        $result = isset($this->_location->message) ?
            $this->_location->message : null;
        return $result;
    }

    /**
     * @return bool
     */
    public function getUserFriendly()
    {

        $result = isset($this->_location->userFriendly) ?
            $this->_location->userFriendly : false;
        return $result;
    }

    /**
     * @return $this
     */
    public function setErrorCode()
    {
        $this->_location->errorCode;

        return $this;
    }

    /**
     * @param $setMessage
     *
     * @return $this
     */
    public function setMessage($setMessage)
    {
        $this->_location->message = $setMessage;

        return $this;
    }

    /**
     * @param $userFriendly
     *
     * @return $this
     */
    public function setUserFriendly($userFriendly)
    {
        $this->_location->userFriendly = $userFriendly;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->_location->code;
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->_location->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_location->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->_location->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodeAndName()
    {
        return $this->_location->codeAndName;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setCodeAndName($name)
    {
        $this->_location->codeAndName = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultName()
    {
        return $this->_location->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setDefaultName($name)
    {
        $this->_location->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultCode()
    {
        return $this->_location->code;
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setDefaultCode($code)
    {
        $this->_location->code = $code;

        return $this;
    }
}
