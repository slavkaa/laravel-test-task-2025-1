<?php

namespace App\Repositories\Registration;

use App\Models\RegistrationLink;

class RegistrationLinkRepository implements RegistrationLinkRepositoryInterface
{
    public function create(string $userName, string $phoneNumber, string $hash): RegistrationLink
    {
        return RegistrationLink::create([
            'user_name' => $userName,
            'phone_number' => $phoneNumber,
            'uuid' => $hash,
            'is_active' => true,
        ]);
    }

    public function findByHash(string $hash): ?RegistrationLink
    {
        return RegistrationLink::where('uuid', $hash)->first();
    }
}
