<?php

namespace App\Controllers;

use App\Models\User;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class UsersController extends Controller
{
    public function index(Request $request): void
    {
        $title = 'Usuários';
        $paginator = User::paginate(page: $request->getParam('page', 1));
        $users = $paginator->registers();

        $this->render('admin/users/index', compact('title', 'users', 'paginator'));
    }

    public function new(Request $request): void
    {
        $user = new User();

        $title = 'Novo usuário';
        $this->render('admin/users/new', compact('title', 'user'));
    }

    public function edit(Request $request): void
    {
        $title = 'Editar usuário';
        $user = User::findById($request->getParam('id'));

        $this->render('admin/users/edit', compact('title', 'user'));
    }

    public function create(Request $request): void
    {
        $user = new User($request->getParam('user'));

        if ($user->save()) {
            FlashMessage::success('Usuário criado com sucesso');
            $this->redirectTo(route('users.index'));
        } else {
            FlashMessage::danger('Erro ao criar usuário');

            $title = 'Novo usuário';
            $this->render('admin/users/new', compact('title', 'user'));
        }
    }

    public function update(Request $request): void
    {
        $user = User::findById($request->getParam('id'));
        $params = $request->getParam('user');

        $user->name = $params['name'];
        $user->email = $params['email'];

        if ($user->save()) {
            FlashMessage::success('Usuário atualizado com sucesso');
            $this->redirectTo(route('users.index'));
        } else {
            FlashMessage::danger('Erro ao atualizar usuário');

            $title = 'Editar usuário';
            $this->render('admin/users/edit', compact('title', 'user'));
        }
    }

    public function destroy(Request $request): void
    {
        $user = User::findById($request->getParam('id'));

        if ($user->destroy()) {
            FlashMessage::success('Usuário deletado com sucesso');
        } else {
            FlashMessage::danger('Erro ao deletar usuário');
        }

        $this->redirectTo(route('users.index'));
    }
}
