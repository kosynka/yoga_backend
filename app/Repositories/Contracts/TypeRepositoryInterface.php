<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TypeRepositoryInterface
{
	public function all(): ?Collection;

	public function find(int $id): ?Model;
}
