<?php

namespace LaraZeus\Sky\Console;

use Illuminate\Console\Command;
use LaraZeus\Sky\Concerns\CanManipulateFiles;

class ZeusEditorCommand extends Command
{
    //art make:zeus-editor Filament\\Forms\\Components\\MarkdownEditor
    use CanManipulateFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:zeus-editor {plugin : filament FQN plugin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create custom editor for zeus sky';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $filamentPluginFullNamespace = $this->argument('plugin');
        $fieldClassName = str($filamentPluginFullNamespace)->explode('\\')->last();

        $this->copyStubToApp('ZeusEditor', 'app/Zeus/Editor/' . $fieldClassName . '.php', [
            'namespace' => 'App\\Zeus\\Editor',
            'plugin' => $filamentPluginFullNamespace,
            'class' => $fieldClassName,
        ]);

        $this->info('zeus editor created successfully!');
    }
}
