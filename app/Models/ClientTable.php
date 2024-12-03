<?php

namespace App\Models;

use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property string $role
 * @property number $table_number
 * @property string $link_token
 *  */

class ClientTable extends Model
{
    protected static string $table = 'users';
    protected static array $columns = ['role', 'table_number', 'link_token'];

    protected ?string $table_number = null;
    protected ?string $link_token = null;

    public function validates(): void
    {
        Validations::notEmpty('role', $this);
        Validations::notEmpty('table_number', $this);
        Validations::biggerThan('table_number', 0, $this);

        Validations::uniqueness('table_number', $this);
    }

    public static function findByTableNumber(string $tableNumber): ClientTable | null
    {
        return ClientTable::findBy(['table_number' => $tableNumber]);
    }

    public function save(): bool
    {
        $this->link_token = '/table/' . $this->table_number;

        return parent::save();
    }
}
