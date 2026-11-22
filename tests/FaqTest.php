<?php

use LaraZeus\Sky\Livewire\Faq;
use Livewire\Livewire;

beforeEach(function (): void {
    $migration = include __DIR__ . '/../database/migrations/create_faqs_table.php.stub';
    $migration->up();
});

it('renders faq component without RootTagMissingFromViewException when there are no faqs', function (): void {
    Livewire::test(Faq::class)
        ->assertOk();
});
