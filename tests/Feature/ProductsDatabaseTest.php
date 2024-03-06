<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductsDatabaseTest extends TestCase
{

    /** @test */
    public function products_table_is_not_empty()
    {
        // Assuming your database is seeded with at least one product.
        // You may seed the database here if needed, for example:
        // Product::create([...]);

        // Attempt to retrieve the first product from the database
        $product = Product::first();

        // Assert that a product was found, meaning the table is not empty
        $this->assertNotNull($product, 'Expected the products table not to be empty, but it was.');
    }
}
