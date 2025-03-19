<?php

namespace App\Exceptions;

use Exception;

class UniqueListingSubscriptionException extends Exception
{
    protected $message = 'Listing with the same url already exists.';
}
