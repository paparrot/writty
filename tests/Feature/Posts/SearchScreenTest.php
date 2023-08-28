<?php

namespace Tests\Feature\Posts;

use Inertia\Testing\AssertableInertia;
use Tests\Feature\BaseTests\PostBaseTest;

class SearchScreenTest extends PostBaseTest
{
    public function test_search_screen_without_auth(): void
    {
        $this->get(route('posts.search'))
            ->assertOk()
            ->assertInertia(fn (AssertableInertia $page): AssertableInertia => $page
                ->component('Post/Search')
                ->has('posts.data')
            );
    }

    public function test_search_screen(): void
    {
        $content = $this->posts->random()->content;

        $this->get(route('posts.search', ['q' => $content]))
            ->assertOk()
            ->assertInertia(fn (AssertableInertia $page): AssertableInertia => $page
                ->component('Post/Search')
                ->where('posts.data.0.content', $content)
            );
    }
}
