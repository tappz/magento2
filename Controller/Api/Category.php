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
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;

/**
 * Class Category.
 */
class Category extends Action
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
     * Category constructor.
     *
     * @param Context                     $context
     * @param JSON                        $json
     * @param CategoryRepositoryInterface $categoryRepository
     * @param RequestHandler              $helper
     */
    public function __construct(
        Context $context,
        JSON $json,
        CategoryRepositoryInterface $categoryRepository,
        RequestHandler $helper)
    {
        parent::__construct($context);
        $this->jsonResult = $json->create();
        $this->categoryRepository = $categoryRepository;
        $helper->checkAuth();
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $params = ($this->getRequest()->getParams());
        $categoryId = key($params);
        $result = $this->categoryRepository->getByCategoryById($categoryId);
        $this->jsonResult->setData($result);

        return $this->jsonResult;
    }
}
