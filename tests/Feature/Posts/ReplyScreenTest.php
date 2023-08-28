<?php

namespace Tests\Feature\Posts;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class ReplyScreenTest extends PostBaseTest
{
    use WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_reply_screen_without_auth(): void
    {
        $post = $this->posts->random();
        $this->get(route('posts.reply', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('login');
    }

    public function test_reply_screen_without_post(): void
    {
        $this->actingAs(User::factory()->create());

        $id = $this->faker->unique()->uuid;

        $this->get(route('posts.reply', ['post' => $id]))
            ->assertStatus(BaseResponse::HTTP_NOT_FOUND);
    }

    public function test_reply()
    {
        $this->actingAs(User::factory()->create());

        $post = $this->posts->random();

        $this->get(route('posts.reply', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Reply/Create')
                ->has('post')
                ->has('post', fn (AssertableInertia $prop) => $this->comparePostFields($prop))
            );
    }
}
