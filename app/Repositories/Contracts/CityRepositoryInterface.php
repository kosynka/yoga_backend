<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CityRepositoryInterface
{
	public function cities(): ?Collection;
}
