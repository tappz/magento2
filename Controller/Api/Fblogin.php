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
use TmobLabs\Tappz\API\ProfileRepositoryInterface;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class Fblogin.
 */
class Fblogin extends Action
{
    /**
     * @var
     */
    private $_jsonResult;
    /**
     * @var ProfileRepositoryInterface
     */
    private $_profileRepository;

    /**
     * Fblogin constructor.
     *
     * @param Context $context
     * @param JSON $json
     * @param ProfileRepositoryInterface $profileRepository
     * @param RequestHandler $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        ProfileRepositoryInterface $profileRepository,
        RequestHandler $helper
    ) {
        parent::__construct($context);
        $this->_jsonResult = $json->create();
        $this->_profileRepository = $profileRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $result = $this->_profileRepository->fblogin();
        $this->_jsonResult->setData($result);
        return $this->_jsonResult;
    }
}
