<?php

namespace App\DTOs\Registration;

readonly class CreateRegistrationLinkDto
{
    public function  __construct(
        public readonly string $userName,
        public readonly string $phoneNumber
    )
    { }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
