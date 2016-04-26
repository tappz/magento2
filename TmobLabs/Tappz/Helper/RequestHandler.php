<?php

namespace TmobLabs\Tappz\Helper;

class RequestHandler extends \Magento\Framework\App\Helper\AbstractHelper {

    public function getRequestMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function checkToken($token) {
        $header = (isset($_SERVER['HTTP_AUTHORIZATION']) && $_SERVER['HTTP_AUTHORIZATION'] != '') ? $_SERVER['HTTP_AUTHORIZATION'] : '';
        $auth = (@explode(' ', $header));
        $url = urldecode($this->getUrl($_SERVER));
        if (sizeof($token) == 0) {
            exit(' 401 - Token not initialized.Please create  token on configuration page ');
        } elseif (sha1(utf8_encode(trim($token . '|' . ($url) . '|' . @$auth[2])), false) != @$auth[1]) {
            exit(' 403 - Access denied.Please check your tokens');
        }
        return $auth;
    }

    public function getHeaderJson() {
        $resource = fopen('php://input', 'r');
        while ($putData = fread($resource, 8192)) {
            $result = $putData;
        }
        fclose($resource);
        return $result;
    }

    public function getAuthorizationFull() {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
        $header = (isset($authorization) && $authorization != '') ? $authorization : '';

        return $header;
    }

    public function getAuthorization() {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
        $header = (isset($authorization) && $authorization != '') ? $authorization : '';
        $auth = @end(@explode(' ', $header));
        return $auth;
    }

    public function convertJson($data) {

        return json_decode($data);
    }

    public function changeKey($array, $oldKey, $newKey) {
        if (!array_key_exists($oldKey, $array))
            return $array;
        $keys = array_keys($array);
        $keys[array_search($oldKey, $keys)] = $newKey;

        return array_combine($keys, $array);
    }

}
