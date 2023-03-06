<?php

namespace App\Services\Contracts;

interface AffiliateServiceInterface
{
	public function index(array $data);

	public function like(int $id);

	public function show(int $id);

	public function showFavorite();
}
