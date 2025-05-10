<?php

namespace App\Services\Registration;

use Ramsey\Uuid\UuidInterface;
interface HashServiceInterface
{
    public function generate(): string;
}
