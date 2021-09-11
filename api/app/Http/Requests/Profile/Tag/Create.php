<?php

namespace App\Http\Requests\Profile\Tag;

use App\Models\Tag\Tag;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'type' => ['required', 'string', 'in:'. Tag::TYPE_COMING.','.Tag::TYPE_EXPENSES],
            'parent_id' => ['nullable', 'integer', 'exists:tags,id'],
        ];
    }
}

