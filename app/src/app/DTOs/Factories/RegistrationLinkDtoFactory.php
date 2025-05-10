<?php

namespace App\DTOs\Factories;

use App\DTOs\Registration\CreateRegistrationLinkDto;
use App\Http\Requests\Registration\CreateRegistrationLinkRequest;

class RegistrationLinkDtoFactory
{
    public function createByCreateRegistrationLinkRequest(CreateRegistrationLinkRequest $request): CreateRegistrationLinkDto
    {
        return new CreateRegistrationLinkDto(
            $request->getUserName(),
            $request->getPhoneNumber()
        );
    }
}
