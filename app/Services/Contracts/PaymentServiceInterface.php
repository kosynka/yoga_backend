<?php

namespace App\Services\Contracts;

interface PaymentServiceInterface
{
	public function init(array $data);

	public function check(int $data);
}
