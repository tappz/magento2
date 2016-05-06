<?php

namespace TmobLabs\Tappz\Model\Profile;

use TmobLabs\Tappz\API\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{

	private $profileCollector;

	public function __construct(
		ProfileCollector $profileCollector
	) {
		$this->profileCollector = $profileCollector;
	}

	public function getUserAgreement()
	{
		$result = $this->profileCollector->userAgreement();
		return $result;
	}

	public function login()
	{
		$result = $this->profileCollector->login();
		return $result;
	}

	public function fblogin()
	{
		$result = $this->profileCollector->fblogin();
		return $result;
	}

	public function getProfile()
	{
		$result = $this->profileCollector->getProfile();
		return $result;
	}

	public function createProfile()
	{
		$result = $this->profileCollector->createProfile();
		return $result;
	}

	public function editProfile()
	{
		$result = $this->profileCollector->editProfile();
		return $result;
	}

}
