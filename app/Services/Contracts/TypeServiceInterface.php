<?php

namespace App\Services\Contracts;

interface TypeServiceInterface
{
	public function index(array $data);

	public function show(int $id);
}
