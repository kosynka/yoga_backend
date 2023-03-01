<?php

namespace App\Services\Contracts;

interface AffiliateServiceInterface
{
	public function index(array $data);

	public function show(int $id);
}
