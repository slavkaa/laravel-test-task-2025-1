<?php

namespace App\Http\Requests\Registration;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PageARequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hash' => 'required|string|max:50'
        ];
    }

    public function getHash(): string
    {
        return $this->validated('hash');
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'hash' => $this->route('hash'),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->route('registration.show')
            ->withErrors($validator)
                ->withInput()
        );
    }
}
