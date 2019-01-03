<?php

namespace App\Repositories\Contracts;

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

    public function createArraysModels(array $data): array;

    /**
     * @param array $fields
     * @return mixed
     */
    public function whereFirst(array $fields);

    /**
     * @param array $data
     * @return Collection
     */
    public function all(array $data = ['*']): Collection;

    /**
     * Search selector got category
     *
     * @param string $string
     * @param array $data
     * @return Builder
     */
    public function setSearchSelector(string $string, array $data): Builder;

    /**
     * @param array $data
     *
     * @return Builder
     */
    public function whereArray(array $data): Builder;

    /**
     * @param Collection $collection
     * @param string $key
     * @param array $data
     * @return Collection
     */
    public function whereArrayFromModel(Collection $collection, string $key, string $value): Collection;

    /**
     * Update model
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function updateByArray(Model $model, array $data): Model;

    /**
     * get list of model with relations
     *
     * @param array $data
     * @return Collection
     */
    public function with(array $data): Collection;

    /**
     * get list of model with relations
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function load(Model $model, array $data): Model;

    /**
     * @param Model $model
     * @param array $data
     * @param $arrayRelatedModels
     */
    public function updateRelatedModels(Model $model, array $data, $arrayRelatedModels): void;
}
