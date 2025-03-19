<?php

namespace App\Exceptions;

use Exception;

class ExtractorResponseException extends Exception
{
    protected $message = 'Extractor response failed';
}
