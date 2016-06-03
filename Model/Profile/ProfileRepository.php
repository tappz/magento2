<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Profile;

use TmobLabs\Tappz\API\ProfileRepositoryInterface;

/**
 * Class ProfileRepository.
 */
class ProfileRepository implements ProfileRepositoryInterface
{
    /**
     * @var ProfileCollector
     */
    private $_profileCollector;

    /**
     * ProfileRepository constructor.
     *
     * @param ProfileCollector $profileCollector
     */
    public function __construct(
        ProfileCollector $profileCollector
    ) {
        $this->_profileCollector = $profileCollector;
    }

    /**
     * @return array
     */
    public function getUserAgreement()
    {
        $result = $this->_profileCollector->userAgreement();

        return $result;
    }

    /**
     * @return array
     */
    public function login()
    {
        $result = $this->_profileCollector->login();

        return $result;
    }

    /**
     * @return array
     */
    public function fblogin()
    {
        $result = $this->_profileCollector->fblogin();

        return $result;
    }

    /**
     * @return array
     */
    public function getProfile()
    {
        $result = $this->_profileCollector->getProfile();

        return $result;
    }

    /**
     * @return array
     */
    public function createProfile()
    {
        $result = $this->_profileCollector->createProfile();

        return $result;
    }

    /**
     * @return array
     */
    public function editProfile()
    {
        $result = $this->_profileCollector->editProfile();

        return $result;
    }
}
