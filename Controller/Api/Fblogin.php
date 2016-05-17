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
    protected $jsonResult;
    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;

    /**
     * Fblogin constructor.
     *
     * @param Context                    $context
     * @param JSON                       $json
     * @param ProfileRepositoryInterface $profileRepository
     * @param RequestHandler             $helper
     */
    public function __construct(Context $context, JSON $json, ProfileRepositoryInterface $profileRepository, RequestHandler $helper)
    {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $helper->checkAuth();
        $this->profileRepository = $profileRepository;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $result = $this->profileRepository->fblogin();
        $this->jsonResult->setData($result);

        return $this->jsonResult;
    }
}
