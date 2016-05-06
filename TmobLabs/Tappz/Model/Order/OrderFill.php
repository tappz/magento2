<?php

namespace TmobLabs\Tappz\Model\Order;

class OrderFill extends Order
{

	protected $_storeManager;

	public function __construct(
		\Magento\Store\Model\StoreManagerInterface $storeManager
	) {
		$this->_storeManager = $storeManager;
	}

	public function fillCountries()
	{

		return [
			'countries' => $this->getCodeAndName(),
			"ErrorCode" => $this->getErrorCode(),
			"Message" => $this->getMessage(),
			"UserFriendly" => $this->getUserFriendly()
		];
	}

	public function fillStates()
	{

		return [
			'states' => $this->getCodeAndName(),
			"ErrorCode" => $this->getErrorCode(),
			"Message" => $this->getMessage(),
			"UserFriendly" => $this->getUserFriendly()
		];
	}

	public function fillCities()
	{

		return [
			'cities' => $this->getCodeAndName(),
			"ErrorCode" => $this->getErrorCode(),
			"Message" => $this->getMessage(),
			"UserFriendly" => $this->getUserFriendly()
		];
	}

	public function fillDistricts()
	{

		return [
			"code" => $this->getDefaultCode(),
			"name" => $this->getDefaultName(),
			'districts' => $this->getCodeAndName(),
			"ErrorCode" => $this->getErrorCode(),
			"Message" => $this->getMessage(),
			"UserFriendly" => $this->getUserFriendly()
		];
	}

	public function fillTowns()
	{

		return [
			"code" => $this->getDefaultCode(),
			"name" => $this->getDefaultName(),
			'towns' => $this->getCodeAndName(),
			"ErrorCode" => $this->getErrorCode(),
			"Message" => $this->getMessage(),
			"UserFriendly" => $this->getUserFriendly()
		];
	}

	public function fillCodeAndName()
	{
		return [
			"code" => $this->getCode(),
			"name" => $this->getName()
		];
	}

}
