<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
	public function find(int $id): ?Model;

	public function store(array $attributes): Model;

	public function findByPhone(string $phone): ?Model;

	public function update(int $id, array $attributes): Model;

	public function delete(int $id): void;
}
