<?php
namespace TmobLabs\Tappz\API\Data;

interface IndexInterface
{
	/**
	 *  Return array
	 */
	public function getGroups();

	/**
	 *
	 * Return array
	 */
	public function getAds();

	/**
	 *
	 * Return string
	 */
	public function getErrorCode();

	/**
	 *  Return string
	 */
	public function getMessage();

	/**
	 *
	 * Return string
	 */
	public function getUserFriendly();
}