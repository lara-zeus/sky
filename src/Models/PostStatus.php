<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
    use \Sushi\Sushi;

    public function getRows()
    {
        return [
            ['name' => 'publish', 'label' => 'Publish', 'class' => 'success', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'future', 'label' => 'Future', 'class' => 'warning', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'draft', 'label' => 'Draft', 'class' => 'primary', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'auto-draft', 'label' => 'Draft', 'class' => 'primary', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'pending', 'label' => 'Pending', 'class' => 'primary', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'private', 'label' => 'Private', 'class' => 'danger', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'trash', 'label' => 'Trash', 'class' => 'danger', 'icon' => 'heroicon-o-pencil'],
            ['name' => 'inherit', 'label' => 'inherit', 'class' => 'primary', 'icon' => 'heroicon-o-pencil'],
        ];
    }

    protected function sushiShouldCache()
    {
        return true;
    }
}
