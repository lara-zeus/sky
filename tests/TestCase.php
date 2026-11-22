<?php

namespace LaraZeus\Sky\Tests;

use Filament\FilamentServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use LaraZeus\Core\CoreServiceProvider;
use LaraZeus\SEO\SEOServiceProvider;
use LaraZeus\Sky\SkyServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'LaraZeus\Sky\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            FilamentServiceProvider::class,
            CoreServiceProvider::class,
            SEOServiceProvider::class,
            SkyServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('app.key', 'base64:' . base64_encode(random_bytes(32)));

        /*
        $migration = include __DIR__.'/../database/migrations/create_Sky_table.php.stub';
        $migration->up();
        */
    }
}
