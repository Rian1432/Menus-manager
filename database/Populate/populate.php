<?php

require __DIR__ . '/../../config/bootstrap.php';

use Core\Database\Database;
use Database\Populate\ClientTablesPopulate;
use Database\Populate\OrdersPopulate;
use Database\Populate\UsersPopulate;

Database::migrate();

UsersPopulate::populate();
ClientTablesPopulate::populate();
OrdersPopulate::populate();