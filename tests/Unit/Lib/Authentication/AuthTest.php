<?php

namespace Tests\Unit\Lib\Authentication;

use Lib\Authentication\Auth;
use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $_SESSION = [];
        $this->user = new User([
            'name' => 'User 1',
            'email' => 'fulano@example.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        $this->user->save();
    }

    public function tearDown(): void
    {
        parent::setUp();
        $_SESSION = [];
    }

    public function testLogin(): void
    {
        Auth::login($this->user);

        $this->assertEquals(1, $_SESSION['user']['id']);
    }

    public function testUser(): void
    {
        Auth::login($this->user);

        $userFromSession = Auth::user();

        $this->assertEquals($this->user->id, $userFromSession->id);
    }

    public function testCheck(): void
    {
        Auth::login($this->user);

        $this->assertTrue(Auth::check());
    }

    public function testLogout(): void
    {
        Auth::login($this->user);
        Auth::logout();

        $this->assertFalse(Auth::check());
    }
}
