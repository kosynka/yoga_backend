<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AffiliateRepositoryInterface
{
	public function all(array $attributes): ?Collection;

	public function find(int $id): ?Model;

	public function findWithFilter(array $attributes, int $id);
}
