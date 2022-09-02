<?php

namespace Application\Exception;

use \Exception;
use Throwable;

class BusinessException extends Exception
{
    /**
     * Class constructor.
     */
    public function __construct( string $message, ?Throwable $previous = null )
    {
        parent::__construct($message, 99, $previous );
    }
}