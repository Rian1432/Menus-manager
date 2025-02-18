<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;
use Lib\Validations;

class Order extends Model
{
    protected static string $table = 'orders';
    protected static array $columns = ['client_table_id', 'user_id', 'status'];

    protected ?string $client_table_id = null;
    protected ?string $status = null;

    public function clientTable(): BelongsTo
    {
        return $this->belongsTo(ClientTable::class, 'client_table_id');
    }

    public function validates(): void
    {
        Validations::notEmpty('client_table_id', $this);
        Validations::notEmpty('status', $this);
    }
}
