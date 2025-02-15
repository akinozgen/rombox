<?php

namespace App\Http\Requests\IndexPages;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url' => ['required', 'url', 'unique:index_pages,url']
        ];
    }
}
