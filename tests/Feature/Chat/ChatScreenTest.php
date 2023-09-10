<?php

namespace Tests\Feature\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\Feature\BaseTests\BaseTest;

class ChatScreenTest extends BaseTest
{
    use RefreshDatabase, WithFaker;

    private User $recipient;
    private Conversation $conversation;

    public function setUp(): void
    {
        parent::setUp();
        $this->conversation = Conversation::factory()->create();
        $this->recipient = User::factory()->create();
    }

    public function test_chat_screen_without_auth(): void
    {
        $this->get(route('chat.show', ['conversation' => $this->conversation]))
            ->assertRedirectToRoute('login');
    }

    public function test_chat_screen_without_verification_email(): void
    {
        $this->asFakeUser(['email_verified_at' => null]);

        $this->conversation->users()->attach($this->recipient->id);
        $this->conversation->users()->attach($this->currentUser->id);

        $this->get(route('chat.show', ['conversation' => $this->conversation]))
            ->assertOk();
    }

    public function test_chat_screen(): void
    {
        $this->asFakeUser();
        $this->conversation->users()->attach($this->currentUser);
        $this->conversation->users()->attach($this->recipient);

        $this->get(route('chat.show', ['conversation' => $this->conversation]))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page): AssertableInertia => $page
                ->component('Conversation/Show')
                ->has('messages.data', 0)
                ->has('recipient', fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('id', $this->recipient->id)
                    ->where('nickname', $this->recipient->nickname)
                    ->where('avatar', $this->recipient->profile_photo_path)
                    ->etc()
                )
                ->where('conversation', $this->conversation->id)
            );
    }

    public function test_chat_screen_with_messages(): void
    {
        $this->asFakeUser();

        $this->conversation->users()->attach($this->currentUser);
        $this->conversation->users()->attach($this->recipient);

        $firstMessage = $this->conversation->messages()->create([
            'author_id' => $this->recipient->id,
            'message' => $this->faker->text()
        ]);

        $secondMessage = $this->conversation->messages()->create([
            'author_id' => $this->currentUser->id,
            'message' => $this->faker->text()
        ]);

        $this->get(route('chat.show', ['conversation' => $this->conversation]))
            ->assertOk()
            ->assertInertia(fn (AssertableInertia $page): AssertableInertia => $page
                ->has('recipient')
                ->has('messages.data.0', fn (AssertableInertia $prop): AssertableInertia => $prop
                    ->where('id', $firstMessage->id)
                    ->where('message', $firstMessage->message)
                    ->etc()
                )
                ->has('messages.data.1', fn (AssertableInertia $prop): AssertableInertia => $prop
                    ->where('id', $secondMessage->id)
                    ->where('message', $secondMessage->message)
                    ->etc()
                )
                ->has('conversation')
            );
    }
}
