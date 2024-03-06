<?php

namespace Tests\Browser;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddItemToCartTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $cart = Cart::create([
            // Add necessary fields required by your Cart model
        ]);

        // Then, create a user linked to the created cart
        $user = User::create([
            'email' => 'B@B.com',
            'password' => bcrypt('B'), // Ensure password is hashed
            'phone' => '12345678', // Optional for this test
            'admin' => false, // Optional for this test
            'cart_id' => $cart->id, // Use the id of the cart you just created
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'B') // Use the plaintext password here
                ->press('login')
                ->press('Products')
                ->press('Click For More')
                ->press('Add To Cart')
                ->press('Cart')
                ->press('Checkout')
                ->type('firstName', 'B')
                ->type('lastName', 'B')
                ->type('address', 'B')
                ->type('apartment', 'B')
                ->type('zipcode', 'B')
                ->type('city', 'B')
                ->type('phone', '12345678')
                ->assertPathis('/checkoutPage');
        });

            $user->delete();

        }
    }
