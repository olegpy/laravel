<?php

namespace App\Http\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Contract
{
    /**
     * @param array $data
     *
     * @return Model
     */
    public function create(array $data): Model;
}
