<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Session;
use Tests\ConstantClass;
use Tests\Mocks\UserMockTest;
use Tests\TestCase;

class UserTest extends TestCase
{


    /** @var User */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

//    protected function setUp() {
//        parent::setUp();
//        $mockServiceInterface = $this->getMockBuilder(UserRepositoryContract::class)->getMock();
//        $this->app->instance(UserRepositoryContract::class,$mockServiceInterface);
//    }
//
//    public function testPostToRoute() {
//        $this->post(route('routeToActionInMyController'), $params);
//    }


    public function testNotAuthorizeUserRedirectedToLogin()
    {
        $response = $this->get(route(ConstantClass::PLATFORM_ROUTE_HOME));
        $response->assertRedirect(route(ConstantClass::PLATFORM_ROUTE_LOGIN));
        $this->assertEquals('Unauthenticated.', $response->exception->getMessage());
    }

    public function testUserCannotLoginWithBadPassword()
    {
        $user = UserMockTest::createUser(UserMockTest::USER_PASSWORD);

        Session::start();

        $response = $this->from(route(ConstantClass::PLATFORM_ROUTE_LOGIN))->post(route(ConstantClass::PLATFORM_ROUTE_LOGIN), self::authData($user->email, 'invalid-password'));

        $response->assertRedirect(route(ConstantClass::PLATFORM_ROUTE_LOGIN));
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function createUser(User $user): TestResponse
    {
        Session::start();

        $response = $this->post(route(ConstantClass::PLATFORM_ROUTE_LOGIN), self::authData($user->email));

        $response->assertRedirect(route(ConstantClass::PLATFORM_ROUTE_HOME));

        $this->assertAuthenticatedAs($user);

        return $response;
    }

    public function testUserCanLoginWithCorrectCredentials()
    {
        $user = UserMockTest::createUser(UserMockTest::USER_PASSWORD);

        $this->createUser($user);
    }

    public static function authData(string $email, string $password = UserMockTest::USER_PASSWORD): array
    {
        return [
            '_token' => Session::token(),
            'email' => $email,
            'password' => $password,
        ];
    }

}
