<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\UserServiceContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceContract
{
    /** @var UserRepositoryContract */
    protected $userRepository;

    /**
     * @param UserRepositoryContract $userRepository
     */
    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data): Model
    {
        return $this->userRepository->create($data);
    }
}
