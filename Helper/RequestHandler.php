<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class RequestHandler.
 */
class RequestHandler extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * RequestHandler constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @param $url
     *
     * @return string
     */
    public function getRealUrl($url)
    {
        return urldecode($url."$_SERVER[REQUEST_URI]");
    }

    /**
     * @return array
     */
    public function checkAuth()
    {
        $header = (isset($_SERVER['HTTP_AUTHORIZATION']) && $_SERVER['HTTP_AUTHORIZATION'] != '') ? $_SERVER['HTTP_AUTHORIZATION'] : '';
        $auth = (explode(' ', $header));

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $url = substr($objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore()
        ->getBaseUrl(), 0, -1);
        $realUrl = $this->getRealUrl($url);

        $username = $this->scopeConfig->getValue('tappztoken/tappzusermethod/tappzusername');
        $token = $this->scopeConfig->getValue('tappztoken/tappzusermethod/tappzsecretkey');
        if (sizeof($token) == 0) {
            exit(' 401 - Token not initialized.Please create  token on configuration page ');
        } elseif (sha1((trim($token.'|'.($realUrl).'|'.$auth[2])), false) != $auth[1] ||  $username != $auth[0]) {
            exit(' 403 - Access denied.Please check your tokens');
        }

        return $auth;
    }

    /**
     * @return array|string
     */
    public function getHeaderJson()
    {
        $resource = fopen('php://input', 'r');
        $result = array();
        while ($putData = fread($resource, 8192)) {
            $result = $putData;
        }
        fclose($resource);

        return $result;
    }

    /**
     * @return string
     */
    public function getAuthorizationFull()
    {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
        $header = (isset($authorization) && $authorization != '') ? $authorization : '';

        return $header;
    }

    /**
     * @return mixed
     */
    public function getAuthorization()
    {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
        $header = (isset($authorization) && $authorization != '') ? $authorization : '';
        $auth = end(explode(' ', $header));

        return $auth;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function convertJson($data)
    {
        return json_decode($data);
    }

    /**
     * @param $array
     * @param $oldKey
     * @param $newKey
     *
     * @return array
     */
    public function changeKey($array, $oldKey, $newKey)
    {
        if (!array_key_exists($oldKey, $array)) {
            return $array;
        }
        $keys = array_keys($array);
        $keys[array_search($oldKey, $keys)] = $newKey;

        return array_combine($keys, $array);
    }
}
