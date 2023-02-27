<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
	public function index(array $data);

	public function show(int $id);

	public function update(array $data);

	public function delete();
}
