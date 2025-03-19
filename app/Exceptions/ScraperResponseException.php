<?php

namespace App\Exceptions;

use Exception;

class ScraperResponseException extends Exception
{
    protected $message = 'Scraper response failed';
}
