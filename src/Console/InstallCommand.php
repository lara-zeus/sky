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

        $this->call('vendor:publish', ['--tag' => 'zeus-sky-config']);

        $this->info('publishing migrations...');

        $this->call('vendor:publish', ['--tag' => 'zeus-sky-migrations']);

        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Tags\TagsServiceProvider',
            '--tag' => 'tags-migrations',
        ]);

        $this->call('vendor:publish', [
            '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
            '--tag' => 'migrations',
        ]);

        $this->info('publishing zeus assets...');

        $this->call('vendor:publish', ['--tag' => 'zeus-config']);
        $this->call('vendor:publish', ['--tag' => 'zeus-assets']);

        $this->info('running migrations...');

        $this->call('migrate');

        $this->output->success('Zeus Sky has been Installed successfully, consider ⭐️ the package in filament site :)');
    }
}
