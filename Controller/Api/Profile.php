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
    protected $jsonResult;
    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;
    /**
     * @var RequestHandler
     */
    protected $helper;

    /**
     * Profile constructor.
     *
     * @param Context                    $context
     * @param JSON                       $json
     * @param ProfileRepositoryInterface $profileRepository
     * @param RequestHandler             $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        ProfileRepositoryInterface $profileRepository,
        RequestHandler $helper
    ) {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->helper = $helper;
        $this->profileRepository = $profileRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $method = $this->helper->getRequestMethod();
        $result = array();
        switch ($method) {
            case 'GET':
                $result = $this->profileRepository->getProfile();
                break;
            case 'POST':
                $result = $this->profileRepository->createProfile();
                break;
            case 'PUT':
                $result = $this->profileRepository->editProfile();
                break;
            default:
                break;
        }
        $this->jsonResult->setData($result);

        return $this->jsonResult;
    }
}
