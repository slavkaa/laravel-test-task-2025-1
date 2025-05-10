<?php

namespace App\Ecxeptions\Registration;

class RegistrationLinkExpiredException extends \Exception
{
    protected $message = 'Link expired';
}
