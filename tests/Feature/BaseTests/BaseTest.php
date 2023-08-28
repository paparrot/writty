<?php

namespace Tests\Feature\BaseTests;

use App\Models\User;
use Tests\TestCase;

class BaseTest extends TestCase
{
    protected User $currentUser;

    protected function asFakeUser(array $params = []): void
    {
        $user = User::factory($params)->create();
        $this->currentUser = $user;

        $this->actingAs($user);
    }
}
