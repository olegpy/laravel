<?php

namespace Tests\Feature\User;

use App\Repositories\Contracts\UserRepositoryContract;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

//    protected function setUp() {
//        parent::setUp();
//        $mockServiceInterface = $this->getMockBuilder(UserRepositoryContract::class)->getMock();
//        $this->app->instance(UserRepositoryContract::class,$mockServiceInterface);
//    }
//
//    public function testPostToRoute() {
//        $this->post(route('routeToActionInMyController'), $params);
//    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
