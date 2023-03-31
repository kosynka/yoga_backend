<?php

namespace App\Services\Contracts;

interface AuthServiceInterface
{
	public function login(array $data);

	public function register(array $data);

	public function sendverify(string $phone);

	public function verify(array $data);

	public function logout();
}
