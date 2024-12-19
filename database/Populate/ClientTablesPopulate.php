<?php

namespace Database\Populate;

use App\Models\ClientTable;

class ClientTablesPopulate
{
    public static function populate()
    {
        $data =  [
            'table_number' => 1,
        ];
        
        $table = new ClientTable($data);
        $table->save();

        $numberOfTables = 10;

        for ($i = 1; $i < $numberOfTables; $i++) {
            $data =  [
                'table_number' => $i + 1,
            ];
            
            $table = new ClientTable($data);
            $table->save();
        }

        echo "Tables populated with $numberOfTables registers\n";
    }
}