<?php

namespace App\Http\Requests\IndexPages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url' => ['required', 'url', Rule::unique('index_pages')->ignore($this->indexPageId)]
        ];
    }
}
