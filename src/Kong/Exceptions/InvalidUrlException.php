<?php

namespace Ignittion\Kong\Exceptions;

use Exception;

/**
 * Invalid URL Exception.
 *
 * PHP Exception thrown when a non-RFC Compliant URL is given.
 *
 * @category Exceptions
 * @package Kong-PHP
 */
class InvalidUrlException extends Exception
{
    /**
     * Format the exception response.
     *
     * @param null|string $url
     * @param int $code
     * @param null|null $previous
     * @return void
     */
    public function __construct($url = null, $code = 400, Exception $previous = null)
    {
        parent::__construct("Invalid URL: {$url}", $code, $previous);
    }
}
