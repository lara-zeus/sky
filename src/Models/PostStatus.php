<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
    use \Sushi\Sushi;

    public function getRows()
    {
        return [
            ['name' => 'publish', 'label' => __('Publish'), 'class' => 'success', 'icon' => 'iconpark-filesuccessone'],
            ['name' => 'future', 'label' => __('Future'), 'class' => 'warning', 'icon' => 'iconpark-filedateone'],
            ['name' => 'draft', 'label' => __('Draft'), 'class' => 'secondary', 'icon' => 'iconpark-filehidingone'],
            ['name' => 'auto-draft', 'label' => __('Auto draft'), 'class' => 'primary', 'icon' => 'iconpark-filesearchone'],
            ['name' => 'pending', 'label' => __('Pending'), 'class' => 'info', 'icon' => 'iconpark-fileeditingone'],
            ['name' => 'private', 'label' => __('Private'), 'class' => 'danger', 'icon' => 'iconpark-filelockone'],
            ['name' => 'trash', 'label' => __('Trash'), 'class' => 'danger', 'icon' => 'iconpark-filetextone'],
            ['name' => 'inherit', 'label' => __('Inherit'), 'class' => 'primary', 'icon' => 'iconpark-filetipsone'],
        ];
    }

    protected function sushiShouldCache()
    {
        return true;
    }
}
