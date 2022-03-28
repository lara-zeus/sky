<?php

namespace LaraZeus\Sky\Tests;

use LaraZeus\Sky\SkyServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Facade as Facade;
use Livewire\LivewireServiceProvider;
use LaraZeus\Sky\Tests\HttpKernel;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $baseUrl = 'http://app.test';

    public function setUp(): void
    {
        parent::setUp();

        /*$this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });*/

        //Facade::setFacadeApplication(app());
        // additional setup
    }

    /*public function makeACleanSlate()
    {
        Artisan::call('view:clear');
    }*/

    protected function getPackageProviders($app)
    {
        return [
            SkyServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        /*$app['config']->set('view.paths', [
            __DIR__.'/../views',
            resource_path('views'),
        ]);*/
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');
        //Facade::setFacadeApplication(app());
        $app['config']->set('session.driver', 'file');


        // perform environment setup
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', HttpKernel::class);
    }

    public function test_test_envirement()
    {
        $this->assertNotNull(app('sky'));
    }
}