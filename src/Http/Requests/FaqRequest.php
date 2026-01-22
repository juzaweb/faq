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

class FaqRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'active' => ['nullable', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:1'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
        ];
    }
}
