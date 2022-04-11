<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
    use \Sushi\Sushi;

    public function getRows()
    {
        return [
            ['name' => 'publish', 'label' => __('Publish'), 'class' => 'success', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'future', 'label' => __('Future'), 'class' => 'warning', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'draft', 'label' => __('Draft'), 'class' => 'primary', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'auto-draft', 'label' => __('Auto draft'), 'class' => 'primary', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'pending', 'label' => __('Pending'), 'class' => 'primary', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'private', 'label' => __('Private'), 'class' => 'danger', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'trash', 'label' => __('Trash'), 'class' => 'danger', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'inherit', 'label' => __('Inherit'), 'class' => 'primary', 'icon' => 'heroicon-o-pencil'],
        ];
    }

    protected function sushiShouldCache()
    {
        return true;
    }
}
