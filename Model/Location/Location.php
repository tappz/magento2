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
    protected $location;

    /**
     */
    public function getErrorCode()
    {
        $errorCode = $this->location->errorCode;
        $result = isset($errorCode) ? $errorCode : null;
        return $result;
    }

    /**
     */
    public function getMessage()
    {
        $message = $this->location->message;
        $result = isset($message) ? $message : null;
        return $result;
    }

    /**
     * @return bool
     */
    public function getUserFriendly()
    {
        $userFriendly = $this->location->userFriendly;
        return isset($userFriendly) ? $userFriendly : false;
    }

    /**
     * @return $this
     */
    public function setErrorCode()
    {
        $this->location->errorCode;

        return $this;
    }

    /**
     * @param $setMessage
     *
     * @return $this
     */
    public function setMessage($setMessage)
    {
        $this->location->message = $setMessage;

        return $this;
    }

    /**
     * @param $userFriendly
     *
     * @return $this
     */
    public function setUserFriendly($userFriendly)
    {
        $this->location->userFriendly = $userFriendly;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->location->code;
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->location->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->location->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->location->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodeAndName()
    {
        return $this->location->codeAndName;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setCodeAndName($name)
    {
        $this->location->codeAndName = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultName()
    {
        return $this->location->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setDefaultName($name)
    {
        $this->location->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultCode()
    {
        return $this->location->code;
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setDefaultCode($code)
    {
        $this->location->code = $code;

        return $this;
    }
}
