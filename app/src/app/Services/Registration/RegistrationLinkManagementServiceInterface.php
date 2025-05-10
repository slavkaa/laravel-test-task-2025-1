<?php

namespace App\Services\Registration;

use App\DTOs\Registration\CreateRegistrationLinkDto;

interface RegistrationLinkManagementServiceInterface
{
    public function createLinkByUserData(CreateRegistrationLinkDto $dto): string;

    public function deactivateLink(string $hash): void;

    public function checkLinkByHash(string $hash): void;
}
