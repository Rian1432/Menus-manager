<?php

namespace Database\Populate;

use App\Enums\RolesEnum;
use App\Models\ClientTable;

class ClientTablesPopulate
{
    public static function populate()
    {
        $data =  [
            'role' => RolesEnum::TABLE,
            'table_number' => 1,
        ];
        
        $table = new ClientTable($data);
        $table->save();

        $numberOfTables = 10;

        for ($i = 1; $i < $numberOfTables; $i++) {
            $data =  [
                'role' => RolesEnum::TABLE,
                'table_number' => $i + 1,
            ];
            
            $table = new ClientTable($data);
            $table->save();
        }

        echo "Tables populated with $numberOfTables registers\n";
    }
}