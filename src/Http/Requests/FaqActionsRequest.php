<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 */

namespace Juzaweb\Modules\Faq\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Modules\Core\Rules\AllExist;

class FaqActionsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'action' => ['required', Rule::in(['activate', 'deactivate', 'delete'])],
            'ids' => ['required', 'array', 'min:1', AllExist::make('faqs', 'id')],
        ];
    }
}
