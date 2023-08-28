<?php

namespace Tests\Feature\Posts;

use Inertia\Testing\AssertableInertia;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class CreateScreenTest extends PostBaseTest
{
    /**
     * A basic feature test example.
     */
    public function test_create_post_screen_without_auth(): void
    {
        $this->get(route('posts.create'))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('login');
    }

    public function test_create_post_screen(): void
    {
        $this->asFakeUser();

        $this->get(route('posts.create'))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Post/Create')
            );
    }
}
