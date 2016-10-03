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
 * Class UserAgreement.
 */
class UserAgreement extends Action
{
    /**
     * @var
     */
    private $jsonResult;
    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;

    /**
     * UserAgreement constructor.
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
        $this->jsonResult = $json->create();
        $this->profileRepository = $profileRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $result = $this->profileRepository->getUserAgreement();
        $this->jsonResult->setData($result);
        return $this->jsonResult;
    }
}
