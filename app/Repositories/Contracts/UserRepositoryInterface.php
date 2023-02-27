<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
	public function all(): ?Collection;

	public function find(int $id): ?Model;

	public function store(array $attributes): Model;

	public function findByPhone(string $phone): ?Model;

	public function update($model, array $attributes): Model;

	public function delete($model): void;
}
