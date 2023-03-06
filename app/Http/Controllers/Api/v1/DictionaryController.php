<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Services\Contracts\DictionaryServiceInterface;

class DictionaryController extends ApiController
{
    private DictionaryServiceInterface $service;

    public function __construct(DictionaryServiceInterface $service)
    {
        $this->service = $service;
    }

    public function cities()
    {
        return $this->result($this->service->cities());
    }
}
