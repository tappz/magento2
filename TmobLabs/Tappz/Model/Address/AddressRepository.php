<?php

namespace TmobLabs\Tappz\Model\Address;

use TmobLabs\Tappz\API\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface
{

	private $addressCollector;

	public function __construct(
		AddressCollector $addressCollector
	) {
		$this->addressCollector = $addressCollector;
	}

	public function createAddress()
	{

		$result = $this->addressCollector->createAddress();
		return $result;
	}

	public function editAddress()
	{
		$result = $this->addressCollector->editAddress();
		return $result;
	}

	public function deleteAddress()
	{
		$result = $this->addressCollector->deleteAddress();
		return $result;
	}

	public function getAddress($addressId)
	{
		$result = $this->addressCollector->getAddressById($addressId);
		return $result;
	}

}
