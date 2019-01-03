<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\UserContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserContract
{
    /** @var UserRepositoryContract */
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Model
    {
        return $this->userRepository->create($data);
    }
}
