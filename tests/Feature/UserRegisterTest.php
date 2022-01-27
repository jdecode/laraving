<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has mismatching passwords', function () {
    $user = [
        'name' => 'JD Singh',
        'email' => 'jd@jd.com',
        'password' => 'password1',
        'password_confirmation' => 'password2',
    ];
    $this->post('/api/register', $user)
    ->assertStatus(302);
});

it('has incorrect email format', function () {
    $user = [
        'name' => 'JD Singh',
        'email' => 'jd@jd.',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];
    $this->post('/api/register', $user)
    ->assertStatus(302);
});

it('can register a user', function () {
    $user = [
        'name' => 'JD Singh',
        'email' => 'jd@jd.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];
    $this->post('/api/register', $user)
    ->assertStatus(201);
});
