<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserRepository extends Repository implements UserRepositoryContract
{

    /**
     * {@inheritdoc}
     */
    public function model()
    {
        return User::class;
    }

//    /**
//     * Get admin email by role_id
//     *
//     * @return Model
//     */
//    public function findUserAdmin(): Model
//    {
//        return $this->whereFirst(['role_id' => Role::USER_ID_SUPER_USER]);
//    }
//
//    /**
//     * Check is User have admin role
//     *
//     * @param User $user
//     * @return bool
//     */
//    public function isAdmin(User $user): bool
//    {
//        return $user->role_id == Role::USER_ID_SUPER_USER ?? false;
//    }
//
//    /**
//     * @param int $id
//     * @param bool $withSelectedFields
//     * @return Model
//     */
//    public function withCompanySelectedPublicFields(int $id, bool $withSelectedFields = true): Model
//    {
//        return $this->model->with([
//            'company' => function ($query) {
//                $query->select(Company::PUBLIC_FIELDS);
//            },'country', 'role'
//        ])->find($id);
//    }

//    /**
//     * @param array $requestData
//     * @param array $relatedData
//     * @return Collection
//     */
//    public function search(array $requestData, array $relatedData): Collection
//    {
//        $query = (array_has($requestData, 'q')) ? $requestData['q'] : "*";
//        $collection = $this->model::search($query)
//            ->where('id', '<>', $requestData['user_id'])
//            ->where('active', '=', User::USER_ACTIVE);
//
//        $collection->limit = User::DEFAULT_LIMIT;
//
//        if (array_has($requestData, User::RELATION_ALIAS_COUNTRY)) {
//            $array = exist_in_array($requestData, User::RELATION_ALIAS_COUNTRY);
//            where_in_search_collection($collection, User::RELATION_ALIAS_COUNTRY, $array);
//        }
//
//        return $collection->with($relatedData)->get();
//    }
}
