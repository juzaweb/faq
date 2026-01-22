<?php

namespace Juzaweb\Modules\Faq\Models;

use Juzaweb\Modules\Core\Models\Model;
use Juzaweb\Modules\Core\Traits\HasAPI;

class FaqTranslation extends Model
{
    use HasAPI;

    public $timestamps = false;

    protected $table = 'faq_translations';

    protected $fillable = [
        'faq_id',
        'locale',
        'question',
        'answer',
    ];
}
