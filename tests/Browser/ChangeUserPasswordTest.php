<?php

namespace Tests\Browser;

use App\Models\Cart;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChangeUserPasswordTest extends DuskTestCase
{
    /**
     * A Dusk test to change user password.
     *
     * @return void
     * @throws \Throwable
     */
    public function testUserCanChangePassword()
    {
        $cart = Cart::create([
            // Add necessary fields required by your Cart model
        ]);

        $user = User::create([
            'email' => 'B@B.com',
            'password' => 'B',
            'rpassword' => 'B',// Hash the password
            'phone' => '12345678', // Optional for this test
            'admin' => false, // Optional for this test
            'cart_id' => $cart->id, // Use the id of the cart you just created
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile') // Navigate to the profile page
                ->type('passwordOld', 'oldPassword') // Fill in the old password
                ->type('passwordNew1', 'newPassword') // Fill in the new password
                ->type('passwordNew2', 'newPassword') // Confirm the new password
                ->press('Change Password') // Click the change password button
                ->assertPathIs('/profile');// Assert you're redirected back to the profile
            // After the password change process
            $browser->visit('/logout') // Adjust based on your app's logout flow
            ->visit('/login') // Go to the login page
            ->type('email', 'B@B.com')
                ->type('password', 'newPassword') // Use the new password
                ->press('login') // Adjust the button text based on your form
                ->assertPathIs('/login'); // Or wherever a successful login redirects


        });
        $user->delete();
    }
}
