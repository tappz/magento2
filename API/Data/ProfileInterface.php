<?php

namespace TmobLabs\Tappz\API\Data;

/**
 * Interface ProfileInterface.
 */
interface ProfileInterface
{
    /**
     * @return string
     */
    public function getFullName();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @return string
     */
    public function getGender();

    /**
     * @return string
     */
    public function getIsSubscribe();

    /**
     * @return string
     */
    public function getIsSMSSubscribe();

    /**
     * @return string
     */
    public function getbirthDate();

    /**
     * @return string
     */
    public function getAccept();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return string
     */
    public function getAddresses();

    /**
     * @return string
     */
    public function getPoints();

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
