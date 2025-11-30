<?php

declare(strict_types=1);

namespace Brick\Math\Exception;

/**
 * Exception thrown when a division by zero occurs.
 */
final class DivisionByZeroException extends MathException
{
    /**
     * @pure
     */
<<<<<<< HEAD
    public static function divisionByZero(): DivisionByZeroException
=======
    public static function divisionByZero() : DivisionByZeroException
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return new self('Division by zero.');
    }

    /**
     * @pure
     */
<<<<<<< HEAD
    public static function modulusMustNotBeZero(): DivisionByZeroException
=======
    public static function modulusMustNotBeZero() : DivisionByZeroException
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return new self('The modulus must not be zero.');
    }

    /**
     * @pure
     */
<<<<<<< HEAD
    public static function denominatorMustNotBeZero(): DivisionByZeroException
=======
    public static function denominatorMustNotBeZero() : DivisionByZeroException
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return new self('The denominator of a rational number cannot be zero.');
    }
}
