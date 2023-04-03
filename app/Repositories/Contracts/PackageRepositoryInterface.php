<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PackageRepositoryInterface
{
	public function all(): ?Collection;
}
