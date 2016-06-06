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
use TmobLabs\Tappz\API\CategoryRepositoryInterface;

/**
 * Class Branchescitylist.
 */
class Branchescitylist extends Action
{
    /**
     * @var
     */
    private $_jsonResult;


    /**
     * Branchescitylist constructor.
     *
     * @param Context $context
     * @param JSON $json
     * @param CategoryRepositoryInterface $categoryRepository
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
        $arr = [
            0 => [
                'cityId' => 0,
                'name' => 'string',
                'latitude' => 'string',
                'longitude' => 'string',
                'ErrorCode' => 'string',
                'Message' => 'string',
                'UserFriendly' => true,
            ],
        ];
        $this->_jsonResult->setData($arr);

        return $this->_jsonResult;
    }
}
