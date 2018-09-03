<?php

namespace ElusiveDocks\BackBone\Exception;

use ElusiveDocks\BackBone\Contract\ExceptionInterface;

/**
 * Class AbstractException
 * @package ElusiveDocks\BackBone\Exception
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
