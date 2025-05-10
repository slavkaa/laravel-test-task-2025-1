<?php

namespace App\Services\Registration;

use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

class HashService implements HashServiceInterface
{
    public function generate(): string
    {
        return (string) Str::uuid();
    }
}
