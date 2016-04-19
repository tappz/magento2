<?php
namespace TmobLabs\Tappz\API;



interface CategoryRepositoryInterface 
{
    
      public function getCategories();
      
      public function getByCategoryById($productId);
      
}
