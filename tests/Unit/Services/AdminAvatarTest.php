<?php

namespace Tests\Unit\Services;

use App\Models\User;
use Tests\TestCase;

class AdminAvatarTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();


        $this->user = new User([
            'name' => 'User 1',
            'email' => 'fulano@example.com',
            'responsibility' => 'Gerente',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        $this->user->save();
    }

    public function test_upload_avatar(): void
    {
        $image = [
        'name' => 'test.png',
        'full_path' => 'test.png',
        'type' => 'image/png',
        'tmp_name' => 'tmp_name',
        'error' => 0,
        'size' => 100
        ];
        $this->assertTrue($this->user->avatar()->update($image));
    }

    public function test_delete_image(): void
    {
        $image = [
        'name' => 'test.png',
        'full_path' => 'test.png',
        'type' => 'image/png',
        'tmp_name' => 'tmp_name',
        'error' => 0,
        'size' => 100
        ];

        $this->user->avatar()->update($image);
        $this->user->avatar()->delete();
        $this->assertNull($this->user->avatar_name);
    }

    public function test_update_invalid_type_image(): void
    {
        $image = [
        'name' => 'test.pdf',
        'full_path' => 'test.pdf',
        'type' => 'application/pdf',
        'tmp_name' => 'tmp_name',
        'error' => 0,
        'size' => 100
        ];

        $this->assertFalse($this->user->avatar()->update($image));
    }

    public function test_update_invalid_size_image(): void
    {
        $image = [
        'name' => 'test.png',
        'full_path' => 'test.png',
        'type' => 'image/png',
        'tmp_name' => 'tmp_name',
        'error' => 0,
        'size' => 1000000000
        ];

        $this->assertFalse($this->user->avatar()->update($image));
    }
}
