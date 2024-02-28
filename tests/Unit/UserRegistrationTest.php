<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register()
    {
        // Arrange: Set up data for the test
        $userData = [
            'email' => 'john@example.com',
            'password' => 'password', // In a real application, ensure this is hashed appropriately
            'rpassword' => 'password',
            'phone' => '12345678', // Optional for this test
            'admin' => false, // Optional for this test
             'cart_id' => 0
        ];

        // Act: Perform the registration action
        $response = $this->post('/userReg', $userData);

        // Assert: Check if the user was registered successfully
        $response->assertStatus(302); // Assuming a redirect happens upon successful registration
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

        // Additionally, check if the user can be authenticated
        //$this->assertAuthenticatable('web', User::where('email', 'john@example.com')->first());
    }
}
