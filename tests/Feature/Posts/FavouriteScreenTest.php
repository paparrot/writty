<?php

namespace Tests\Feature\Posts;

use Inertia\Testing\AssertableInertia;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class FavouriteScreenTest extends PostBaseTest
{
    /**
     * A basic feature test example.
     */
    public function test_favourite_screen_without_auth(): void
    {
        $this->get(route('posts.favourites'))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('login');
    }

    public function test_favourite_screen_without_posts(): void
    {
        $this->asFakeUser();

        $this->get(route('posts.favourites'))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Post/Favourites')
                ->has('posts.data', 0)
            );
    }

    public function test_favourite_screen(): void
    {
        $this->asFakeUser();
        $post = $this->posts->random();
        $this->currentUser->like($post);

        $this->get(route('posts.favourites'))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Post/Favourites')
                ->has('posts.data', 1)
                ->has('posts.data.0', fn(AssertableInertia $prop) => $this->comparePostFields($prop))
                ->where('posts.data.0.id', $post->id)
            );
    }
}
