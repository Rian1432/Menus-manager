<?php

namespace App\Controllers;

use App\Models\ClientTable;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class OrderController extends Controller
{
    public string $layout = 'client';

    public function index(Request $request): void
    {
        $title = 'Pedidos';
        $table = ClientTable::findByTableNumber($request->getParam('table_number'));
        $paginator = $table->orders()->paginate(
            page: $request->getParam('page', 1),
            route: route('table.orders.paginate', ['table_number' => $table->table_number])
        );
        $orders = $paginator->registers();

        $this->render('client/orders/index', compact('title', 'table', 'orders', 'paginator'));
    }

    public function show(Request $request): void
    {
        $title = 'Visualizar pedido';
        $table = ClientTable::findByTableNumber($request->getParam('table_number'));
        $order = $table->orders()->findById($request->getParam('id'));

        $this->render('client/orders/show', compact('title', 'order', 'table'));
    }

    public function create(Request $request): void
    {
        $table = ClientTable::findByTableNumber($request->getParam('table_number'));
        $order = $table->orders()->new(['status' => 'open']);

        if ($order->save()) {
            FlashMessage::success('Pedido criado com sucesso');
            $this->redirectTo(route('table.orders.paginate', ['table_number' => $request->getParam('table_number')]));
        } else {
            FlashMessage::danger('Erro ao criar pedido');
            $this->redirectTo(route('table.orders.paginate', ['table_number' => $request->getParam('table_number')]));
        }
    }
}
