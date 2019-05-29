<?php


namespace Meteopark\Exceptions;

use Exception;

/**
 * Class NcloudFileUploadException
 * @package Meteopark\Exceptions
 */
class NcloudFileUploadException extends Exception
{

    /**
     * @var string
     */
    protected $message = 'An error occurred';
}
