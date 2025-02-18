<?php

namespace Tests\Unit\Models\Orders;

use App\Models\ClientTable;
use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    private ClientTable $clientTable;
    private Order $order;

    public function setUp(): void
    {
        parent::setUp();

        $this->clientTable = new ClientTable(['table_number' => 1]);
        $this->clientTable->save();


        $this->order = new Order(['client_table_id' => $this->clientTable->id, 'status' => 'open']);
        $this->order->save();
    }

    public function test_should_create_new_order(): void
    {
        $this->assertTrue($this->order->save());
        $this->assertCount(1, Order::all());
    }


    public function test_all_should_return_all_orders(): void
    {
        $orderList[] = $this->order;
        $orderList[] = $this->clientTable->orders()->new(['status' => 'open']);
        $orderList[1]->save();

        $all = Order::all();
        $this->assertCount(2, $all);
        $this->assertEquals($orderList, $all);
    }


    public function test_errors_should_return_empty_field_errors(): void
    {
            $orderTest = new Order();

            $this->assertFalse($orderTest->isValid());
            $this->assertFalse($orderTest->save());
            $this->assertFalse($orderTest->hasErrors());

            $this->assertEquals('não pode ser vazio!', $orderTest->errors('client_table_id'));
            $this->assertEquals('não pode ser vazio!', $orderTest->errors('status'));
    }


    public function test_find_by_id_should_return_null(): void
    {
        $this->assertNull(Order::findById(10));
    }

    public function test_find_by_id_should_return_the_order(): void
    {
        $order1 = $this->clientTable->orders()->new(['status' => 'open']);

        $order1->save();

        $this->assertEquals($order1, Order::findById($order1->id));
    }

    public function test_destroy_order_when_remove_the_client_table(): void
    {
        $this->clientTable->destroy();
        $this->assertCount(0, ClientTable::all());
    }
}
