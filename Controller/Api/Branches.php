<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;

/**
 * Class Branches.
 */
class Branches extends Action
{
    /**
     * @var
     */
    private $_jsonResult;

    /**
     * Branches constructor.
     *
     * @param Context $context
     * @param JSON $json
     */
    public function __construct(
        Context $context,
        JSON $json
    ) {
        parent::__construct($context);
        $this->_jsonResult = $json->create();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $this->_jsonResult->setData([]);
        return $this->_jsonResult;
    }
}
