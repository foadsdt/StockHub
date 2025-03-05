<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Test\ResetDatabase;

class UserResourceTest extends KernelTestCase
{
    use HasBrowser;
    use ResetDatabase;

    public function testPostToCreateUser(): void
    {
        $this->browser()
            ->post('/api/users', [
                'json' => [
                    'email' => 'foad.sdto@gmail.com',
                    'password' => 'password',
                    'username' => 'foad'
                ]
            ])
            ->assertStatus(201)
            ->post('/login-request', [
                'json' => [
                    'email' => 'foad.sdto@gmail.com',
                    'password' => 'password',
                ]
            ])
            ->assertSuccessful();
        ;

    }

}
