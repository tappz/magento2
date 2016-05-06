<?php
namespace TmobLabs\Tappz\API\Data;

interface AgreementInterface
{
	/**
	 * @return string
	 */
	public function getAgreementText();

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
}