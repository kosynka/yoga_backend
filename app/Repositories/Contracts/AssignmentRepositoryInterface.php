<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AssignmentRepositoryInterface
{
	public function all(array $attributes): ?Collection;

	public function find(int $id): ?Model;

	public function store(array $attributes): Model;

	public function update(int $id, array $attributes): Model;

	public function destroy(int $id): void;
}
