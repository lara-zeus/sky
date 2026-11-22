<?php

namespace LaraZeus\Sky\Classes;

use Illuminate\Support\Facades\Blade;
use LaraZeus\Bolt\BoltPlugin;
use LaraZeus\Bolt\Facades\Bolt;

class BoltParser
{
    public function __invoke(string $content): string
    {
        if (class_exists(Bolt::class)) {
            $content = html_entity_decode($content);
            preg_match('/<bolt>(.*?)<\/bolt>/s', $content, $bolt);
            if (isset($bolt[1])) {
                $formSlug = trim($bolt[1]);
                // @phpstan-ignore-next-line
                $checkForm = BoltPlugin::getModel('Form')::where('slug', $formSlug)->first();
                if ($checkForm !== null) {
                    $boltComponent = Blade::render('@push("styles") @filamentStyles @endpush <livewire:bolt.fill-form inline="true" slug="' . $formSlug . '" />');
                    $content = str_replace('<bolt>' . $formSlug . '</bolt>', $boltComponent, $content);
                }
            }
        }

        return $content;
    }
}
