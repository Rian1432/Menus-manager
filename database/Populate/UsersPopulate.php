<?php

namespace Database\Populate;

use App\Enums\RolesEnum;
use App\Models\User;

class UsersPopulate
{
    public static function populate()
    {
        $data =  [
            'name' => 'Fulano',
            'email' => 'fulano@example.com',
            'role' => RolesEnum::ADMIN,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        
        $user = new User($data);
        $user->save();

        $numberOfUsers = 10;

        for ($i = 1; $i < $numberOfUsers; $i++) {
            $data =  [
                'name' => 'Fulano ' . $i,
                'email' => 'fulano' . $i . '@example.com',
                'role' => RolesEnum::ADMIN,
                'password' => '123456',
                'password_confirmation' => '123456'
            ];

            $user = new User($data);
            $user->save();
        }

        echo "Users populated with $numberOfUsers registers\n";
    }
}