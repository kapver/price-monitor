<?php

namespace App\Exceptions;

use Exception;

class ExtractorUrlException extends Exception
{
    protected $message = 'Extractor url is empty';
}
