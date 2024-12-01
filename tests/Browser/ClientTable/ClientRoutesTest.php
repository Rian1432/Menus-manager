<?php

namespace Tests\Browser\ClientTable;

use Tests\TestCase;

class ClientRoutesTest extends TestCase
{
    public function test_should_redirect_if_not_valid_table_number(): void
    {
        $page = file_get_contents('http://web/table/1');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }
}
