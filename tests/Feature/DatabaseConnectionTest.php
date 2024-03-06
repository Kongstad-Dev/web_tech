<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Exception;

class DatabaseConnectionTest extends TestCase
{
    /**
     * Test database connection.
     *
     * @return void
     */
    public function testDatabaseConnection()
    {
        $this->withoutExceptionHandling();

        try {
            // Directly passing the query string to the select method
            $result = DB::select('SELECT NOW() as current_date');

            // If we made it here, it means the database connection is okay
            $isConnected = true;
        } catch (Exception $e) {
            // If an exception was thrown, the database connection failed
            $isConnected = false;
        }

        // Assert that $isConnected is true - meaning the database connection was successful
        $this->assertTrue($isConnected, 'The database connection is not working as expected.');
    }

}
