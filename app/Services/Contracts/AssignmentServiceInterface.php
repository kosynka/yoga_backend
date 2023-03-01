<?php

namespace App\Services\Contracts;

interface AssignmentServiceInterface
{
	public function index(array $data);

	public function store(array $data);

	public function show(int $id);

	public function update(int $id, array $data);

	public function destroy(int $id);
}
