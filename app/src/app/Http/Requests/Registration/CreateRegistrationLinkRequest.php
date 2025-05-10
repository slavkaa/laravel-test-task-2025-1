<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegistrationLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:50',
            'phonenumber' => 'required|string|max:20',
        ];
    }

    public function getUsername(): string
    {
        return $this->validated('username');
    }

    public function getPhoneNumber(): string
    {
        return $this->validated('phonenumber');
    }
}
