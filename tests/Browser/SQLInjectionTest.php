<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SqlInjectionTest extends DuskTestCase
{
    /**
     * Test the login form for SQL Injection vulnerability.
     *
     * @return void
     * @throws \Throwable
     */
    public function testLoginFormIsProtectedAgainstSqlInjection()
    {
        $this->browse(function (Browser $browser) {
            $maliciousSql = "' OR '1'='1";

            $browser->visit('/login') // Adjust if your login route is different
            ->type('email', $maliciousSql) // Input malicious SQL into the email field
            ->type('password', $maliciousSql) // Input malicious SQL into the password field
            ->press('login') // Adjust the button text to match your form
            ->assertPathIsNot('/'); // Adjust based on where a successful login would redirect

            // Optionally, check if a specific error message is displayed
            // $browser->assertSee('These credentials do not match our records.');
        });
    }
}
