<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Cart;

class UserRegistrationTest extends DuskTestCase
{
    /**
     * A Dusk test to check user registration.
     *
     * @return void
     * @throws \Throwable
     */
    public function testUserCanRegister()
    {
        $email = 'test@example.com'; // Use a unique email to ensure the test user can be identified

        $this->browse(function (Browser $browser) use ($email) {
            $browser->visit('/userReg')
                ->type('email', $email)
                ->type('password', 'password') // Adjust the field names according to your form
                ->type('rpassword', 'password') // Assuming you have a password confirmation field
                ->type('phone', '12345678') // Include other fields as necessary
                //->check('admin') // Only if you have an admin checkbox or similar
                // ->select('cart_id', '1') // Example if you need to select a cart
                ->press('Create Account') // Adjust the button text to match your form
                ->assertPathIs('/'); // Adjust if your application redirects elsewhere upon successful registration

            // You can add more assertions here to check for a successful registration message, etc.
        });

        // Optionally, check the database for the new user (can be done outside the browse closure)
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);

        $user = User::where('email', $email)->first();
        if ($user) {
            $user->delete();

        }
    }
}
