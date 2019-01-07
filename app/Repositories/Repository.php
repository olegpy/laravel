<?php

namespace App\Repositories;

use App\Exceptions\RepositoryException;
use App\Models\Company;
use App\Models\Country;
use App\Repositories\Contracts\RepositoryContract;
use Carbon\Carbon;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

abstract class Repository implements RepositoryContract
{
    /** @var \Illuminate\Database\Eloquent\Model */
    public $model;

    /**
     * Repository constructor.
     * @param App $app
     * @throws RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract protected function model();

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Create Model
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function fill(array $data): Model
    {
        return $this->model->fill($data);
    }

    public function createArraysModels(array $data):  array
    {
        $idsCreatedModels = [];
        collect($data)->each(function ($item) use (&$idsCreatedModels) {
            $idsCreatedModels[] = $this->create($item)->id;
        });
        return $idsCreatedModels;
    }

    /**
     * @param array $fields
     * @return mixed
     */
    public function whereFirst(array $fields)
    {
        dd($this->model->where('created_at', 'LIKE', Carbon::now()->toDateString() . '%')->count());
        return $this->model->where($fields)->first();
    }



    /**
     * @param array $data
     * @return Collection
     */
    public function all(array $data = ['*']): Collection
    {
        return $this->model::all($data);
    }

    /**
     * Search selector got category
     *
     * @param string $string
     * @param array $data
     * @return Builder
     */
    public function setSearchSelector(string $string, array $data): Builder
    {
//        if (!empty($data)) {
//            return $this->model->where($data)->where('company_name', 'LIKE', '%{$string}%');
//        }
//        return $this->model->where('company_name', 'LIKE', "%$string%");
    }

    /**
     * @param array $data
     *
     * @return Builder
     */
    public function whereArray(array $data): Builder
    {
        return $this->model->where($data);
    }

    /**
     * @param Collection $collection
     * @param string $key
     * @param array $data
     * @return Collection
     */
    public function whereArrayFromModel(Collection $collection, string $key, string $value): Collection
    {
        return $collection->where($key, $value);
    }

    /**
     * Update model
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function updateByArray(Model $model, array $data): Model
    {
        $model->fill($data)->save();
        return $model;
    }

    /**
     * get list of model with relations
     *
     * @param array $data
     * @return Collection
     */
    public function with(array $data): Collection
    {
        return $this->model->with($data)->get();
    }

    /**
     * get list of model with relations
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function load(Model $model, array $data): Model
    {
        return $model->load($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @param $arrayRelatedModels
     * @return void
     */
    public function updateRelatedModels(Model $model, array $data, $arrayRelatedModels): void
    {
        foreach ($arrayRelatedModels as $value) {
            if (isset($data[$value])) {
                $method = camel_case($value);
                $model->$method()->sync($data[$value]);
            }
        }
    }
//
//    /**
//     * @param int $id
//     * @param bool $withSelectedFields
//     * @return Model
//     */
//    public function modelWithSelectedPublicFields(int $id, array $data): Model
//    {
//        return $this->model->with($data)->find($id);
//    }
//
//    public function whereIn(string $key, array $values): Builder
//    {
//        return $this->model->whereIn($key, $values);
//    }
//
//    public function updateExistingPivot(BelongsToMany $collection, int $id, array $data)
//    {
//        return $collection->updateExistingPivot($id, $data);
//    }
}
