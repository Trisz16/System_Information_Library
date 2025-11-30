<?php

declare(strict_types=1);

namespace Brick\Math\Exception;

<<<<<<< HEAD
use function dechex;
use function ord;
use function sprintf;
use function strtoupper;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
/**
 * Exception thrown when attempting to create a number from a string with an invalid format.
 */
final class NumberFormatException extends MathException
{
    /**
     * @pure
     */
<<<<<<< HEAD
    public static function invalidFormat(string $value): self
    {
        return new self(sprintf(
=======
    public static function invalidFormat(string $value) : self
    {
        return new self(\sprintf(
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            'The given value "%s" does not represent a valid number.',
            $value,
        ));
    }

    /**
     * @param string $char The failing character.
     *
     * @pure
     */
<<<<<<< HEAD
    public static function charNotInAlphabet(string $char): self
    {
        $ord = ord($char);

        if ($ord < 32 || $ord > 126) {
            $char = strtoupper(dechex($ord));
=======
    public static function charNotInAlphabet(string $char) : self
    {
        $ord = \ord($char);

        if ($ord < 32 || $ord > 126) {
            $char = \strtoupper(\dechex($ord));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            if ($ord < 10) {
                $char = '0' . $char;
            }
        } else {
            $char = '"' . $char . '"';
        }

<<<<<<< HEAD
        return new self(sprintf('Char %s is not a valid character in the given alphabet.', $char));
=======
        return new self(\sprintf('Char %s is not a valid character in the given alphabet.', $char));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
