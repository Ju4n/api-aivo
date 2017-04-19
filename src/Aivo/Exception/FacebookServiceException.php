<?php

namespace Aivo\Exception;

use Exception;

/**
 * FacebookServiceException
 *
 * @uses Exception
 * @author Juan Deladoey
 */
class FacebookServiceException extends Exception
{
    /**
     * __construct
     *
     * @param mixed $message
     * @param int $code
     * @return void
     */
    public function __construct($message, $code = 500)
    {
        parent::__construct($message, $code);
    }
}
