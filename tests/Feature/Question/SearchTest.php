<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should to be able to search a question by text', function () {
    $user = User::factory()->create();
    Question::factory()->create(['question' => 'Something else?']);
    Question::factory()->count(1)->create(['question' => 'My question is?']);
    actingAs($user);

    $response = get(route('dashboard', ['search' => 'question']));

    $response->assertDontSee('Something else?');
    $response->assertSee('My question is?');
});
