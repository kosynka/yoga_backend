<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface FileRepositoryInterface
{
	public function store($attributes): Model;
}
