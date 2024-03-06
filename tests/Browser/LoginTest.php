<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Cart;

class LoginTest extends DuskTestCase
{


    /**
     * A Dusk test to check user login with correct credentials.
     *
     * @return void
     * @throws \Throwable
     */
    public function testUserCanLoginWithCorrectCredentials()
    {
        // First, create a cart
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
                ->press('login') // Adjust the button text to match your form
                ->assertPathIs('/'); // Adjust if your application redirects elsewhere
        });
        $user->delete();
    }

}
