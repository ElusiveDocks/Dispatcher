<?php

namespace ElusiveDocks\Dispatcher\Exception;

use ElusiveDocks\Dispatcher\Contract\ExceptionInterface;

/**
 * Class AbstractException
 * @package ElusiveDocks\Dispatcher\Exception
 */
abstract class AbstractException extends \Exception implements ExceptionInterface
{
    /**
     * @return string
     */
    public function __toString()
    {
        return parent::__toString();
    }
}
