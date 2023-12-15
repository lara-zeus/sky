<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $label
 * @property string $class
 * @property string $icon
 */
class PostStatus extends Model
{
    use \Sushi\Sushi;

    public function getRows(): array
    {
        return [
            ['name' => 'publish', 'label' => __('Publish'), 'class' => 'px-2 py-0.5 text-xs rounded-xl text-success-700 bg-success-500/10', 'icon' => 'heroicon-o-check-badge'],
            ['name' => 'future', 'label' => __('Future'), 'class' => 'px-2 py-0.5 text-xs rounded-xl text-warning-700 bg-warning-500/10', 'icon' => 'heroicon-o-calendar-days'],
            ['name' => 'draft', 'label' => __('Draft'), 'class' => 'px-2 py-0.5 text-xs rounded-xl text-primary-700 bg-primary-500/10', 'icon' => 'heroicon-o-document-magnifying-glass'],
            ['name' => 'auto-draft', 'label' => __('Auto draft'), 'class' => 'px-2 py-0.5 text-xs rounded-xl text-info-700 bg-info-500/10', 'icon' => 'heroicon-o-document-magnifying-glass'],
            ['name' => 'pending', 'label' => __('Pending'), 'class' => 'px-2 py-0.5 text-xs rounded-xl text-info-700 bg-info-500/10', 'icon' => 'heroicon-o-document-minus'],
            ['name' => 'private', 'label' => __('Private'), 'class' => 'px-2 py-0.5 text-xs rounded-xl text-danger-700 bg-danger-500/10', 'icon' => 'heroicon-o-lock-closed'],
            ['name' => 'trash', 'label' => __('Trash'), 'class' => 'px-2 py-0.5 text-xs rounded-xl text-danger-700 bg-danger-500/10', 'icon' => 'heroicon-o-trash'],
            ['name' => 'inherit', 'label' => __('Inherit'), 'class' => 'px-2 py-0.5 text-xs rounded-xl text-gray-700 bg-gray-500/10', 'icon' => 'heroicon-m-arrow-up-left'],
        ];
    }

    protected function sushiShouldCache(): bool
    {
        return true;
    }
}
