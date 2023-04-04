<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Payment\InitPaymentRequest;
use App\Services\Contracts\PaymentServiceInterface;

class PaymentController extends ApiController
{
    private PaymentServiceInterface $service;

    public function __construct(PaymentServiceInterface $service)
    {
        $this->service = $service;
    }

    public function init(InitPaymentRequest $request)
    {
        $data = $request->validated();

        return $this->result($this->service->init($data));
    }

    public function check(int $id)
    {
        return $this->result($this->service->check($id));
    }
}
