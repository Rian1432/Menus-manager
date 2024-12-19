<?php

namespace Tests\Unit\Models\ClientTables;

use App\Models\ClientTable;
use Tests\TestCase;

class ClientTableTest extends TestCase
{
    private ClientTable $clientTable;
    private ClientTable $clientTable2;

    public function setUp(): void
    {
        parent::setUp();

        $this->clientTable = new ClientTable([
            'table_number' => 1,
        ]);
        $this->clientTable->save();

        $this->clientTable2 = new ClientTable([
            'table_number' => 2,
        ]);
        $this->clientTable2->save();
    }

    public function test_should_create_new_client_table(): void
    {
        $this->assertCount(2, ClientTable::all());
    }

    public function test_should_not_create_new_client_table_with_invalid_table_number(): void
    {
        $testerTable = new ClientTable([
            'table_number' => -1,
        ]);
        $testerTable->save();


        $this->assertCount(2, ClientTable::all());
    }

    public function test_should_not_create_new_client_table_with_duplicate_table_number(): void
    {
        $testerTable = new ClientTable([
            'table_number' => 1,
        ]);
        $testerTable->save();


        $this->assertCount(2, ClientTable::all());
    }

    public function test_all_should_return_all_client_tables(): void
    {
        $this->clientTable2->save();

        $tableList[] = $this->clientTable->id;
        $tableList[] = $this->clientTable2->id;

        $all = array_map(fn ($table) => $table->id, ClientTable::all());

        $this->assertCount(2, $all);
        $this->assertEquals($tableList, $all);
    }

    public function test_destroy_should_remove_the_client_table(): void
    {
        $this->clientTable->destroy();
        $this->assertCount(1, ClientTable::all());
    }

    public function test_errors_should_return_errors(): void
    {
        $testerTable = new ClientTable();

        $this->assertFalse($testerTable->isValid());
        $this->assertFalse($testerTable->save());
        $this->assertFalse($testerTable->hasErrors());

        $this->assertEquals('deve ser maior que 0', $testerTable->errors('table_number'));
    }

    public function test_find_by_id_should_return_the_client_table(): void
    {
        $this->assertEquals($this->clientTable->id, ClientTable::findById($this->clientTable->id)->id);
    }

    public function test_find_by_id_should_return_null(): void
    {
        $this->assertNull(ClientTable::findById(3));
    }

    public function test_find_by_table_number_should_return_the_table(): void
    {
        $table_number = strval($this->clientTable->table_number);
        $this->assertEquals($table_number, ClientTable::findByTableNumber($table_number)->table_number);
    }

    public function test_find_by_table_number_should_return_null(): void
    {
        $this->assertNull(ClientTable::findByTableNumber('3'));
    }
}
