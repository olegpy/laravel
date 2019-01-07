<?php

namespace App\Http\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ServiceContract
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array;
}
