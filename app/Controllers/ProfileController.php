<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Lib\FlashMessage;

class ProfileController extends Controller
{
    public function show(): void
    {
        $title = 'Meu Perfil';
        $this->render('admin/profile/show', compact('title'));
    }

    public function updateAvatar(): void
    {
        $image = $_FILES['user_avatar'];


        if ($this->current_user->avatar()->update($image)) {
            FlashMessage::success('Avatar atualizado com sucesso');
        } else {
            FlashMessage::danger('Arquivo inválido');
        }

        $this->redirectTo(route('profile.show'));
    }
}
