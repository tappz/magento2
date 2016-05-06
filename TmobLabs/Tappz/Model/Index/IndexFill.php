<?php

namespace TmobLabs\Tappz\Model\Index;

class IndexFill extends Index
{

	protected $_storeManager;

	public function __construct(
		\Magento\Store\Model\StoreManagerInterface $storeManager
	) {
		$this->_storeManager = $storeManager;
	}

	public function fillIndex()
	{
		return [
			'groups' => $this->getGroups(),
			'ads' => $this->getAds(),
			'ErrorCode' => $this->getErrorCode(),
			'Message' => $this->getMessage(),
			'UserFriendly' => $this->getUserFriendly(),
		];
	}

}
