<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;
use App\Models\ClientTable;

class ValidTable implements Middleware
{
    public function handle(Request $request): void
    {
        $tableNumber = $request->getParam('id');
        $table = ClientTable::findByTableNumber($tableNumber);

        if (Auth::check()) {
            FlashMessage::danger('Você não tem acesso a esta rota!');
            $this->redirectTo(route('root'));
        }

        if (!$table || !is_numeric($tableNumber)) {
            FlashMessage::danger('Número de mesa inválido, informe um atendente!');
            $this->redirectTo(route('users.login'));
        }
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
