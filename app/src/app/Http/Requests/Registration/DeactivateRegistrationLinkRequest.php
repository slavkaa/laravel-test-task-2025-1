<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class DeactivateRegistrationLinkRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hash' => 'required|string|max:50',
        ];
    }

    public function getHash(): string
    {
        return $this->validated('hash');
    }
}
