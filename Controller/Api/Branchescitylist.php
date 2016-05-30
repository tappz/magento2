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
    protected $jsonResult;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * Branchescitylist constructor.
     *
     * @param Context                     $context
     * @param JSON                        $json
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        Context $context,
        JSON $json,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $arr = array(
            0 => array(
                    'cityId' => 0,
                    'name' => 'string',
                    'latitude' => 'string',
                    'longitude' => 'string',
                    'ErrorCode' => 'string',
                    'Message' => 'string',
                    'UserFriendly' => true,
                ),
        );
        $this->jsonResult->setData($arr);

        return $this->jsonResult;
    }
}
