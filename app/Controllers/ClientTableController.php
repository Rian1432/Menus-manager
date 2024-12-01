<?php

namespace App\Controllers;

use App\Models\ClientTable;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class ClientTableController extends Controller
{
    public string $layout = 'client';

    public function index(Request $request): void
    {
        $title = 'Cardápio';
        $table = ClientTable::findByTableNumber($request->getParam('id'));

        FlashMessage::success('Seja bem-vindo à mesa ' . $table->table_number . '!');
        $this->render('client/index', compact('title', 'table'));
    }
}
