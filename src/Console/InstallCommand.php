<?php

namespace LaraZeus\Sky\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sky:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Sky components and resources';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('publishing configuration...');

        $this->callSilent('vendor:publish', ['--tag' => 'zeus-sky-config']);

        $this->info('publishing migrations...');

        $this->callSilent('vendor:publish', ['--tag' => 'zeus-sky-migrations']);

        $this->callSilent('vendor:publish', [
            '--provider' => 'Spatie\Tags\TagsServiceProvider',
            '--tag' => 'tags-migrations',
        ]);

        $this->callSilent('vendor:publish', [
            '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
            '--tag' => 'migrations',
        ]);

        $this->info('publishing zeus assets...');

        $this->callSilent('vendor:publish', ['--tag' => 'zeus-config']);
        $this->callSilent('vendor:publish', ['--tag' => 'zeus-assets']);

        $this->info('running migrations...');

        $this->callSilent('migrate');

        $this->output->success('Zeus and Sky has been Published successfully');
    }
}
