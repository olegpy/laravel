<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\ConstantClass;
use Tests\Mocks\UserMockTest;
use Tests\TestCase;

class ProposalTest extends TestCase
{
    use WithFaker;

    /** @var User */
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = UserMockTest::createUser(UserMockTest::USER_PASSWORD);
    }

    public function testSuccessCreateProposal()
    {
        $this->createSuccessFullyProposal();
    }

    public function testTryToCreateTwiceProposal()
    {
        $this->createSuccessFullyProposal();
        $this->createSuccessFullyProposal('danger');
    }

    protected function createSuccessFullyProposal(string $sessionStatus = 'success'): TestResponse
    {
        Session::start();
        $response = $this->actingAs($this->user)->from(route(ConstantClass::PLATFORM_ROUTE_HOME))->post(route(ConstantClass::PLATFORM_ROUTE_CREATE_PROPOSAL), [
            '_token' => Session::token(),
            'title' => $this->faker->title,
            'message' => $this->faker->text,
        ]);

        $response->assertRedirect(route(ConstantClass::PLATFORM_ROUTE_HOME));
        $response->assertSessionHas(['status' => $sessionStatus]);
        return $response;
    }

    public function testTryToCreateProposalWithEmptyTitle()
    {
        Session::start();
        $response = $this->actingAs($this->user)->from(route(ConstantClass::PLATFORM_ROUTE_HOME))->post(route(ConstantClass::PLATFORM_ROUTE_CREATE_PROPOSAL), [
            '_token' => Session::token(),
            'message' => $this->faker->text,
        ]);

        $response->assertRedirect(route(ConstantClass::PLATFORM_ROUTE_HOME));
        $response->assertSessionHasErrors('title');
    }
}
