<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should be able to login', function () {

    User::factory()->create(['email' => 'jd@jd.com', 'password' => 'password']);
    $this->post('/api/login', ['email' => 'jd@jd.com', 'password' => 'password'])
        ->assertStatus(200);
});
