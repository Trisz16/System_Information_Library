<?php

declare(strict_types=1);

namespace Brick\Math\Exception;

/**
 * Exception thrown when a number cannot be represented at the requested scale without rounding.
 */
final class RoundingNecessaryException extends MathException
{
    /**
     * @pure
     */
<<<<<<< HEAD
    public static function roundingNecessary(): RoundingNecessaryException
=======
    public static function roundingNecessary() : RoundingNecessaryException
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return new self('Rounding is necessary to represent the result of the operation at this scale.');
    }
}
