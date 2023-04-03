<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface DeleteUsersExpiredPackageJobInterface
{
	public function getAll(): ?Collection;

	public function updateAll(array $ids, array $data): void;
}
