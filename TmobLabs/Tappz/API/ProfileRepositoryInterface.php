<?php

namespace TmobLabs\Tappz\API;

interface ProfileRepositoryInterface {

    public function getUserAgreement();

    public function login();

    public function fblogin();

    public function getProfile();

    public function createProfile();

    public function editProfile();
}
