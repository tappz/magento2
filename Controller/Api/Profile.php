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
 * Class Profile.
 */
class Profile extends Action
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
     * @var RequestHandler
     */
    private $_helper;

    /**
     * Profile constructor.
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
        $this->_helper = $helper;
        $this->_profileRepository = $profileRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $method = $this->_helper->getRequestMethod();
        $result = [];
        switch ($method) {
            case 'GET':
                $result = $this->_profileRepository->getProfile();
                break;
            case 'POST':
                $result = $this->_profileRepository->createProfile();
                break;
            case 'PUT':
                $result = $this->_profileRepository->editProfile();
                break;
            default:
                break;
        }
        $this->_jsonResult->setData($result);

        return $this->_jsonResult;
    }
}
