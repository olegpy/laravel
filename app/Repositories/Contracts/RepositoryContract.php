<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface RepositoryContract
{
    /**
     * @return Model
     */
    public function makeModel(): Model;

    /**
     * Create Model
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Fill model
     *
     * @param array $data
     * @return Model
     */
    public function fill(array $data): Model;

    /**
     * Update model
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function updateByArray(Model $model, array $data): Model;
}
