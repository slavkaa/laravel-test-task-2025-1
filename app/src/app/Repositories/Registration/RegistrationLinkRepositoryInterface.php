<?php

namespace App\Repositories\Registration;

use App\Models\RegistrationLink;

interface RegistrationLinkRepositoryInterface
{
    public function create(string $userName, string $phoneNumber, string $hash): RegistrationLink;

    public function findByHash(string $hash): ?RegistrationLink;
}
