<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'key' => 'required|string|max:255|unique:page_contents,key,' . $this->route('content'),
            'value' => 'required|string',
        ];
    }
}
