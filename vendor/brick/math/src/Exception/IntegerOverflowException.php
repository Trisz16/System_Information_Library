<?php

declare(strict_types=1);

namespace Brick\Math\Exception;

use Brick\Math\BigInteger;

<<<<<<< HEAD
use function sprintf;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
/**
 * Exception thrown when an integer overflow occurs.
 */
final class IntegerOverflowException extends MathException
{
    /**
     * @pure
     */
<<<<<<< HEAD
    public static function toIntOverflow(BigInteger $value): IntegerOverflowException
    {
        $message = '%s is out of range %d to %d and cannot be represented as an integer.';

        return new self(sprintf($message, (string) $value, PHP_INT_MIN, PHP_INT_MAX));
=======
    public static function toIntOverflow(BigInteger $value) : IntegerOverflowException
    {
        $message = '%s is out of range %d to %d and cannot be represented as an integer.';

        return new self(\sprintf($message, (string) $value, PHP_INT_MIN, PHP_INT_MAX));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
