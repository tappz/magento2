<?php

namespace TmobLabs\Tappz\Model\Order;

use Magento\Framework\Api\AbstractExtensibleObject;
use TmobLabs\Tappz\API\Data\OrderInterface;

class Order extends AbstractExtensibleObject implements OrderInterface {

    protected $location ;
   
    public function getErrorCode() {
        return isset($this->location->errorCode) ? $this->location->errorCode : null;
    }

    public function getMessage() {
        return isset($this->location->message) ? $this->location->message : null;
    }

    public function getUserFriendly() {

        return isset($this->location->userFriendly) ? $this->location->userFriendly : false;
    }

    public function setErrorCode() {
        $this->location->errorCode;
        return $this;
    }

    public function setMessage($setMessage) {
        $this->location->message = $setMessage;
        return $this;
    }

    public function setUserFriendly($userFriendly) {
        $this->location->userFriendly = $userFriendly;
        return $this;
    }

    public function getCode() {
        return $this->location->code;
    }

    public function setCode($code) {
         
        $this->location->code = $code;
        return $this;
    }

    public function getName() {
        return $this->location->name;
    }

    public function setName($name) {
        $this->location->name = $name;
        return $this;
    }
      public function getCodeAndName() {
        return $this->location->codeAndName;
    }

    public function setCodeAndName($name) {
        $this->location->codeAndName = $name;
        return $this;
    }
    
    public function getDefaultName() {
        return $this->location->name;
    }

    public function setDefaultName($name) {
        $this->location->name = $name;
        return $this;
    }
   
    public function getDefaultCode() {
        return $this->location->code;
    }

    public function setDefaultCode($code) {
         
        $this->location->code = $code;
        return $this;
    }
}
