<?php

namespace Tests\Unit;

use App\DTOs\SignupDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepo = Mockery::mock(UserRepository::class);
        $this->service = new UserService($this->userRepo);

        $this->user = User::factory(['email' => 'test@test.com', 'password' => '12345'])->create();
    }

    public function test_it_can_generate_token()
    {
        $this->userRepo->shouldReceive('createUser')->andReturn($this->user);

        $accessToken = 'mocked_token';
        Auth::shouldReceive('guard')
            ->once()
            ->andReturnSelf();
        Auth::shouldReceive('setTTL')
            ->with(30)
            ->andReturnSelf();
        Auth::shouldReceive('login')
            ->with($this->user)
            ->andReturn($accessToken);

        $signupDTO = new SignupDTO([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'password' => "12345",
        ]);

        $result = $this->service->signup($signupDTO);

        $this->assertArrayHasKey('access_token', $result);
        $this->assertEquals($accessToken, $result['access_token']);
    }
}
