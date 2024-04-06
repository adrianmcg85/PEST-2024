<?php

use App\Models\Contact;
use function Pest\Faker\faker;

it('can store a contact', function () {
    login()->post('/contacts', [
        'first_name' => faker()->firstName,
        'last_name' => faker()->lastName,
        'email' => faker()->email,
        'phone' => faker()->e164PhoneNumber,
        'address',
        'city',
        'region',
        'country',
        'postal_code',
    ])
        ->assertRedirect('/contacts')
        ->assertSessionHas('success', 'Contact created.');

    expect(Contact::latest()->first())
        ->first_name->toBeString()->not->toBeEmpty()
        ->last_name->toBeString()->not->toBeEmpty()
        ->email->toBeString()->toContain('@')
        ->phone->toBeString()->toStartWith('+');
});