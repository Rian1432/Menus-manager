<?php

namespace App\Controllers;

use App\Models\ClientTable;
use App\Models\Order;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class OrderController extends Controller
{
    public string $layout = 'client';

    public function index(Request $request): void
    {
        $title = 'Pedidos';
        $table = ClientTable::findById($request->getParam('table_number'));
        $paginator = $table->orders()->paginate(page: $request->getParam('page', 1), route: route('table.orders.paginate', ['table_number' => $table->table_number]));
        $orders = $paginator->registers();

        $this->render('client/orders/index', compact('title', 'table', 'orders', 'paginator'));
    }

    public function show(Request $request): void
    {
        $title = 'Visualizar pedido';
        $table = ClientTable::findById($request->getParam('table_number'));
        $order = $table->orders()->findById($request->getParam('id'));

        $this->render('client/orders/show', compact('title', 'order', 'table'));
    }

    public function create(Request $request): void
    {
        $data =  [
            // 'client_table_id' => intval($request->getParam('table_number')),
            'client_table_id' => 40,
            'status' => 'open',
        ];

        $order = new Order($data);

        if ($order->save()) {
            FlashMessage::success('Pedido criado com sucesso');
            $this->redirectTo(route('table.orders.paginate', ['table_number' => $request->getParam('table_number')]));
        } else {
            FlashMessage::danger('Erro ao criar pedido');
        }
    }
}
