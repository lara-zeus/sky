<?php

namespace LaraZeus\Sky\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations;

    public $translatable = [
        'question',
        'answer'
    ];

    protected $fillable = [
        'question',
        'answer',
    ];
}
