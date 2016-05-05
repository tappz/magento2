<?php

namespace TmobLabs\Tappz\API\Data;

interface CategoryInterface
{
    /**
     * @return string
     */
    public function getId();
    /**
     * @return string
     */
    public function getName();
    /**
     * @return string
     */
    public function getIsRoot();
    /**
     * @return string
     */
    public function getIsLeaf();
        /**
     * @return string
     */
    public function getParentCategoryId();

    /**
     * @return string
     */
    public function getChildren();

    /**
     * @return string
     */
    public function getErrorCode();
    /**
     * @return string
     */
    public function getMessage();
        /**
     * @return string
     */
    public function getUserFriendly();
    /**
     * 
     * @param type $sorted
     * @param type $asCollection
     * @param type $toLoad
     */
    public function getStoreCategories($sorted = false, $asCollection = true, $toLoad = true) ;
    /**
     * @return string
     */
    public function getRootCategory();
    /**
     * @return string
     */
    public function currentStore();
}