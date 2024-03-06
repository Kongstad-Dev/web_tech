<?php

namespace Tests\Browser;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteCartItemTest extends DuskTestCase
{
    /**
     * Test deleting an item from the shopping cart.
     */
    public function testDeleteCartItem()
    {
       $cart = Cart::create([
            // Add necessary fields required by your Cart model
        ]);

        // Then, create a user linked to the created cart
        $user = User::create([
            'email' => 'C@C.com',
            'password' => bcrypt('C'), // Ensure password is hashed
            'phone' => '12345678', // Optional for this test
            'admin' => false, // Optional for this test
            'cart_id' => $cart->id, // Use the id of the cart you just created
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'C') // Use the plaintext password here
                ->press('login')
                ->press('Products')
                ->assertSee('CyberPowerPC Gamer Xtreme VR Gaming PC')
                ->press('Click For More')
                ->press('Add To Cart')
                ->press('Cart')
                ->assertSee('CyberPowerPC Gamer Xtreme VR Gaming PC')
                ->press('-')
                ->screenshot('after-delete-attempt')
                ->assertDontSee('CyberPowerPC Gamer Xtreme VR Gaming PC'); // Replace 'Product Name' with the actual name of the product you added for the test
        });

        // Cleanup - consider removing the user or resetting the cart as needed
        $user->forceDelete();
    }
}
