<?php

namespace App\Controllers;

use App\Models\ClientTable;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class TableController extends Controller
{
    public function index(Request $request): void
    {
        $title = 'Mesas';
        $paginator = ClientTable::paginate(page: $request->getParam('page', 1), route: route('tables.paginate'));
        $tables = $paginator->registers();

        $this->render('admin/tables/index', compact('title', 'tables', 'paginator'));
    }

    public function new(Request $request): void
    {
        $table = new ClientTable();

        $title = 'Nova mesa';
        $this->render('admin/tables/new', compact('title', 'table'));
    }

    public function edit(Request $request): void
    {
        $title = 'Editar mesa';
        $table = ClientTable::findById($request->getParam('id'));

        $this->render('admin/tables/edit', compact('title', 'table'));
    }

    public function create(Request $request): void
    {
        $table = new ClientTable($request->getParam('table'));

        if ($table->save()) {
            FlashMessage::success('Mesa criada com sucesso');
            $this->redirectTo(route('tables.paginate'));
        } else {
            FlashMessage::danger('Erro ao criar mesa');

            $title = 'Nova mesa';
            $this->render('admin/tables/new', compact('title', 'table'));
        }
    }

    public function update(Request $request): void
    {
        $table = ClientTable::findById($request->getParam('id'));
        $params = $request->getParam('table');

        $table->table_number = $params['table_number'];

        if ($table->save()) {
            FlashMessage::success('Mesa atualizada com sucesso');
            $this->redirectTo(route('tables.index'));
        } else {
            FlashMessage::danger('Erro ao atualizar mesa');

            $title = 'Editar mesa';
            $this->render('admin/tables/edit', compact('title', 'table'));
        }
    }

    public function destroy(Request $request): void
    {
        $table = ClientTable::findById($request->getParam('id'));

        if ($table->destroy()) {
            FlashMessage::success('Mesa deletada com sucesso');
        } else {
            FlashMessage::danger('Erro ao deletar mesa');
        }

        $this->redirectTo(route('tables.paginate'));
    }
}
