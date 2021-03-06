<?php

namespace App\Http\Requests\Profile\Tag;

use App\ValueObjects\Statuses\TypeRecord;
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
            'type' => ['required', 'string', 'in:'. TypeRecord::COMING.','.TypeRecord::EXPENSES],
            'parent_id' => ['nullable', 'integer', 'exists:tags,id'],
        ];
    }
}

