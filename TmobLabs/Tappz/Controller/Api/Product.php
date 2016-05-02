<?php

namespace TmobLabs\Tappz\Controller\Api;
use Magento\Framework\App\Action\Action ;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\Controller\Result\JsonFactory as JSON;
use TmobLabs\Tappz\API\ProductRepositoryInterface  ;


class Product extends Action
{
    protected $jsonResult;
    private $productRepository;
    public function __construct(Context $context,  JSON $json,ProductRepositoryInterface $productRepository   )
    {
      parent::__construct($context);
      $this->jsonResult= $json->create();
      $this->productRepository= $productRepository;
    }
    public function execute()
    {
        $params =  ($this->getRequest()->getParams());
        $result = array();
        if(count($params) > 0 && $params[key($params)] == "related" ){
               $productId = key($params);
               $result = $this->productRepository->getRelatedProduct($productId);

        }
        else if(count($params) > 0 && !isset($params['barcode']) ){
            $productId = key($params);
            
            $result = $this->productRepository->getById($productId);
               
        }elseif(isset ($params['barcode']) && !empty ($params['barcode']) ){
            $barcode=$params['barcode'];
            $result = $this->productRepository->getByBarcode($barcode);
        }        
        $this->jsonResult->setData($result);
        return $this->jsonResult;
    }    
}