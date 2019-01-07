<?php

namespace App\Http\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UserServiceContract
{
    /**
     * @param array $data
     *
     * @return Model
     */
    public function store(array $data): Model;
}
