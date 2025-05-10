<?php

namespace App\Ecxeptions\Registration;

class RegistrationLinkNotFoundException extends \Exception
{
    protected $message = 'Link absent';
}
