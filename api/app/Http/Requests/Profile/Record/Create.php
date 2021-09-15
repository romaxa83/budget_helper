<?php

namespace App\Http\Requests\Profile\Record;

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
            'type' => ['required', 'string', 'in:'. TypeRecord::COMING.','.TypeRecord::EXPENSES],
            'amount' => ['required', 'numeric'],
            'tags' => ['required', 'array'],
            'desc' => ['nullable', 'string', 'max:2000'],
            'created' => ['nullable'],
        ];
    }
}
