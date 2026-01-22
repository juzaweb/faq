<?php

namespace Juzaweb\Modules\Faq\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Juzaweb\Modules\Core\Models\Model;
use Juzaweb\Modules\Core\Traits\HasAPI;
use Juzaweb\Modules\Core\Traits\Translatable;
use Juzaweb\Modules\Core\Traits\UsedInFrontend;

class Faq extends Model
{
    use HasUuids, HasAPI,  Translatable, UsedInFrontend;

    protected $table = 'faqs';

    protected $fillable = [
        'active',
        'display_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'display_order' => 'integer',
    ];

    public $translatedAttributes = [
        'question',
        'answer',
        'locale',
    ];
}
