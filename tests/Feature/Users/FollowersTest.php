<?php

namespace Tests\Feature\Users;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\Feature\BaseTests\BaseTest;

class FollowersTest extends BaseTest
{
    use RefreshDatabase;

    private User $followingUser;
    private User $followerUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->followingUser = User::factory()->create();
        $this->followerUser = User::factory()->create();
    }

    public function test_following_posts_screen_without_following(): void
    {
        $this->asFakeUser();
        Post::factory()->count(3)->create();

        $this->get(route('posts.following'))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page): AssertableInertia => $page
                ->component('Post/Following')
                ->has('posts.data', 0)
            );
    }

    public function test_following_posts_screen(): void
    {
        $this->asFakeUser();
        Post::factory(['author_id' => $this->followingUser->id])->count(3)->create();
        $this->currentUser->follow($this->followingUser);

        $this->get(route('posts.following'))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page): AssertableInertia => $page
                ->component('Post/Following')
                ->has('posts.data', 3, fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('author.id', $this->followingUser->id)
                    ->etc()
                )
            );
    }

    public function test_following_users_screen(): void
    {
        $this->asFakeUser();

        $this->get(route('profile.following', ['user' => $this->currentUser]))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page): AssertableInertia => $page
                ->component('Profile/Following')
                ->has('user', fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('name', $this->currentUser->name)
                    ->where('nickname', $this->currentUser->nickname)
                    ->where('id', $this->currentUser->id)
                    ->where('avatar', $this->currentUser->profile_photo_path)
                )
                ->has('following.data', 0)
                ->has('currentUserFollowers', 0)
                ->has('currentUserFollowing', 0)
            );
    }

    public function test_following_users_screen_with_following(): void
    {
        $this->asFakeUser();
        $this->currentUser->follow($this->followingUser);

        $this->get(route('profile.following', ['user' => $this->currentUser]))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page): AssertableInertia => $page
                ->component('Profile/Following')
                ->has('user', fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('name', $this->currentUser->name)
                    ->where('nickname', $this->currentUser->nickname)
                    ->where('id', $this->currentUser->id)
                    ->where('avatar', $this->currentUser->profile_photo_path)
                )
                ->has('following.data', 1, fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('id', $this->followingUser->id)
                    ->where('name', $this->followingUser->name)
                    ->where('nickname', $this->followingUser->nickname)
                    ->where('avatar', $this->followingUser->profile_photo_path)
                )
            );
    }

    public function test_followers_screen(): void
    {
        $this->asFakeUser();

        $this->get(route('profile.followers', ['user' => $this->currentUser]))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page): AssertableInertia => $page
                ->component('Profile/Followers')
                ->has('user', fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('name', $this->currentUser->name)
                    ->where('nickname', $this->currentUser->nickname)
                    ->where('id', $this->currentUser->id)
                    ->where('avatar', $this->currentUser->profile_photo_path)
                )
                ->has('followers.data', 0)
                ->has('currentUserFollowers', 0)
                ->has('currentUserFollowing', 0)
            );
    }

    public function test_followers_screen_with_followers(): void
    {
        $this->asFakeUser();
        $this->followerUser->follow($this->currentUser);

        $this->get(route('profile.followers', ['user' => $this->currentUser]))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page): AssertableInertia => $page
                ->component('Profile/Followers')
                ->has('user', fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('name', $this->currentUser->name)
                    ->where('nickname', $this->currentUser->nickname)
                    ->where('id', $this->currentUser->id)
                    ->where('avatar', $this->currentUser->profile_photo_path)
                )
                ->has('followers.data', 1, fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('id', $this->followerUser->id)
                    ->where('name', $this->followerUser->name)
                    ->where('nickname', $this->followerUser->nickname)
                    ->where('avatar', $this->followerUser->profile_photo_path)
                )
                ->has('currentUserFollowers', 1)
                ->has('currentUserFollowing', 0)
            );
    }

    public function test_follow(): void
    {
        $this->asFakeUser();
        $this
            ->from(route('profile.show', ['user' => $this->followingUser]))
            ->post(route('profile.follow', ['user' => $this->followingUser]))
            ->assertRedirectToRoute('profile.show', ['user' => $this->followingUser]);

        $this->assertDatabaseHas('users_users', [
            'user_id' => $this->followingUser->id,
            'follower_id' => $this->currentUser->id,
        ]);
    }

    public function test_follow_followed_user(): void
    {
        $this->asFakeUser();
        $this->currentUser->follow($this->followingUser);

        $this
            ->from(route('profile.show', ['user' => $this->followingUser]))
            ->post(route('profile.follow', ['user' => $this->followingUser]))
            ->assertRedirectToRoute('profile.show', ['user' => $this->followingUser]);

        $this->assertDatabaseHas('users_users', [
            'user_id' => $this->followingUser->id,
            'follower_id' => $this->currentUser->id,
        ]);
        $this->assertDatabaseCount('users_users', 1);
    }

    public function test_unfollow(): void
    {
        $this->asFakeUser();
        $this->currentUser->follow($this->followingUser);

        $this
            ->from(route('profile.show', ['user' => $this->followingUser]))
            ->followingRedirects()
            ->delete(route('profile.unfollow', ['user' => $this->followingUser]))
            ->assertOk();

        $this->assertDatabaseMissing('users_users', [
            'follower_id' => $this->currentUser->id,
            'user_id' => $this->followingUser->id,
        ]);
    }

    public function test_unfollow_unfollowed_user(): void
    {
        $this->asFakeUser();

        $this
            ->from(route('profile.show', ['user' => $this->followingUser]))
            ->followingRedirects()
            ->delete(route('profile.unfollow', ['user' => $this->followingUser]))
            ->assertOk();

        $this->assertDatabaseMissing('users_users', [
            'user_id' => $this->followingUser->id,
            'follower_id' => $this->currentUser->id
        ]);

    }
}
