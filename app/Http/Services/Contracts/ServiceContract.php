<?php

namespace App\Http\Services\Contracts;

interface ServiceContract
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array;
}
