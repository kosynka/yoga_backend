<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
	public function all(array $attributes): ?Collection;

	public function find(int $id): ?Model;

	public function findWithFilter(array $attributes, int $id);

	public function store(array $attributes): Model;

	public function findByPhone(string $phone): ?Model;

	public function update($model, array $attributes): Model;

	public function destroy($model): void;
}
