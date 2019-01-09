<?php

namespace Tests\Mocks;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserMockTest
{
    const USER_PASSWORD = 'testPassword';

    static function createUser(string $password): User
    {
        return factory(User::class)->create([
            'password' => bcrypt($password),
        ]);
    }
}
