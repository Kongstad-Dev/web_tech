<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_calculates_the_total_amount_correctly()
    {
        $cart = Cart::create();

        // Create products with the specified attributes
        $product1 = Product::create([
            'name' => 'Product Name',
            'description' => 'Product Description',
            'quantity' => 100,
            'price' => 19.99,
            'product_info1' => 'Info 1',
            'product_info2' => 'Info 2',
            'product_info3' => 'Info 3',
            'product_info4' => 'Info 4',
            'image' => 'path/to/image.jpg',


        ]);

        $product2 = Product::create([
            'name' => 'Product Name',
            'description' => 'Product Description',
            'quantity' => 100,
            'price' => 19.99,
            'product_info1' => 'Info 1',
            'product_info2' => 'Info 2',
            'product_info3' => 'Info 3',
            'product_info4' => 'Info 4',
            'image' => 'path/to/image.jpg',
        ]);


        $product3 = Product::create([
            'name' => 'Product Name',
            'description' => 'Product Description',
            'quantity' => 100,
            'price' => 19.99,
            'product_info1' => 'Info 1',
            'product_info2' => 'Info 2',
            'product_info3' => 'Info 3',
            'product_info4' => 'Info 4',
            'image' => 'path/to/image.jpg',
        ]);


        // Attach products to the cart with the quantities for the cart
        $cart->products()->attach($product1->id, ['quantity' => 2]);
        $cart->products()->attach($product2->id, ['quantity' => 1]);
        $cart->products()->attach($product3->id, ['quantity' => 4]);

        // Refresh the cart instance to load the attached products
        $cart->load('products');

        // Assert the total is calculated correctly
        $this->assertEquals(139.93, $cart->calculateTotal());
    }
}
